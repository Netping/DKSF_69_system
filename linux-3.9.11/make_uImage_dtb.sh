#!/bin/sh


          make -j2 CROSS_COMPILE=/opt/arm-2011.03/bin/arm-none-linux-gnueabi- ARCH=arm uImage
          make -j2 CROSS_COMPILE=/opt/arm-2011.03/bin/arm-none-linux-gnueabi- ARCH=arm imx28-evk.dtb

