<?php 
require_once("a_Header.php");
?>
<title>My Account - Email</title>
<div class="ex">
<?php DisplayHeader($userplayer, "My Account - Email");?>
<?php
if(isset($_COOKIE['sessionID'])) 
{ 	
	$getemail = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
	while($row = mysql_fetch_array($getemail)) { $emailex = $row["E-Mail"]; }
    
	if($emailex =="None")
	{
		if(!isset($_POST["_email"]))
		{ 
			?>
			<hr>
			<div class="blue-box">
				<center>Nu ai o adresa de email in cont! Adauga o adresa de email pentru a-ti putea schimba parola oricand! Daca uiti parola si nu ai o adresa de email in cont, nu iti mai poti recupera contul!</center>
			</div>
			<hr>
			<form action="" method="POST">
				<center>
					<strong>Adresa de email</strong><br>
					<input type="text" STYLE="background-color: #252525;" value="" name="_email" class="form_field"><br><br>
					<input type="submit" value="Adauga" class="button">	
				</center>
			</form>
			<?php
		}
		if(isset($_POST["_email"]))
		{
			$email = stripslashes($_POST['_email']);
			$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
			if(!preg_match($email_exp,$email)) 
			{
				?>
				<hr>
				<div class="error-box">
					<p align="left">
						A aparut o eroare in timpul procesarii cererii tale!<br>
						Asigura-te ca email-ul introdus este valid, apoi reia procesul dand <a href="/email.php">click aici</a>.
					</p>
				</div>
				<hr>
				<?php
			}
			else
			{
				mysql_query("UPDATE `Accounts` SET `E-Mail` = '$email' WHERE `Name` = '$userplayer'");
				?>
				<hr>
				<div class="green-box">
					<p align="left">
						Succes!<br>
						Adresa de email <strong><?= $email ?></strong> a fost adaugata cu succes in contul tau.<br>
						Urmeaza sa primesti un email de confirmare pe adresa adaugata!
					</p>
				</div>
				<hr>
				<?php
				
				$to = $email;
				$headers = "no-reply@ess-ro.com";
				
				$subject = "Empire Super Stunt - Notificare email";
				$message = "Buna, ".$userplayer."\nAcest mesaj iti este trimis pentru a-ti confirma adaugarea adresei de email in cont!\n\nDe acum, vei putea folosii email-ul tau pentru a-ti recupera parola de la cont.";
				
				mail($to, $subject, $message, $headers);
			}
		}
	}
	else
	{
		?>
		<hr>
		<div class="error-box">
			<p align="left">
				A aparut o eroare neasteptata!<br>
				Nu poti modifica adresa de email deja existenta in cont!
			</p>
		</div>
		<hr>
		<?php
	}
}
else
{
	?>
	<hr>
	<div class="error-box">
		<p align="left">
			Nu poti accesa aceasta pagina fara a fi conectat la contul tau de pe server!
			<br>
			Daca vrei sa te conectezi, <a href="/account.php?action=login">click aici</a>.
		</p>
	</div>
	<hr>
	<?php
}
require_once("a_Footer.php");