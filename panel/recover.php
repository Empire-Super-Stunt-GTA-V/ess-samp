<?php 
require_once("a_Header.php"); 
$rayID = isset($_GET['ray']) ? $_GET['ray'] : '';
?>
<title>Recover Account</title> <?php
?>
	<div class="ex">
	<?php DisplayHeader($userplayer, "Recover Account");?>
<?php
if($rayID == "" || $rayID == "-1")
{
	if(!isset($_POST["_name"]))
	{ 
		?>
		<hr>
		<div class="blue-box"><center>You can recover your forgotten account password by sending a reset link to the linked email address of your account.</center></div>
		<hr>
		<form action="" method="POST">
			<center>
				<strong><i class="fa fa-user"></i> Your player name</strong><br>
				<input type="text" STYLE="background-color: #252525;" value="" name="_name" class="form_field"><br><br>
				<input type="submit" value="Send me recovery link" class="button">
			</center>
		</form>
		<?php
	}
	if(isset($_POST["_name"]))
	{
		$name = mysql_real_escape_string($_POST["_name"]);
		
		$getpass = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$name'");
		while($row = mysql_fetch_array($getpass))
		{
			$name = $row["Name"];
			$email = $row["E-Mail"];
		}
		
		$getrows = mysql_num_rows(mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$name'"));
		if($getrows != 0 && $email != "None")
		{
			$rayGenerated = rand(1000000000000000000, 9999999999999999999);
			mysql_query("UPDATE `Accounts` SET `RayID` = '$rayGenerated' WHERE `Name` = '$name'");
			
			$ipaddress = $_SERVER['REMOTE_ADDR'];
			
			$to = $email;
			$headers = "no-reply@ess-ro.com";
			
			$subject = "Empire Super Stunt - Detalii recuperare parole (Romana)";
			$message = "Buna, ".$name."\n\nAcest mesaj iti este trimis in urma cererii tale de resetare a parolelor contului tau de pe server-ul ".$server_name."!\n\n» Te rugam sa accesezi link-ul urmator: http://ess-ro.com/recover?ray=".$rayGenerated." \n\nAceasta cerere a fost trimisa de pe adresa de IP ".$ipaddress.". Daca suspectezi o incercare de patrundere neautorizata asupra contului tau, te rugam sa raportezi unui administrator adresa de IP si datele primite in acest e-mail!\n\nDaca nu doresti sa-ti schimbi parola, ignora acest mesaj.";	
			
			$subject2 = "Empire Super Stunt - Passwords recovery details (English)";
			$message2 = "Hello, ".$name."\n\nYou account password from server ".$server_name." has been changed!\n\n» Please follow this link: http://ess-ro.com/recover?ray=".$rayGenerated." \n\nThis request was sent from the IP address ".$ipaddress.". If you suspect an unauthorized intrusion attempt on your account, please report to an administrator the IP address and data received in this email!\n\nIf you do not wish to change your password, simply ignore this message.";	
			
			mail($to, $subject, $message, $headers); // RO
			mail($to, $subject2, $message2, $headers); // ENG
			
			?>
			<hr>
			<div class="green-box">
				<p align="left">
					Succes!<br>
					Codul de resetare a parolei impreuna cu indicatiile de resetare au fost trimise pe email-ul din cont.<br>
					Nu uita sa verifici inclusiv folder-ul <strong>Spam</strong>!
				</p>
			</div>
			<hr>
			<?php
		}
		else
		{
			?>
			<hr>
			<div class="error-box">
				<p align="left">
					A aparut o eroare neasteptata!<br>Reia procesul cu mai multa atentie, asigurandu-te ca numele inscris este corect si ca deti o adresa de email in cont!
				</p>
			</div>
			<hr>
			<?php
		}
		?>
		</div>
		<?php
	}
}
else
{
	$getray = mysql_query("SELECT * FROM `Accounts` WHERE `RayID` = '$rayID'");
	$Rows = mysql_num_rows($getray);
	if($Rows == 0) { ?><hr><div class="error-box"><p align="left">A aparut o eroare neasteptata!</p></div><hr><?php }
	else if($Rows != 0)
	{
		while($row = mysql_fetch_array($getray)) $name = $row['Name'];
		if(!isset($_POST["_submitchange"]))
		{
			?>
			<hr>
			<div class="blue-box"><center>You can recover your forgotten account password by sending a reset link to the linked email address of your account.</center></div>
			<hr>
			<form action="" method="POST">
				<center>
					<strong><i class="fa fa-user"></i> Your new password</strong><br>
					<input type="password" STYLE="background-color: #252525;" value="" name="_password" class="form_field"><br><br>
					<strong><i class="fa fa-user"></i> Repeat your new password</strong><br>
					<input type="password" STYLE="background-color: #252525;" value="" name="_password_again" class="form_field"><br><br>
					<strong><i class="fa fa-user"></i> Your new secondary password</strong><br>
					<input type="password" STYLE="background-color: #252525;" value="" name="_password_s" class="form_field"><br><br>
					<strong><i class="fa fa-user"></i> Repeat your new secondary password</strong><br>
					<input type="password" STYLE="background-color: #252525;" value="" name="_password_s_again" class="form_field"><br><br>
					<input type="submit" name = "_submitchange" value="Change" class="button">
				</center>
			</form>
			<?php
		}
		if(isset($_POST["_submitchange"]))
		{
			$password1 = $_POST["_password"];
			$password1_repeat = $_POST["_password_again"];
			$password2 = $_POST["_password_s"];
			$password2_repeat = $_POST["_password_s_again"];
			
			$passwordcripted1 = md5($password1);
			$passwordcripted2 = md5($password2);
			
			if($password1_repeat != $password1 && $password1 != "") { ?><hr><div class="error-box"><p align="left">A aparut o eroare neasteptata!</p></div><hr><?php }
			else
			{
				if($password2 != "") 
				{
					if($password2_repeat != $password2) {?><hr><div class="error-box"><p align="left">A aparut o eroare neasteptata!</p></div><hr><?php }
					mysql_query("UPDATE `Accounts` SET `Password` = '$passwordcripted1', `SPassword` = '$passwordcripted2', `RayID` = '-1' WHERE `Name` = '$name'");
					?><hr><div class="green-box"><p align="left">Succes!<br>Parola principala & secundara a fost resetat!<br>Click <a href="/account.php">aici</a> pentru logare.</p></div><hr><?php
				}
				else
				{
					mysql_query("UPDATE `Accounts` SET `Password` = '$passwordcripted1', `RayID` = '-1' WHERE `Name` = '$name'");
					?><hr><div class="green-box"><p align="left">Succes!<br>Parola principala a fost resetat!<br>Click <a href="/account.php">aici</a> pentru logare.</p></div><hr><?php
				}
			}
		}
	}
}
require_once("a_Footer.php"); 