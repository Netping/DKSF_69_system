################################################################################
#
# pwr220_16
#
################################################################################

# source included in buildroot
PWR220_16_SOURCE =

define PWR220_16_BUILD_CMDS
	$(TARGET_CC) $(TARGET_CFLAGS) $(TARGET_LDFLAGS) \
		package/pwr220_16/pwr220cmd.c package/pwr220_16/pwr220cfg.c -o $(@D)/pwr220cmd
endef

define PWR220_16_INSTALL_TARGET_CMDS
	install -D -m 755 $(@D)/pwr220cmd $(TARGET_DIR)/usr/bin/pwr220cmd
	install -D -m 775 package/pwr220_16/index.php $(TARGET_DIR)/var/www/index_dev.php
	install -D -m 775 package/pwr220_16/pwr220_16.init $(TARGET_DIR)/etc/init.d/S30pwr220_16
	cp -a package/pwr220_16/DKST_69_web/. $(TARGET_DIR)/var/www/
endef

define PWR220_16_UNINSTALL_TARGET_CMDS
	rm -f $(TARGET_DIR)/usr/bin/pwr220cmd
	rm -f $(TARGET_DIR)/var/www/index.php
	rm -f $(TARGET_DIR)/etc/init.d/S30pwr220_16
endef

$(eval $(generic-package))
