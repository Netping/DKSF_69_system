# This file contains toolchain-related customisation of the content
# of the target/ directory. Those customisations are added to the
# TARGET_FINALIZE_HOOKS, to be applied just after all packages
# have been built.

# Install the gconv modules
ifeq ($(BR2_TOOLCHAIN_GLIBC_GCONV_LIBS_COPY),y)
GCONV_LIBS = $(call qstrip,$(BR2_TOOLCHAIN_GLIBC_GCONV_LIBS_LIST))
define COPY_GCONV_LIBS
	$(Q)if [ -z "$(GCONV_LIBS)" ]; then \
		$(INSTALL) -m 0644 -D $(STAGING_DIR)/usr/lib/gconv/gconv-modules \
				      $(TARGET_DIR)/usr/lib/gconv/gconv-modules; \
		$(INSTALL) -m 0644 $(STAGING_DIR)/usr/lib/gconv/*.so \
				   $(TARGET_DIR)/usr/lib/gconv \
		|| exit 1; \
	else \
		for l in $(GCONV_LIBS); do \
			$(INSTALL) -m 0644 -D $(STAGING_DIR)/usr/lib/gconv/$${l}.so \
					      $(TARGET_DIR)/usr/lib/gconv/$${l}.so \
			|| exit 1; \
			$(TARGET_READELF) -d $(STAGING_DIR)/usr/lib/gconv/$${l}.so |\
			sort -u |\
			sed -e '/.*(NEEDED).*\[\(.*\.so\)\]$$/!d; s//\1/;' |\
			while read lib; do \
				 $(INSTALL) -m 0644 -D $(STAGING_DIR)/usr/lib/gconv/$${lib} \
						       $(TARGET_DIR)/usr/lib/gconv/$${lib} \
				 || exit 1; \
			done; \
		done; \
		./support/scripts/expunge-gconv-modules "$(GCONV_LIBS)" \
			<$(STAGING_DIR)/usr/lib/gconv/gconv-modules \
			>$(TARGET_DIR)/usr/lib/gconv/gconv-modules; \
	fi
endef
TARGET_FINALIZE_HOOKS += COPY_GCONV_LIBS
endif
