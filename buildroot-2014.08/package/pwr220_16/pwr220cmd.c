/*
 * Daemon command line interface
 */
#include "pwr220.h"

// Get local hostname
static void get_hostname(void)
{
	char buffer[512];
	FILE *p;

	p = popen("cat /etc/hostname", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);
		
		printf("%s", buffer);
	}
}

// Get local IP address
static void get_ipaddress(void)
{
	char buffer[512];
	FILE *p;
	char *cp;

	p = popen("ip addr show eth0 | grep inet", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);
		
		cp = strchr(buffer, '/');
		if (cp)
		{
			*cp = 0x00;				
			cp = strstr(buffer, "inet ");
			if (cp)
			{
				cp += 5;
				printf("%s\n", cp);
			}				
		}
	}
}

// Get netmask
static void get_netmask(void)
{
	char buffer[512];
	FILE *p;
	char *cp;

	p = popen("ifconfig -a eth0 | grep Mask", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);
		
		cp = strchr(buffer, '\r');
		if (!cp) cp = strchr(buffer, '\n');
		if (cp) *cp = 0x00;

		cp = strstr(buffer, "Mask:");
		if (cp)
		{
			cp += 5;
			printf("%s\n", cp);
		}
	}
}

// Get MAC address
static void get_mac_address(void)
{
	char buffer[512];
	FILE *p;
	char *cp;

	p = popen("ifconfig -a eth0 | grep HWaddr", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);
		
		cp = strchr(buffer, '\r');
		if (!cp) cp = strchr(buffer, '\n');
		if (cp) *cp = 0x00;

		cp = strstr(buffer, "HWaddr ");
		if (cp)
		{
			cp += 7;
			printf("%s\n", cp);
		}
	}
}

// Get HTTP port
static void get_http_port(void)
{
	char buffer[512];
	FILE *p;
	char *cp;

	p = popen("cat /etc/lighttpd/lighttpd.conf | grep server.port", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);
		
		cp = strchr(buffer, '\r');
		if (!cp) cp = strchr(buffer, '\n');
		if (cp) *cp = 0x00;

		cp = strstr(buffer, "= ");
		if (cp)
		{
			cp += 2;
			printf("%s\n", cp);
		}
	}
}

// Get NTP server
static void get_ntp_server(int n)
{
	switch (n)
	{
	case 0: printf("%s\n", pwr220Cfg.network.ntp_server0); break;
	case 1: printf("%s\n", pwr220Cfg.network.ntp_server1); break;
	case 2: printf("%s\n", pwr220Cfg.network.ntp_server2); break;
	}
}

// Get uptime
static void get_uptime(void)
{
	system("uptime | sed 's/.*up \\([^,]*\\), .*/\\1/'");
}

// Get current time
static void get_time(void)
{
	system("date");
}

// Get version
static void get_version(void)
{
	printf("%s\n", SYSTEM_VERSION);
}

static void get_serial(void)
{
	printf("%s\n", serialNum);
}

// Set system time
static void set_time(char *timespec)
{
	char cmdstr[256];

	sprintf(cmdstr, "date -s %s", timespec);
	system(cmdstr);
}

// Get Dhcp enabled status
static void get_dhcp(void)
{
	char buffer[512];
	FILE *p;
	char *cp;

	p = popen("cat /etc/network/interfaces | grep \"iface eth0 inet\"", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);
		
		cp = strstr(buffer, "dhcp");
		if (cp)
		{
			printf("checked\n");
		}
	}	
}

// Get default gateway
static void get_gateway(void)
{
	char buffer[512];
	FILE *p;
	char *cp, *cp1;

	p = popen("ip route show | grep \"default via \"", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);

		cp = strchr(buffer, '\r');
		if (!cp) cp = strchr(buffer, '\n');
		if (cp) *cp = 0x00;

		cp = strstr(buffer, "default via ");
		if (cp)
		{
			cp += 12;

			cp1 = strchr(cp, ' ');
			if (cp1)
			{
				*cp1 = 0x00;
				printf("%s\n", cp);
			}			
		}
	}
}

// Get DNS server address
static void get_dns_server(void)
{
	char buffer[512];
	FILE *p;
	char *cp;

	sprintf(buffer, "cat %s | grep nameserver", RESOLVECFGPATH);
	p = popen(buffer, "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);

		cp = strchr(buffer, '\r');
		if (!cp) cp = strchr(buffer, '\n');
		if (cp) *cp = 0x00;

		cp = strstr(buffer, "nameserver ");
		if (cp)
		{			
			cp += 11;
			printf("%s\n", cp);
		}		
	}
}

// Get current rootfs name
static int get_current_rootfs_name(char *curName)
{
	char buffer[512];
	FILE *p;
	char *cp;
	
	p = popen("cat /proc/cmdline", "r");
	if (p)
	{
	    memset(buffer, 0, sizeof(buffer));
	    fgets(&buffer[0], sizeof(buffer), p);
   		pclose(p);

		cp = strchr(buffer, '\r');
		if (!cp) cp = strchr(buffer, '\n');
		if (cp) *cp = 0x00;

		cp = strstr(buffer, "root=ubi0:");
		if (!cp) return 0;

		if (sscanf(&cp[10], "%s", curName) != 1)
			return 0;

		return 1;
	}

	return 0;
}

// Handle rootfs upgrade
static void upgrade_rootfs(char *uploadRootfsPath)
{
	char currRootFs[64] = "";
	char *target_vol = NULL;
	char cmdStr[128];

	if (!get_current_rootfs_name(currRootFs))
	{
		printf("Failed");
		return;
	}

	if (system("mkdir -p /mnt/alt_fs") == -1)
	{
		printf("Failed to create mount dir\n");
		return;
	}

	target_vol = (strcmp(currRootFs, "rootfs1") == 0) ? "0" : "1";

	sprintf(cmdStr, "ubiupdatevol /dev/ubi0_%s -t", target_vol);
	if (system(cmdStr) == -1)
	{
		printf("Failed to erase ubi volume\n");
		return;
	}

	sprintf(cmdStr, "mount -t ubifs ubi0_%s /mnt/alt_fs", target_vol);
	if (system(cmdStr) == -1)
	{
		printf("Failed to mount ubi volume\n");
		return;
	}

	system("bzip2 -cd /tmp/rootfs.tar.bz2 > /tmp/rootfs.tar");
	system("rm -f /tmp/rootfs.tar.bz2");
	system("tar -xvf /tmp/rootfs.tar -C /mnt/alt_fs/");
	system("rm -f /tmp/rootfs.tar");

	// instead, set the flag for the uboot to tell that the loading of the current rootfs failed
	#if 0
	sprintf(cmdStr, "fw_setenv bootargs noinitrd console=ttyAM0,115200 ubi.mtd=1 root=ubi0:rootfs%s rootfstype=ubifs rw gpmi", target_vol);
	if (system(cmdStr) == -1)
	{
		printf("Failed to set next boot to rootfs%s\n", target_vol);
		return;
	}
	#endif

	// set the flag for the uboot to tell that the loading of the current rootfs failed
	// on next reboot, uboot shall switch to alternate rootfs automatically
	system("echo 0x33333333 > /sys/class/rtc/rtc0/device/scratch5");
	
	printf("OK: saved to rootfs%s\n", target_vol);	
}

// Handle kernel upgrade
static void upgrade_kernel(char *uploadKernelPath)
{
	char cmdStr[128];
	unsigned int startAddr[2] = {0xbe0000, 0xfa0000};
	unsigned int maxBlocks = 30;
	unsigned int sectorSize = 0x20000;
	unsigned int i, n, addr;

	for (n=0; n<2; n++)
	{
		addr = startAddr[n];
		for (i=0; i<maxBlocks; i++)
		{
			sprintf(cmdStr, "flash_erase /dev/mtd0 0x%x 1", addr);
			system(cmdStr);
			addr += sectorSize;
		}

		sprintf(cmdStr, "nandwrite -p /dev/mtd0 -s 0x%x /tmp/uImage", startAddr[n]);
		system(cmdStr);
	}

	printf("OK\n");	
}

static int args_to_config(int argc, char* argv[], int i)
{	
	pwr220Cfg.network.dhcp_enable = 0;
	
	i++;
	while (i < argc)
	{		
		if (strncmp(argv[i], "devname=", 8) == 0)
			snprintf(pwr220Cfg.network.device_name, sizeof(pwr220Cfg.network.device_name), "%s", &argv[i][8]);
		else if (strncmp(argv[i], "devipaddr=", 10) == 0)
			snprintf(pwr220Cfg.network.ip_address, sizeof(pwr220Cfg.network.ip_address), "%s", &argv[i][10]);
		else if (strncmp(argv[i], "netmask=", 8) == 0)
			snprintf(pwr220Cfg.network.ip_mask, sizeof(pwr220Cfg.network.ip_mask), "%s", &argv[i][8]);
		else if (strncmp(argv[i], "gateway=", 8) == 0)
			snprintf(pwr220Cfg.network.ip_gateway, sizeof(pwr220Cfg.network.ip_gateway), "%s", &argv[i][8]);
		else if (strncmp(argv[i], "macaddr=", 8) == 0)
			snprintf(pwr220Cfg.network.mac_addr, sizeof(pwr220Cfg.network.mac_addr), "%s", &argv[i][8]);
		else if (strncmp(argv[i], "dns=", 4) == 0)
			snprintf(pwr220Cfg.network.dns_server, sizeof(pwr220Cfg.network.dns_server), "%s", &argv[i][4]);
		else if (strncmp(argv[i], "httpport=", 9) == 0)
			pwr220Cfg.network.http_port = (unsigned short)atoi(&argv[i][9]);
		else if (strncmp(argv[i], "ntpserver0=", 11) == 0)
			snprintf(pwr220Cfg.network.ntp_server0, sizeof(pwr220Cfg.network.ntp_server0), "%s", &argv[i][11]);
		else if (strncmp(argv[i], "ntpserver1=", 11) == 0)
			snprintf(pwr220Cfg.network.ntp_server1, sizeof(pwr220Cfg.network.ntp_server1), "%s", &argv[i][11]);
		else if (strncmp(argv[i], "ntpserver2=", 11) == 0)
			snprintf(pwr220Cfg.network.ntp_server2, sizeof(pwr220Cfg.network.ntp_server2), "%s", &argv[i][11]);
		else if (strncmp(argv[i], "dhcp=yes", 8) == 0)
			pwr220Cfg.network.dhcp_enable = 1;
		
		i++;
	}

	return i;
}

// Apply configuration from pwr220Cfg config structure to various Linux system files
static void apply_config(void)
{
	FILE *netFile, *resolveFile, *hosnameFile, *f;
	char cmdbuf[256];
	
	if (strlen(pwr220Cfg.network.device_name))
	{
		hosnameFile = fopen(HOSTNAMEPATH, "w");
		if (!hosnameFile) 
		{
			printf("Failed to open hostname config file\n");
			return;
		}

		fprintf(hosnameFile, "%s\n", pwr220Cfg.network.device_name);
		fclose(hosnameFile);
	}

	netFile = fopen(NETCFGPATH, "w");
	if (!netFile) 
	{
		printf("Failed to open network config file\n");
		return;
	}

	fprintf(netFile, "%s\n", "auto lo");
	fprintf(netFile, "%s\n", "auto eth0");
	fprintf(netFile, "iface eth0 inet %s\n", (pwr220Cfg.network.dhcp_enable == 0) ? "static" : "dhcp");

	if (pwr220Cfg.network.dhcp_enable == 0)
	{
		fprintf(netFile, " address %s\n", pwr220Cfg.network.ip_address);
		fprintf(netFile, " netmask %s\n", pwr220Cfg.network.ip_mask);
		fprintf(netFile, " gateway %s\n", pwr220Cfg.network.ip_gateway);
	}

	fprintf(netFile, " hwaddress ether %s\n", pwr220Cfg.network.mac_addr);

	fclose(netFile);

	if (strlen(pwr220Cfg.network.dns_server))
	{
		resolveFile = fopen(RESOLVECFGPATH, "w");
		if (!resolveFile) 
		{
			printf("Failed to open resolve config file\n");
			return;
		}

		fprintf(resolveFile, "nameserver %s\n", pwr220Cfg.network.dns_server);
		fclose(resolveFile);
	}

	sprintf(cmdbuf, "sed -i 's/.*server.port.*/server.port = %hu/' /etc/lighttpd/lighttpd.conf", pwr220Cfg.network.http_port);
	system(cmdbuf);

	// NTPD configuration
	f = fopen(NTPDCONF_PATH, "w");
	if (f)
	{
		if (strlen(pwr220Cfg.network.ntp_server0))
			fprintf(f, "server %s iburst\n", pwr220Cfg.network.ntp_server0);

		if (strlen(pwr220Cfg.network.ntp_server1))
			fprintf(f, "server %s iburst\n", pwr220Cfg.network.ntp_server1);

		if (strlen(pwr220Cfg.network.ntp_server2))
			fprintf(f, "server %s iburst\n", pwr220Cfg.network.ntp_server2);

		fprintf(f, "%s\n", "restrict default kod nomodify notrap nopeer noquery");
		fprintf(f, "%s\n", "restrict -6 default kod nomodify notrap nopeer noquery");
		fprintf(f, "%s\n", "restrict 127.0.0.1");
		fprintf(f, "%s\n", "restrict -6 ::1");

		fclose(f);
	}	
}

// Import configuration
static void import_config(char *configPath)
{
	if (!ConfigLoad(configPath, SERIAL_PATH))
		ConfigSave(configPath);

	apply_config();
	
	printf("OK\n");	
}

// Print configuration
static void print_config(void)
{
	ConfigLoad(CONFIG_PATH, SERIAL_PATH);
	
	printf("Dev name=%s\n", pwr220Cfg.network.device_name);
	printf("MAC Address=%s\n", pwr220Cfg.network.mac_addr);
	printf("DHCP=%s\n", pwr220Cfg.network.dhcp_enable ? "yes" : "no");
	printf("IP address=%s\n", pwr220Cfg.network.ip_address);
	printf("IP mask=%s\n", pwr220Cfg.network.ip_mask);
	printf("IP gateway=%s\n", pwr220Cfg.network.ip_gateway);
	printf("IP DNS=%s\n", pwr220Cfg.network.dns_server);
	printf("HTTP port=%hu\n", pwr220Cfg.network.http_port);
	printf("NTP Server0=%s\n", pwr220Cfg.network.ntp_server0);
	printf("NTP Server1=%s\n", pwr220Cfg.network.ntp_server1);
	printf("NTP Server2=%s\n", pwr220Cfg.network.ntp_server2);
}

int main (int argc, char* argv[]) 
{
	int i = 0;
	
	if (argc < 2)
		return 0;

	i++;

	if (strncmp(argv[i], "get-", 4) == 0)
	{
		// always load existing config first
		ConfigLoad(CONFIG_PATH, SERIAL_PATH);
		
		if (strcmp(argv[i], "get-devname") == 0)
			get_hostname();		
		else if (strcmp(argv[i], "get-devipaddr") == 0)
			get_ipaddress();
		else if (strcmp(argv[i], "get-netmask") == 0)
			get_netmask();
		else if (strcmp(argv[i], "get-dhcp") == 0)
			get_dhcp();
		else if (strcmp(argv[i], "get-gateway") == 0)
			get_gateway();
		else if (strcmp(argv[i], "get-dns") == 0)
			get_dns_server();
		else if (strcmp(argv[i], "get-mac") == 0)
			get_mac_address();
		else if (strcmp(argv[i], "get-httpport") == 0)
			get_http_port();
		else if (strcmp(argv[i], "get-uptime") == 0)
			get_uptime();
		else if (strcmp(argv[i], "get-ntpserver0") == 0)
			get_ntp_server(0);
		else if (strcmp(argv[i], "get-ntpserver1") == 0)
			get_ntp_server(1);
		else if (strcmp(argv[i], "get-ntpserver2") == 0)
			get_ntp_server(2);
		else if (strcmp(argv[i], "get-ver") == 0)
			get_version();
		else if (strcmp(argv[i], "get-serial") == 0)
			get_serial();
		else if (strcmp(argv[i], "get-time") == 0)
			get_time();
		else if (strcmp(argv[i], "get-rootfs") == 0)
		{
			char rootfsName[64];
			get_current_rootfs_name(rootfsName);
			printf("%s\n", rootfsName);
		}
	}
	else if (strncmp(argv[i], "set", 3) == 0)
	{
		// always load existing config first
		ConfigLoad(CONFIG_PATH, SERIAL_PATH);
		
		i = args_to_config(argc, argv, i);

		apply_config();

		ConfigSave(CONFIG_PATH);
	}
	else if (strncmp(argv[i], "upgrade-rootfs-", 15) == 0)
	{		
		upgrade_rootfs(&argv[i][15]);
	}
	else if (strncmp(argv[i], "upgrade-kernel-", 15) == 0)
	{		
		upgrade_kernel(&argv[i][15]);
	}
	else if (strncmp(argv[i], "import-cfg-", 11) == 0)
	{		
		import_config(&argv[i][11]);
	}
	else if (strncmp(argv[i], "time-set=", 9) == 0)
	{		
		set_time(&argv[i][9]);
	}
	else if (strncmp(argv[i], "print-cfg", 9) == 0)
	{		
		print_config();
	}

    return 0;
}

