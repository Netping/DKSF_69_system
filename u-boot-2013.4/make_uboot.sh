#!/bin/sh
make CROSS_COMPILE=/home/user/gcc-arm-none-eabi-4_8-2014q1/bin/arm-none-eabi- ARCH=arm distclean
make CROSS_COMPILE=/home/user/gcc-arm-none-eabi-4_8-2014q1/bin/arm-none-eabi- ARCH=arm mx28evk_nand_config
make CROSS_COMPILE=/home/user/gcc-arm-none-eabi-4_8-2014q1/bin/arm-none-eabi- ARCH=arm u-boot.sb
#make CROSS_COMPILE=/opt/arm-2011.03/bin/arm-none-linux-gnueabi-  ARCH=arm u-boot.sb
cp -fr u-boot.sb imx28_ivt_uboot.sb
