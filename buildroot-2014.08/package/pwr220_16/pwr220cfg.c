/*
 * Configuration implementation
 */
#include <stdio.h>
#include <errno.h>
#include <string.h>
#include <stdlib.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <unistd.h>
#include "pwr220cfg.h"

// globally exported config structure
pwr220_cfg_t pwr220Cfg;

char serialNum[64] = "";

// add new config parameters here
static cfg_descriptor_entry_t CfgDesc[] =
{
	// network
	{&pwr220Cfg.network.device_name[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.device_name),"network.device_name="},
	{&pwr220Cfg.network.mac_addr[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.mac_addr),"network.mac_address="},
	{&pwr220Cfg.network.ip_address[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.ip_address),"network.ip_address="},
	{&pwr220Cfg.network.ip_mask[0],		CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.ip_mask),"network.ip_mask="},
	{&pwr220Cfg.network.ip_gateway[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.ip_gateway),"network.ip_gateway="},
	{&pwr220Cfg.network.dns_server[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.dns_server),"network.dns_server="},
	{&pwr220Cfg.network.dhcp_enable,	CFG_VAR_INT, 0, 	"network.dhcp_enable="},
	{&pwr220Cfg.network.http_port,		CFG_VAR_USHORT, 0, 	"network.http_port="},
	{&pwr220Cfg.network.ntp_server0[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.ntp_server0),"network.ntp_server0="},
	{&pwr220Cfg.network.ntp_server1[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.ntp_server1),"network.ntp_server1="},
	{&pwr220Cfg.network.ntp_server2[0],	CFG_VAR_STR, (int)sizeof(pwr220Cfg.network.ntp_server2),"network.ntp_server2="},

	{NULL, 0, 0, ""},
};

// forward declarations
static cfg_descriptor_entry_t *config_find_param(char *tagStr);
static int config_load_entry(cfg_descriptor_entry_t *pEntry, char *string_in, char *errstr);
static long get_filesize(FILE *f);

/*
 * Load and parse configuration
 * Loads structure pCfg with configuration parameters read from file broker.ini
 */
int ConfigLoad(char *fileName, char *serialPath)
{
	FILE *fd;
	cfg_descriptor_entry_t *pEntry;
	char str[256];
	char errstr[128];
	char *p;
	int i, n, j, rc;

	// set defaults
	memset(&pwr220Cfg, 0, sizeof(pwr220Cfg));

	strcpy(pwr220Cfg.network.device_name, PWR220_CFG_DEF_DEVICE_NAME);
	strcpy(pwr220Cfg.network.ip_address, PWR220_CFG_DEF_IP_ADDRESS);
	strcpy(pwr220Cfg.network.ip_mask, PWR220_CFG_DEF_IP_MASK);
	strcpy(pwr220Cfg.network.ip_gateway, PWR220_CFG_DEF_IP_GATEWAY);
	strcpy(pwr220Cfg.network.dns_server, PWR220_CFG_DEF_DNS_SERVER);
	strcpy(pwr220Cfg.network.mac_addr, PWR220_CFG_DEF_MAC);
	pwr220Cfg.network.dhcp_enable = PWR220_CFG_DEF_DHCP_ENABLE;
	pwr220Cfg.network.http_port = PWR220_CFG_DEF_HTTP_PORT;
	strcpy(pwr220Cfg.network.ntp_server0, PWR220_CFG_DEF_NTPSERVER0);
	strcpy(pwr220Cfg.network.ntp_server1, PWR220_CFG_DEF_NTPSERVER1);
	strcpy(pwr220Cfg.network.ntp_server2, PWR220_CFG_DEF_NTPSERVER2);
	
	fd = fopen(fileName, "r");
	if (!fd) return 0;

	if (get_filesize(fd) == 0)
	{
		fclose(fd);
		return 0;
	}

	while (!feof(fd))
	{
		if (fgets(str, sizeof(str), fd))
		{
			p = strchr(str, '\r');
			if (p)
			{
				*p = 0;
			}
			else 
			{
				p = strchr(str, '\n');
				if (p) *p = 0;
			}

			pEntry = config_find_param(str);
			if (!pEntry) continue;

			config_load_entry(pEntry, str, errstr);
		}
	}

	fclose(fd);

	fd = fopen(serialPath, "r");
	if (!fd) return 1;

	rc = (int)fgets(str, sizeof(str), fd);

	fclose(fd);

	if (rc)
	{
		p = strchr(str, '\r');
		if (p)
		{
			*p = 0;
		}
		else 
		{
			p = strchr(str, '\n');
			if (p) *p = 0;
		}

		if (strlen(str) == 12)
		{
			n = j = 0;
			for (i=0; i<6; i++)
			{
				memcpy(&pwr220Cfg.network.mac_addr[n], &str[j], 2);
				n += 3;
				j += 2;
			}
		}
	}

	return 1;
}

/*
 * Save configurartion to disk file
 */
int ConfigSave(char *fileName)
{
	FILE *fd;
	cfg_descriptor_entry_t *pEntry;
	int i;

	fd = fopen(fileName, "w");
	if (!fd) return 0;

	i = 0;
	pEntry = &CfgDesc[i]; 
	while (pEntry->varType != CFG_VAR_NONE)
	{		
		switch (pEntry->varType)
		{		
		case CFG_VAR_INT:
			fprintf(fd, "%s%d\n", pEntry->tag, *(int *)pEntry->varAddr);			
			break;

		case CFG_VAR_UINT:
			fprintf(fd, "%s%u\n", pEntry->tag, *(unsigned int *)pEntry->varAddr);			
			break;

		case CFG_VAR_SHORT:
		case CFG_VAR_USHORT:
			fprintf(fd, "%s%hu\n", pEntry->tag, *(short *)pEntry->varAddr);
			break;
	
		case CFG_VAR_STR:			
			fprintf(fd, "%s%s\n", pEntry->tag, (char *)pEntry->varAddr);
			break;
		}

		pEntry = &CfgDesc[++i]; 		
	}

	fclose(fd);

	return 1;
}

// Find configuration entry descriptor
static cfg_descriptor_entry_t *config_find_param(char *string_in)
{
	cfg_descriptor_entry_t *pEntry;
	int i;

	if ((!string_in) || (strlen(string_in) == 0))
		return NULL;

	i = 0;
	pEntry = &CfgDesc[i]; 
	while (pEntry->varType != CFG_VAR_NONE)
	{
		pEntry = &CfgDesc[i]; 

		if (strncasecmp(string_in, pEntry->tag, strlen(pEntry->tag)) == 0)
			return pEntry;

		i++;
	}

	return NULL;
}

// Load configuration parameter according to its type
int config_load_entry(cfg_descriptor_entry_t *pEntry, char *string_in, char *errstr)
{
	char *p;
	int len;
	int value_len;

	len = (int)strlen(pEntry->tag);
	p = &string_in[len];

	switch (pEntry->varType)
	{		
	case CFG_VAR_INT:
		*(int *)pEntry->varAddr = (int)atoi(p);
		break;

	case CFG_VAR_UINT:
		*(unsigned int *)pEntry->varAddr = (unsigned int)atoi(p);
		break;

	case CFG_VAR_SHORT:
		*(short *)pEntry->varAddr = (short)atoi(p);
		break;

	case CFG_VAR_USHORT:
		*(unsigned short *)pEntry->varAddr = (short)atoi(p);
		break;

	case CFG_VAR_STR:		
		value_len = (int)strlen(p);		
		if (value_len >= pEntry->varSize)
		{
			strcpy(errstr, "string value too long");
			return 0;
		}

		strcpy((char *)pEntry->varAddr, p);
		break;

	case CFG_VAR_BOOLINT:
		*(int *)pEntry->varAddr = (int)1;
		break;		
	}

	return 1;
}

// get file size
static long get_filesize(FILE *fp)
{
	long sz = 0;
	
	fseek(fp, 0L, SEEK_END);
	sz = ftell(fp);
	fseek(fp, 0L, SEEK_SET);

	return sz;
}



