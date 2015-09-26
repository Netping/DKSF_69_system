/*
 * DENX M28 module
 *
 * Copyright (C) 2011 Marek Vasut <marek.vasut@gmail.com>
 * on behalf of DENX Software Engineering GmbH
 *
 * See file CREDITS for list of people who contributed to this
 * project.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as
 * published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston,
 * MA 02111-1307 USA
 */

#include <common.h>
#include <asm/gpio.h>
#include <asm/io.h>
#include <asm/arch/imx-regs.h>
#include <asm/arch/iomux-mx28.h>
#include <asm/arch/clock.h>
#include <asm/arch/sys_proto.h>
#include <linux/mii.h>
#include <miiphy.h>
#include <netdev.h>
#include <errno.h>

DECLARE_GLOBAL_DATA_PTR;

/*
 * Functions
 */
int board_early_init_f(void)
{
	/* IO0 clock at 480MHz */
	mxs_set_ioclk(MXC_IOCLK0, 480000);
	/* IO1 clock at 480MHz */
	mxs_set_ioclk(MXC_IOCLK1, 480000);

	/* SSP0 clock at 96MHz */
	mxs_set_sspclk(MXC_SSPCLK0, 96000, 0);
	/* SSP2 clock at 160MHz */
	mxs_set_sspclk(MXC_SSPCLK2, 160000, 0);

#ifdef	CONFIG_CMD_USB
	mxs_iomux_setup_pad(MX28_PAD_PWM2__USB1_OVERCURRENT);
	mxs_iomux_setup_pad(MX28_PAD_LCD_RD_E__GPIO_1_24 |
			MXS_PAD_12MA | MXS_PAD_3V3 | MXS_PAD_PULLUP);
	gpio_direction_output(MX28_PAD_LCD_RD_E__GPIO_1_24, 1);

	mxs_iomux_setup_pad(MX28_PAD_LCD_CS__GPIO_1_27 |
			MXS_PAD_12MA | MXS_PAD_3V3 | MXS_PAD_PULLUP);
	gpio_direction_output(MX28_PAD_LCD_CS__GPIO_1_27, 1);
#endif

	return 0;
}

int board_init(void)
{
	/* Adress of boot parameters */
	gd->bd->bi_boot_params = PHYS_SDRAM_1 + 0x100;

	return 0;
}

int dram_init(void)
{
	return mxs_dram_init();
}

#ifdef	CONFIG_CMD_MMC
static int m28_mmc_wp(int id)
{
	if (id != 0) {
		printf("MXS MMC: Invalid card selected (card id = %d)\n", id);
		return 1;
	}

	return 0; //ruslan
}

int board_mmc_init(bd_t *bis)
{
	return mxsmmc_initialize(bis, 0, m28_mmc_wp, NULL);
}
#endif

#ifdef	CONFIG_CMD_NET

int board_eth_init(bd_t *bis)
{
	struct mxs_clkctrl_regs *clkctrl_regs =
		(struct mxs_clkctrl_regs *)MXS_CLKCTRL_BASE;
	struct eth_device *dev;
	int ret;

	ret = cpu_eth_init(bis);

	/* MX28EVK uses ENET_CLK PAD to drive FEC clock */
        writel(CLKCTRL_ENET_TIME_SEL_RMII_CLK | CLKCTRL_ENET_CLK_OUT_EN,
                                     &clkctrl_regs->hw_clkctrl_enet);
                                                 
        /* Reset FEC PHYs */
        gpio_direction_output(MX28_PAD_ENET0_RX_CLK__GPIO_4_13, 0);
        udelay(200);
        gpio_set_value(MX28_PAD_ENET0_RX_CLK__GPIO_4_13, 1);

        ret = fecmxc_initialize_multi(bis, 0, 0, MXS_ENET0_BASE);
        if (ret) {
                 puts("FEC MXS: Unable to init FEC0\n");
                 return ret;
        }

        ret = fecmxc_initialize_multi(bis, 1, 3, MXS_ENET1_BASE);
        if (ret) {
                 puts("FEC MXS: Unable to init FEC1\n");
                 return ret;
        }

        dev = eth_get_dev_by_name("FEC0");
        if (!dev) {
                 puts("FEC MXS: Unable to get FEC0 device entry\n");
                 return -EINVAL;
        }

        dev = eth_get_dev_by_name("FEC1");
        if (!dev) {
                 puts("FEC MXS: Unable to get FEC1 device entry\n");
                 return -EINVAL;
        }

        return ret;
}


#endif
