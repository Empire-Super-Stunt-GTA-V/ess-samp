<?php require_once("a_Header.php"); ?>
<title>Unban</title>
<script>
window.onload = function() 
{
	var c = document.getElementById('guilty')
	c.onchange = function() 
	{
		if (c.checked == true) {document.getElementById('proofs').style.display = 'none';}
		else {document.getElementById('proofs').style.display = 'block';}
	}
}
</script>
<?php
if(isset($_COOKIE['sessionID'])) 
{
		if(isset($_POST['unbanrequest']))
		{	
		    $nbanned = stripslashes($_POST['namebanned']);
            $aip = stripslashes($_POST['adressip']);
            $aadmin = stripslashes($_POST['admin']);
			$reason = stripslashes($_POST['reason']);
			if(isset($_POST['uguilty'])) $guilty = 1;
			else if(!isset($_POST['uguilty'])) $guilty = 0;
            $info = stripslashes($_POST['proofs']);
			//-----------------------------------------------------------
			$getinfo = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$nbanned'");
			if(mysql_num_rows($getinfo) != 0)
			{
            
				mysql_query("INSERT INTO `UnBans` (`Name`, `IP`, `Admin`, `Reason`, `Info`, `AcceptedBy`, `Unban`, `Guilty`) VALUES ('$nbanned', '$aip', '$aadmin', '$reason', '$info', '0', '0', '$guilty')");
				//-------------------------------------------------------
				?>
				<div class="ex">
					<div class="green-box">
						<p align="left">
						Unban request #<strong><?=mysql_insert_id()?></strong> sent! 
						</p>
					</div>
				</div>
				<?php
			}
			else 
			{
				?>
				<div class="ex">
					<div class="error-box">
						<p align="left">
						A intervanit o eroare!<br>
						Asigura-te ca ai completat campurile cu date valide!
						</p>
					</div>
				</div>
				<?php
			}
		}
		else
		{
			?>
			<div class="ex">
			<?php DisplayHeader($userplayer, "Un-Ban");?>
				<form method="POST">
				<strong>Numele pe care ai primit interdictie?<br>Ai grija sa fie corect scris!</strong><br>
				<input type="text" STYLE="background-color: #252525;" name="namebanned"><br><br>
				<strong>Adresa IP pe care ai primit interdictie?</strong><br>
				<input type="text" STYLE="background-color: #252525;" name="adressip"><br><br>
				<strong>Adminul care ti-a dat interdictia?</strong>
				<input type="hidden" STYLE="background-color: #252525;" name="admin"><br>
				<select name="admin" id="san" STYLE="background-color: #252525;">
				<option value="Nu stiu">Nu stiu</option>
				<?php
					$adminames = mysql_query("SELECT * FROM `Accounts` WHERE `Level` >= '1' ORDER BY `Name`");
					while($row = mysql_fetch_array($adminames))
					{
						?>
						<option value="<?= $row['Name'] ?>"><?= $row['Name'] ?></option>
						<?php //ShowItem(1)
					}
					?> 
				</select><br>
				<strong>Care este motivul interdictiei?</strong><br>
				<input type="text" STYLE="background-color: #252525;" name="reason"><br><br>
				<strong>Recunosc ca sunt vinovat si promit ca nu se va mai intampla!</strong>
				<input type="checkbox" id="guilty" name="uguilty";><br><br>
				<div id="proofs">
					<strong>Dovezi ca sunt nevinovat si merit un-ban<br>Imaginile se incarca pe <a href="http://www.imgz.ro">imgz.ro:</a></strong><br>
					<textarea name="uproofs" class="textbox" name="proofs" cols="50" rows="5"></textarea><br><br>
				</div>
				<input type="submit" value="Continue" name="unbanrequest" class="button">
				</form>
				<br>
			</div>
			<?php
		}
}
else
{
	?>
	<div class="ex">
	<div class="error-box">
		<p align="left">
			Nu poti accesa aceasta pagina fara a fi conectat la contul tau de pe server!<br>
			Daca vrei sa te conectezi, <a href="/account.php">click aici</a>.
		</p>
	</div>
	</div>
	<?php
}
?>
<?php require_once("a_Footer.php"); ?>