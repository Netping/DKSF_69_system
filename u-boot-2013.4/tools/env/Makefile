#
# (C) Copyright 2002-2006
# Wolfgang Denk, DENX Software Engineering, wd@denx.de.
#
# See file CREDITS for list of people who contributed to this
# project.
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation; either version 2 of
# the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston,
# MA 02111-1307 USA
#

include $(TOPDIR)/config.mk

HOSTSRCS := $(SRCTREE)/lib/crc32.c  fw_env.c  fw_env_main.c
HOSTSRCS += $(SRCTREE)/lib/ctype.c $(SRCTREE)/lib/linux_string.c
HOSTSRCS += $(SRCTREE)/common/env_attr.c $(SRCTREE)/common/env_flags.c
HEADERS	:= fw_env.h $(OBJTREE)/include/config.h

# Compile for a hosted environment on the target
HOSTCPPFLAGS  = -idirafter $(SRCTREE)/include \
		-idirafter $(OBJTREE)/include2 \
		-idirafter $(OBJTREE)/include \
		-idirafter $(SRCTREE)/tools/env \
		-DUSE_HOSTCC \
		-DTEXT_BASE=$(TEXT_BASE)

ifeq ($(MTD_VERSION),old)
HOSTCPPFLAGS += -DMTD_OLD
endif

HOSTCC := /opt/arm-2011.03/bin/arm-none-linux-gnueabi-gcc

all:	$(obj)fw_printenv

# Some files complain if compiled with -pedantic, use HOSTCFLAGS_NOPED
$(obj)fw_printenv:	$(HOSTSRCS) $(HEADERS)
	$(HOSTCC) $(HOSTCFLAGS_NOPED) -static $(HOSTLDFLAGS) -o $@ $(HOSTSRCS)
	$(HOSTSTRIP) $@

clean:
	rm -f $(obj)fw_printenv

#########################################################################

include $(TOPDIR)/rules.mk

sinclude $(obj).depend

#########################################################################
