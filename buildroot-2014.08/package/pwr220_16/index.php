<html>
<head>
<title>Netping 16/PWR-220</title></head>
<body>
<p align="center">
<table border="0" cellpadding="10">
<tr>
  <td>&nbsp;</td>
  <td>
  	<h1>&nbsp;&nbsp;&nbsp;&nbsp;Netping 16/PWR220 Configuration</h1>
  	<?php
  		$cmdpath = "/usr/bin/pwr220cmd ";
  		$current_rootfs = exec("$cmdpath get-rootfs");
  		echo "<p><i>(using $current_rootfs)</i></p>";
  	?>  	
  </td>
</tr>
<tr valign="top">
  <td><h3> Global settings </h3></td>
  <td>
	<?php
    	$action = $_POST["act"];
    	$isSave = 0;

		function buffer_flush(){
  			echo '<!-- -->'; // ?
  			ob_flush();
  			flush();
		}
		
		if (strcmp($action, "save") == 0)
		{
			$isSave = 1;
		
			$devname = $_POST["dev_name"];
			$devipadr = $_POST["dev_ip_address"];
			$devmask = $_POST["dev_ip_mask"];
			$devgate = $_POST["dev_ip_gateway"];
			$devdns = $_POST["dev_dns_server"];
			$devdhcp = $_POST["dhcp_enable"];
			
			$setCmd = "set devname=$devname devipaddr=$devipadr netmask=$devmask gateway=$devgate dns=$devdns dhcp=$devdhcp";

			exec("$cmdpath $setCmd");
		
			echo "<br><font color=\"red\"> Changes applied successfully! (Reboot required for settings to take effect!) </font>";
		}
	?>
  <FORM action="index.php" method="post">
<table border="0">
<?php
	if ($isSave == 0)
	{
		$device_hostname = exec("$cmdpath get-devname");
		$devip = exec("$cmdpath get-devipaddr");
		$netmask = exec("$cmdpath get-netmask");
		$dhcp = exec("$cmdpath get-dhcp");
		$gateway = exec("$cmdpath get-gateway");
		$dnssrv = exec("$cmdpath get-dns");
	}
	else
	{
		$device_hostname = $devname;
		$devip = $devipadr;
		$netmask = $devmask;
		
		if (strcmp($devdhcp, "yes") == 0)
			$dhcp = "checked";
		else
			$dhcp = "";

		$gateway = $devgate;
		$dnssrv = $devdns;
	}
	
	echo "<tr><td><INPUT type=\"checkbox\" name=\"dhcp_enable\" value=\"yes\" $dhcp> Get settings by DHCP</td><td> </td></tr>";
	echo "<tr><td>Device Name:</td><td><INPUT type=\"text\" name=\"dev_name\" value=\"$device_hostname\"></td></tr>";
	echo "<tr><td>IP Address:</td><td><INPUT type=\"text\" name=\"dev_ip_address\" value=\"$devip\"></td></tr>";
	echo "<tr><td>IP Mask:</td><td><INPUT type=\"text\" name=\"dev_ip_mask\" value=\"$netmask\"></td></tr>";
	echo "<tr><td>IP Gateway:</td><td><INPUT type=\"text\" name=\"dev_ip_gateway\" value=\"$gateway\"></td></tr>";
	echo "<tr><td>DNS server:</td><td><INPUT type=\"text\" name=\"dev_dns_server\" value=\"$dnssrv\"></td></tr>";
	echo "<input type=\"hidden\" name=\"act\" value=\"save\">";
?>
</table>
<BR>
<input type="submit" value="Save Settings">
</td>
</FORM>
  </td>
</tr>

<tr valign="top">
   <td><h3> Firmware Upgrade</h3></td>
   <td>

      <?php
			if (strcmp($action, "upgrade") == 0)
			{
				$firmwareFilename = "rootfs.tar.bz2";
				$upgradeCmdArg = "upgrade-rootfs-";
				$fileError = $_FILES["file"]["error"];
				$cmdRes = "";

				$update_target=$_POST["update_target"];

				if (strcmp($update_target, "kernel") == 0)
				{
					$firmwareFilename = "uImage";
					$upgradeCmdArg = "upgrade-kernel-";
				}

				echo "<i>** upgrading: $update_target **</i><br>";
			
				if ($fileError == 0)
				{
					$upload_fname = $_FILES["file"]["name"];
					$temp_name = $_FILES["file"]["tmp_name"];

					if (strcmp($upload_fname, $firmwareFilename) != 0)
					{
						echo "<br><p><font color=\"red\"> <b>Firmware, upgrade failed! (unsupported filename, expected $firmwareFilename) </b> </font></p>";
					}
					else if (move_uploaded_file($temp_name, "/tmp/$upload_fname"))
					{						
	      				echo "<p><font color=\"red\"> <b>Firmware upgrade in-progress, please wait!</b></font></p>";
	      				buffer_flush();

						$cmdRes = exec("$cmdpath $upgradeCmdArg/tmp/$upload_fname");
						if (strncmp($cmdRes, "OK", 2) == 0)
						{
							echo "<p><font color=\"red\"> <b>Firmware, upgrade $cmdRes. Click \"Reboot\" to reload the device </b></font></p>";
						}
						else
						{
							echo "<p><font color=\"red\"> <b>Firmware, upgrade failed: $cmdRes </b> </font></p>";
						}	      				
	      			}
	      			else
	      			{
	      				echo "<p><font color=\"red\"> <b>Firmware, upgrade failed! (save failed) </b> </font></p>";
	      			}
				}
				else
				{
					$error_types = array( 
					1=>'File exceeds maximum size supported by device', 
					'File exceeds maximum allowed size', 
					'File upload did not finish', 
					'No file uploaded', 
					6=>'Missing a temp folder', 
					'Failed to save file to disk', 
					'A PHP extension stopped the file upload' 
					); 

					$error_message = $error_types[$fileError]; 
				
					echo "<p><font color=\"red\"> <b>Firmware, upgrade failed! ($error_message)</b> </font></p>";
				}			
			}
	  ?>   
   
      <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file"><br /><br />
        <select name="update_target">
        	<option value="main" selected="selected">Main image</option>
        	<option value="kernel">Kernel</option>
        </select>
        <input type="submit" name="submit" value="Start Upgrade">
        <input type="hidden" name="act" value="upgrade">
      </form>
   </td>
</tr>

<tr valign="top">
   <td><h3> Device Reboot</h3></td>
   <td>
   
      <?php
      		$autoReloadSecs = 70;
			if (strcmp($action, "reboot") == 0)
			{			
				echo "<br><p><font color=\"red\"> <b>Device is Rebooting! Please please wait....</b> </font><br><i>(this page will auto-reload in $autoReloadSecs seconds)</i></p>";
				header("Refresh: $autoReloadSecs; url=index.php");
				exec("(sleep 5 ; reboot -f ) > /dev/null 2>&1  &");
			}
	  ?>   

      <form method="post" action="index.php" name="submit">
        <input type="submit" name="submit" value="Reboot">
        <input type="hidden" name="act" value="reboot">
	  </form>
   </td>
</tr>

</table>
</p>
</body>
</html>
