/*
 * Configuration interface
 */
#ifndef PWR220_16_CFG_H
#define PWR220_16_CFG_H

#define PWR220_CFG_DEF_DEVICE_NAME "TestDevice"
#define PWR220_CFG_DEF_IP_ADDRESS "192.168.1.32"
#define PWR220_CFG_DEF_IP_MASK "255.255.255.0"
#define PWR220_CFG_DEF_IP_GATEWAY "192.168.1.1"
#define PWR220_CFG_DEF_DNS_SERVER "8.8.8.8"
#define PWR220_CFG_DEF_MAC "00:01:02:03:04:05"
#define PWR220_CFG_DEF_DHCP_ENABLE 0
#define PWR220_CFG_DEF_HTTP_PORT 80
#define PWR220_CFG_DEF_NTPSERVER0 "0.pool.ntp.org"
#define PWR220_CFG_DEF_NTPSERVER1 "1.pool.ntp.org"
#define PWR220_CFG_DEF_NTPSERVER2 "2.pool.ntp.org"

typedef enum
{
	CFG_VAR_NONE,
	CFG_VAR_INT,
	CFG_VAR_UINT,
	CFG_VAR_SHORT,
	CFG_VAR_USHORT,
	CFG_VAR_STR,
	CFG_VAR_BOOLINT,		// if an tag is present, set the variable to 1
} cfg_var_types_t;

// configuration entry descriptor
typedef struct
{
	void			*varAddr;
	int				varType;
	int				varSize;	// used with string type
	char			tag[64];		
} cfg_descriptor_entry_t;

typedef struct
{
	char device_name[64];			// device name
	char ip_address[64];			// ip address
	char ip_mask[64];				// ip mask
	char ip_gateway[64];			// ip gateway
	char mac_addr[64];				// mac address
	char dns_server[64];			// dns server
	char ntp_server0[128];			// NTP server 0
	char ntp_server1[128];			// NTP server 1
	char ntp_server2[128];			// NTP server 2
	int dhcp_enable;				// 0=DHCP disabled, 1=DHCP enabled
	unsigned short http_port;		// HTTP web interface port
} pwr220_network_cfg_t;

typedef struct
{
	pwr220_network_cfg_t network;	// Network related configuration
} pwr220_cfg_t;

/*
 * Load and parse configuration
 * Loads structure pCfg with configuration parameters read from config file
 */
extern int ConfigLoad(char *fileName, char *serialPath);

/*
 * Save configurartion to file
 */
extern int ConfigSave(char *fileName);

extern pwr220_cfg_t pwr220Cfg;
extern char serialNum[64];

#endif // PWR220_16_CFG_H

