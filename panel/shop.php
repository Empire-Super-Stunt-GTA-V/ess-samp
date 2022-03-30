<?php 
require_once("a_Header.php"); 
?>
<title>Shop</title>
<?php

$prod = isset($_GET['prod']) ? $_GET['prod'] : '';
	
if($prod == 1 || $prod == 2|| $prod == 3 || $prod == 4 || $prod == 5 || $prod == 6 || $prod == 7 || $prod == 8 || $prod == 9 || $prod == 10 ||
$prod == 11 || $prod == 12 || $prod == 13 || $prod == 14 || $prod == 15 || $prod == 16 || $prod == 17 || $prod == 18 || $prod == 19 || $prod == 20)
{
	if(!isset($_COOKIE['sessionID'])) 
	{
		?>
		<br>
		<div class="block">
		<div class="main-middle">
		<div class="ex">  
		<div class="error-box">
			<p align="left">
			Nu poti accesa aceasta pagina fara a fi conectat la contul tau de pe server!
			<br>
			Daca vrei sa te conectezi, <a href ='/account.php'>click aici</a>.</p>
		</div>
		</div>
		</div>
		</div>
		<?php
	}
	else
	{
	    ?>
	    <div class="ex">
		<?php DisplayHeader($userplayer, "Cumpara produs");
		$success = isset($_GET['success']) ? $_GET['success'] : '';
		?>
		<?php
		$GetGems = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
		while ($row = mysql_fetch_array($GetGems)) { $Gems = $row['Gems']; }
		if($success == 0)
		{
			?>
			<hr>
			<div class="sale-box">
				  <p align="left">Produs comandat: <font color="#00B6FF"><?= GetProdName($prod) ?></font><br>
				  Pret: <font color="#33AA33"><?= GetProdPrice($prod) ?></font> Gems<br>
				  Gems disponibile: <font color="#33AA33"><?= $Gems ?></font></p>
				<?php
				if($Gems >= GetProdPrice($prod))
				{
					?>
					<br>
					<form action= "" method = "POST">
						<p align="left"><button type = "submit" class="btn btn-success" name = "buy">Cumpara</button></p>
					</form>
					<?php
				}
				?>
			</div>
			<hr>
			<div class="blue-box-info">
				<p align="left">Foloseste key-ul primit impreuna cu comanda <strong>/shopkey</strong> pe server!
				<br>
				Pentru mai multe detalii referitoare la comenzile efectuate, <a href="/account.php?page=my">click aici</a>.</p>
			</div>
			<hr>
			<?php
			
			if($Gems < GetProdPrice($prod))
			{
				?>
					<div class="orange-box">
					Nu ai suficiente gems pentru a finaliza comanda! Pentru a adauga gems in cont, <a href="/addgems.php">click aici</a>.
					</div>
				<?php
			}
			?>
			<?php
			if(isset($_POST['buy'])) Header("Location: ?prod=$prod&success=1");
		}
		if($success == 1)
		{
			if($Gems >= GetProdPrice($prod))
			{
				$szRandomKey = rand(1000000000, 9999999999);
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				if($prod == 1) 
				{
					$RewardText = "VIP";
					$ItemID = 2;
					$RewardAmount = 1;
				}
				if($prod == 2) 
				{
					$RewardText = "VIP Gold";
					$ItemID = 2;
					$RewardAmount = 2;
				}
				if($prod == 3)
				{
					$RewardText = "Admin Level 1";
					$ItemID = 1;
					$RewardAmount = 1;
				}
				if($prod == 4) 
				{
					$RewardText = "Admin Level-Up";
					$ItemID = 0;
					$RewardAmount = 1;
				}
				if($prod == 5) $RewardText = "+1 Owner";
				if($prod == 6) $RewardText = "Pickup Minigun";
				if($prod == 7) $RewardText = "Pickup Rocket";
				if($prod == 8) $RewardText = "Pickup Flamethrower";
				if($prod == 9) $RewardText = "Pickup any other weapon";
				if($prod == 10) 
				{
					$RewardText = "10.000 Coins";
					$ItemID = 4;
					$RewardAmount = 10000;
				}
				if($prod == 11) $RewardText = "200 C4";
				if($prod == 12) 
				{
					$RewardText = "999.999.999 Moneys";
					$ItemID = 3;
					$RewardAmount = 999999999;
				}
				if($prod == 13) 
				{
					$RewardText = "2.500 Stunt Points";
					$ItemID = 8;
					$RewardAmount = 2500;
				}
				if($prod == 14) 
				{
					$RewardText = "10.000 Drift Points";
					$ItemID = 7;
					$RewardAmount = 10000;
				}
				if($prod == 15) 
				{
					$RewardText = "5.000 Race Points";
					$ItemID = 9;
					$RewardAmount = 5000;
				}
				if($prod == 16) 
				{
					$RewardText = "10.000 Kills";
					$ItemID = 6;
					$RewardAmount = 10000;
				}
				if($prod == 17) $RewardText = "Un-Ban";
				if($prod == 18) $RewardText = "+1.000 Respect";
				if($prod == 19) 
				{
					$RewardText = "200 Hours";
					$ItemID = 10;
					$RewardAmount = 200;
				}
				if($prod == 20) $RewardText = "1 pachet artificii";
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				$price = GetProdPrice($prod);
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				$Query = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
				while($row = mysql_fetch_array($Query))
				{
					$PlayerGems = $row['Gems'];
					$minus = $PlayerGems - GetProdPrice($prod);
				}
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				mysql_query("UPDATE `Accounts` SET `Gems` = '$minus' WHERE `Name` = '$userplayer'");
				mysql_query("INSERT INTO `LogKeys` (`ID`, `Name`, `Gift`, `Price`, `Status`, `Key`, `Type`, `Amount`, `Date`) VALUES (0, '$userplayer', '0', '$price', '1', '$szRandomKey', '$RewardText', '0', '0')");
				mysql_query("INSERT INTO `ShopKeys` (`ID`, `Key`, `Item`, `Amount`) VALUES (0, '$szRandomKey', '$ItemID', '$RewardAmount')");
				//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
				?>
				<br>
				<hr>
				<div class="blue-box-info">
					<p align="left">Ai cumparat cu success <strong><?=GetProdName($prod)?></strong>!
					<br>
					Pentru mai multe detalii referitoare la comanda efectuata, <a href="/account.php">click aici</a>.</p>
				</div>
				<hr>
				<div class="green-box">
					  <p align="left">
						Foloseste comanda: <strong><font color="#00B6FF">/shopkey <?= $szRandomKey ?></font></strong>
					  </p>
				</div>
				<?php
			}
			else
			{
				?>
				<br>
				<div class="orange-box">
				Nu ai suficiente gems pentru a finaliza comanda! Pentru a adauga gems in cont, <a href="/addgems.php">click aici</a>.</div>
				</div>
				<?php
			}
		}
	}
}
else if($prod == "")
{
		?>
		<center>
		<div class='main-middle'>
		<div class='ex'>
		<div class='block-content collapse in'>
		<div class='navigation'>
		<?php DisplayHeader($userplayer, "Shop");?>
		<hr>
	    <?php
	    if (isset($_COOKIE['sessionID'])) 
        {
            ?>
            <div class='blue-box'>
			<font color=red>RO:</font> Preturile de mai jos sunt afișate în <font color=red>gems</font>! Pentru a adăuga gems în cont, <strong><a href="/addgems.php">click aici</a></strong>.
			<br>
	        <font color=red>EN:</font> Below prices are displayed in <font color=red>gems</font>! To add gems to your account, <strong><a href="/addgems.php">click here</a></strong>.
	        </div>
	        <?php
        }
        else
        {
            ?>
            <div class="orange-box2">
            <font color="red">RO:</font> Trebuie să fi autentificat pe contul de pe server pentru a putea cumpăra iteme din shop și a adăuga gems. <a href="/account.php">Autentifică-te acum</a>!<br>
			<font color="red">EN:</font> You need to be logged in on your server account to be able to purchase items from this shop and add gems. <a href="/account.php">Login now</a>!
			</div>
            <?php
        }
        ?>
		</div>
		<p></p>
		<hr>
		<?php
		
		showHeader("c_vip");
		ShowShop(1, 0, "pVIP", "VIP", "50 Gems", "Permanent", "<i class='fa fa-user'></i>", "0", $userplayer);
		ShowShop(2, 0, "pVIP", "VIP Gold", "100 Gems", "Permanent", "<i class='fa fa-user'></i>", "1", $userplayer);
		showFooter();
		
		showHeader("c_admin");
		ShowShop(3, 0, "Level", "Admin Level 1", "200 Gems", "Permanent", "<i class='fa fa-user'></i>", "1", $userplayer);
		ShowShop(4, 0, "Level", "Admin Level-Up", "300 Gems", "Permanent", "<i class='fa fa-arrow-circle-up'></i>", "1", $userplayer);
		showFooter();
	
		?>
		<div class="blue-box-info">
			In momentul achizitionarii unui nivel de admin, esti obligat si de-acord sa citesti si sa respecti <a href="#"><font color="red">Regulamentul si conditiile generale</font></a> de folosinta a rank-ului respectiv. De asemenea, poti regasi comenzile unui admin <a href="#">aici</a>.
		</div>
		<br>
		<div class="white-box-info">
			<p align="left">
			<strong><font color="red">RCON Admin</font></strong><br>
			- Beneficiezi de comenzi speciale<br>
			- De asemenea, ai incluse si functii speciale precum imunitate la Anti-Spam<br>
			- Tag-uri personalizate cu titlul (RCON) pe server si website<br>
			- Posibilitatea de-a-ti customiza statusul si contul de pe server in orice fel<br><br>
			Pretul <font color="red">RCON-ului</font> porneste de la <font color="red">10</font> euro. 
			Pentru mai multe detalii despre beneficii, metode de plata si contact, <a href="#">acceseaza pagina dedicata</a>.
			</p>
		</div>
		<br>
		<?php
					
		showHeader("c_gangs");
		ShowShop(5, 0, "", "+1 Owner", "150 Gems", "Permanent", "<i class=''></i>", "1", $userplayer);
		ShowShop(6, 0, "", "Pickup Minigun", "100 Gems", "Permanent", "<i class=''></i>", "0", $userplayer);
		ShowShop(7, 0, "", "Pickup Rocket", "100 Gems", "Permanent", "<i class=''></i>", "0", $userplayer);
		ShowShop(8, 0, "", "Pickup Flamethrower", "100 Gems", "Permanent", "<i class=''></i>", "0", $userplayer);
		ShowShop(9, 0, "", "Pickup any other weapon", "80 Gems", "Permanent", "<i class=''></i>", "0", $userplayer);
		showFooter();

		showHeader("c_others");
		ShowShop(10, 0, "Coins", "10.000 Coins", "100 Gems", "Permanent", "<i class='fa fa-database'></i>", "0", $userplayer);
		ShowShop(11, 0, "C4", "200 C4", "30 Gems", "Permanent", "<i class='fa fa-bomb'></i>", "0", $userplayer);
		ShowShop(12, 0, "Money", "999.999.999 Moneys", "30 Gems", "Permanent", "<i class='fa fa-dollar-sign'></i>", "0", $userplayer);
		ShowShop(13, 0, "StuntScore", "2.500 Stunt Points", "100 Gems", "Permanent", "<i class='fa fa-motorcycle'></i>", "0", $userplayer);
		ShowShop(14, 0, "DriftScore", "10.000 Drift Points", "100 Gems", "Permanent", "<i class='fa fa-car'></i>", "0", $userplayer);
		ShowShop(15, 0, "RaceScore", "5.000 Race Points", "100 Gems", "Permanent", "<i class='fa fa-flag-checkered'></i>", "0", $userplayer);
		ShowShop(16, 0, "Kills", "10.000 Kills", "100 Gems", "Permanent", "<i class='fa fa-crosshairs'></i>", "0", $userplayer);
		ShowShop(17, 0, "", "Un-Ban", "200 Gems", "-", "<i class='fa fa-unlock-alt'></i>", "1", $userplayer);
		ShowShop(18, 0, "Positive", "+1.000 Respect", "100 Gems", "Permanent", "<i class='fa fa-thumbs-up'></i>", "0", $userplayer);
		ShowShop(19, 0, "Hours", "200 Hours", "100 Gems", "Permanent", "<i class='far fa-clock'></i>", "0", $userplayer);
		ShowShop(20, 0, "", "1 pachet artificii", "10 Gems", "Permanent", "<i class='fa fa-fire'></i>", "0", $userplayer);
		showFooter();
	
		?>
		<div style="height: 140px; background: url(images/mtab-box.png); border: 2px solid #3b3b3b; border-radius: 5px; padding: 10px;">
		<table border="0">
		<tbody>
		<tr>
		<td><img src="images/ro-flag2.png" width="40"></td>
		<td><strong>
		<strong>- Aceste plăți sunt considerate donații către comunitatea Empire Super Stunt pentru ca ea să rămână deschisă 24/7.<br>
				- Pentru itemele cumpărate pe forum, va trebuii să contactezi un Manager pentru a finaliza comanda.<br>
				- Pentru itemele cumpărate pe server, vei primii după plata un cod pe care îl poți folosii pe server cu comanda pentru a primii ceea ce ai achiziționat.<br>
				- Există anumite iteme cumpărate pe server, pentru care activarea se va face manual de către un Manager.<br>
				- Daca ai vr-o problema sau intrebare in legatura cu <font color="red">donatiile</font>, atunci ne poti contacta pe adresa urmatoare: <font color="red">admin@ess-ro.com</font>.</strong></td>
		</tr>
		<tr>
		<td><img src="images/uk-flag2.png" width="40"></td>
		<td><strong>
		<strong>- These payments are considered donations toward Empire Super Stunt community to remain online 24/7.<br>
				- For items purchased for your forum account, you will need to contact a Manager to finish the order.<br>
				- For items purchased for your server account, you will recieve a key which you need to use on the server with /shopkey command to get what you have bought.<br>
				- There are some items purchased for your server account for which the activation will be made manually by a Manager.<br>
				- If you have any problems or questions with <font color="red">donations</font>, you can contact here: <font color="red">admin@ess-ro.com</font>.</strong></td>
		</tr>
		</tbody>
		</table>
		</div>
		
		<hr>
		<div class="orange-box2">
		<div style="float: left; width:50px;"><font color="#FFCC00"><i class="fa fa-star fa-2x"></i></font></div>
		<div style="float: right; width:1050px;">
			<p align="left">
			Itemele cu stea, deși sunt permanente, ne rezervăm dreptul de a le retrage utilizatorilor în cazul încălcării regulamentelor generale ale comunității sau în cazul inactivității, fără a vă notifica în prealabil!
			<br>
			Items marked by a star, even if are permanent, we reserve our right to remove them from those users who will violate the general rules of the community, or in the case of inactivity, without any notice!
			</p>
		</div>
		<div style="clear: both;"></div>
		</div>
		<hr>
		</div>
		</div>
		</div>
		</div>
		<?php
}
else Header("Location: /shop");

function showFooter()
{
	print('</table>
			<br>');
}
function GetProdName($produs)
{
	if($produs == 1) $name = "<i class='fa fa-user'></i> VIP";
	if($produs == 2) $name = "<i class='fa fa-user'></i> VIP Gold";
	if($produs == 3) $name = "<i class='fa fa-user'></i> Admin Level 1";
	if($produs == 4) $name = "<i class='fa fa-arrow-circle-up'></i> Admin Level-Up";
	if($produs == 5) $name = "+1 Owner";
	if($produs == 6) $name = "Pickup Minigun";
	if($produs == 7) $name = "Pickup Rocket";
	if($produs == 8) $name = "Pickup Flamethrower";
	if($produs == 9) $name = "Pickup any other weapon";
	if($produs == 10) $name = "<i class='fa fa-database'></i> 10.000 Coins";
	if($produs == 11) $name = "<i class='fa fa-bomb'></i> 200 C4";
	if($produs == 12) $name = "<i class='fa fa-dollar-sign'></i> 999.999.999 Moneys";
	if($produs == 13) $name = "<i class='fa fa-motorcycle'></i> 2.500 Stunt Points";
	if($produs == 14) $name = "<i class='fa fa-car'></i> 10.000 Drift Points";
	if($produs == 15) $name = "<i class='fa fa-flag-checkered'></i> 5.000 Race Points";
	if($produs == 16) $name = "<i class='fa fa-crosshairs'></i> 10.000 Kills";
	if($produs == 17) $name = "<i class='fa fa-unlock-alt'></i> Un-Ban";
	if($produs == 18) $name = "<i class='fa fa-thumbs-up'></i> +1.000 Respect";
	if($produs == 19) $name = "<i class='far fa-clock'></i> 200 Hours";
	if($produs == 20) $name = "<i class='fa fa-fire'></i> 1 pachet artificii";
	return $name;
}
function GetProdPrice($produs)
{
	if($produs == 1) $pret = "50";
	if($produs == 2) $pret = "100";
	if($produs == 3) $pret = "200";
	if($produs == 4) $pret = "300";
	if($produs == 5) $pret = "150";
	if($produs == 6) $pret = "100";
	if($produs == 7) $pret = "100";
	if($produs == 8) $pret = "100";
	if($produs == 9) $pret = "80";
	if($produs == 10) $pret = "100";
	if($produs == 11) $pret = "30";
	if($produs == 12) $pret = "30";
	if($produs == 13) $pret = "100";
	if($produs == 14) $pret = "100";
	if($produs == 15) $pret = "100";
	if($produs == 16) $pret = "100";
	if($produs == 17) $pret = "200";
	if($produs == 18) $pret = "100";
	if($produs == 19) $pret = "100";
	if($produs == 20) $pret = "10";
	return $pret;
}
function showHeader($image, $domainname)
{
	print("
	<center>
			<table class='bella'>
		    <colgroup><col width='325'><col width='100'><col width='100'><col width='100'><col width='25'></colgroup>
			<center><img src='$domainname2/images/$image.png' width='320'></center>
	<thead>
			<tr>
				<th>Item</th>        
				<th>Price</th>
				<th>Valability</th>
				<th>Actions</th>
				<th></th>
			</tr>				
	</thead>");
}
function ShowShop($ProdID, $ProdValue, $ProdSQL, $Prod, $Price, $Valability, $ItemIcon, $Message, $userplayer)
{	
	if($ProdValue == 0) $ProdValue = ""; $domainname2 = "";
	//----------------------------------------------------------------------------------------------
	if($Message == "1") $Mess = "<font color= '#FFCC00' <i class='fa fa-star'></i></font>";
	print("
	<tr>
		<td>$ItemIcon $Prod $ProdValue</td>				
		<td><i class='fa fa-dollar-sign'></i> $Price</td>
		<td><font color='orange'><i class='far fa-clock'></font></i> $Valability</font></td>
		<td><a href='/shop.php?prod=$ProdID' class='buy-item'><img src='/images/cart.png'> Purchase now!</a></td>
		<td>$Mess</td>
	</tr>");
}
require_once("a_Footer.php");
?>