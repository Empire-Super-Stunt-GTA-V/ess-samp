<?php require_once("a_Header.php"); ?>
<title>Add Gems</title>
<?php
if(isset($_COOKIE['sessionID'])) 
{
		if(isset($_POST['_paysafe']))
		{	
			$psfuser = stripslashes($_POST['_paysafe1']);
			$psfvalue = stripslashes($_POST['_paysafe2']); 
			$psfcode = stripslashes($_POST['_paysafe3']);
			//-----------------------------------------------------------
			$Query = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$psfuser'");
			//-----------------------------------------------------------
			if(mysql_num_rows($Query) != 0 && strlen($psfvalue) >= 1 && strlen($psfcode) == 16) 
			{
				mysql_query("INSERT INTO `Donation` (`ID`, `By`, `For`, `Amount`, `Method`, `Reference`, `Status`) VALUES (0, '$userplayer', '$psfuser', '$psfvalue', '1', '$psfcode', '1')");
				//-------------------------------------------------------
				?>
				<div class="ex">
					<div class="green-box">
						<p align="left">
						Succes - Payment #<strong><?=mysql_insert_id()?></strong> sent! 
						</p>
					</div>
				<?php
			} 
			else 
			{
				?>
				<div class="ex">
					<div class="error-box">
						<p align="left">
						Codul introdus este invalid | Entered code is invalid!
						<br>
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
			<?php DisplayHeader($userplayer, "Add Gems");?>
			<hr>
			<div class="blue-box"><center>Select payment method through which you wish to add <font color="red">gems</font> to your account!</center></div>
			<hr>
			<center>
				<img src="/images/pp.png" width="200" onclick="document.getElementById('_paypal').style.display='block';document.getElementById('_paysafe').style.display='none'" ;=""> 
				<img src="/images/psc.png" width="200" onclick="document.getElementById('_paysafe').style.display='block';document.getElementById('_paypal').style.display='none'" ;="">
			</center>
			<div id="_paypal" style="display:none;">
				<center>
				<form action="#" method="post" target="_top">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="V22H753SBG672">
				<input type="hidden" name="on0" value="Gems"><strong>Gems</strong><br>
				<select name="os0" id="san">
					<option value="50 Gems -">50 Gems - €1.00 EUR</option>
					<option value="100 Gems -">100 Gems - €2.00 EUR</option>
					<option value="150 Gems -">150 Gems - €3.00 EUR</option>
					<option value="200 Gems -">200 Gems - €4.00 EUR</option>
					<option value="250 Gems -">250 Gems - €5.00 EUR</option>
					<option value="300 Gems -">300 Gems - €6.00 EUR</option>
					<option value="350 Gems -">350 Gems - €7.00 EUR</option>
					<option value="400 Gems -">400 Gems - €8.00 EUR</option>
					<option value="450 Gems -">450 Gems - €9.00 EUR</option>
					<option value="500 Gems -">500 Gems - €10.00 EUR</option>
				</select><br><br>
				<input type="hidden" name="on1" value="Player name | nume jucător"><strong>Player name | nume jucător</strong><br>
				<input type="text" name="os1" maxlength="200"><br><br>
				<input type="hidden" name="currency_code" value="EUR">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" onclick="psend(403192, &quot;93.122.249.232&quot;, &quot;hrv5jgderh8t90e7tatuuidh36&quot;);" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
				</center>
				<br>
			</div>

			<div id="_paysafe" style="display: none;">
					<center>
						Please fill the form below in order to continue.<br>
						Completează informațiile din câmpurile de mai jos pentru a continua.<br><br>
						<form method="POST">
						<strong><font color="#0072FF"><i class="fa fa-user"></i></font> Player name / nume jucător</strong><br>
						<input type="text" STYLE="background-color: #252525;" name="_paysafe1"><br><br>
						<strong><font color="#0072FF"><i class="fa fa-euro-sign"></i></font> Value in euro / valoare în euro<br><font color='red'>1 euro = 50 gems</font></strong><br>
						<input type="number" STYLE="background-color: #252525;" name="_paysafe2"><br><br>
						<strong><font color="#0072FF"><i class="fa fa-hashtag"></i></font> Paysafecard code / cod:</strong><br>
						<input type="number" STYLE="background-color: #252525;" name="_paysafe3"><br><br>
						<input type="submit" value="Continue" name="_paysafe" class="button">
						</form>
					</center>
					<br>
			  </div>
			
			<div style="height: 90px; background: url(/images/mtab-box.png); border: 2px solid #3b3b3b; border-radius: 5px; padding: 10px;">
				<table border="0">
					<tbody>
						<tr>
							<td><img src="/images/ro-flag2.png" width="32"></td>
							<td>
							- Aceste plăți sunt considerate donații către comunitatea <strong>Empire Super Stunt</strong> pentru ca ea să rămână deschisă 24/7.<br>
							- În funcție de țara de origine, vei putea plătii și printr-un card de credit sau debit direct prin PayPal. Pot exista taxe suplimentare.<br>
							- Pentru această metoda de plată va trebuii să aștepți procesarea plății. Aceasta poate dura cel mult 48 de ore. După procesare vei primii gems-urile automat în cont!<br>
							</td>
						</tr>
						<tr>
							<td><img src="/images/uk-flag2.png" width="32"></td>
							<td>
							- These payments are considered donations toward <strong>Empire Super Stunt</strong> community to remain online 24/7.<br>
							- Depending of your country, you may be able to pay by credit or debit card directly through PayPal. Some surcharges may apply.<br>
							- For this payment method, you will need to wait for the payment to be processed. This could take no more than 48 hours. After the payment is processed, you will automatically get the gems in your account!
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			</div>
			<?php
		}
}
else
{
	?>
	<div class="ex">
	<div class="error-box">
		<p align="left">Nu poti accesa aceasta pagina fara a fi conectat la contul tau de pe server!
		<br>
		Daca vrei sa te conectezi, <a href="/account.php?action=login">click aici</a>.</p>
	</div>
	</div>
	<?php
}
require_once("a_Footer.php");
?>
