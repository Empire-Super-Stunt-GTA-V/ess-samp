<?php 
require_once("a_Header.php"); 
?>
<title>Request Ban List</title>
<div class="ex">
<?php
if (isset($_COOKIE['sessionID'])) 
{
	$GetLevel = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
	while ($row = mysql_fetch_array($GetLevel))
	{
		$mylevel = $row["RconType"];
	}
}
function SendUnBanError()
{
    ?>
	<div class='error-box'>
		<p align='left'>
			A intervenit o eroare!<br>
			Daca crezi ca eroarea persista, raporteaza-l pe forum!<br>
		</p>
	</div>
	<?php
}
function UpdateUnBanStatus($ID, $Value)
{
	mysql_query("UPDATE `UnBans` SET `UnBan` = '$Value' WHERE `ID` = '$ID'");
}
function GetUnBanStatus($ID)
{
	$Status = mysql_query("SELECT * FROM `UnBans` WHERE `ID` = '$ID'");
	while ($row = mysql_fetch_array($Status)) $statuss = $row['Unban'];
	return $statuss;
}
function GetCommentsNumbers($ID)
{
	$comments = mysql_query("SELECT * FROM `UnbansComments` WHERE `UnBanID` = '$ID'"); $count = 0;
	while($row2 = mysql_fetch_array($comments)) $count++;
	return $count;
}
function GetPlayerNameByIDex($ID)
{
	$GetName = mysql_query("SELECT * FROM `UnBans` WHERE `ID` = '$ID'");
	while ($row = mysql_fetch_array($GetName)) $name = $row['Name'];
	return $name;
}
$unbanid = isset($_GET['unban']) ? $_GET['unban'] : '';
if(isset($unbanid) && $unbanid != "" && $unbanid != 0)
{
	$unbanstatus = isset($_GET['status']) ? $_GET['status'] : '';
	if($unbanstatus == "true")
	{
		$string = "GetPlayerNameByIDex($unbanid)";
		$GetIfBanned = mysql_query("SELECT * FROM `Bans` WHERE `Name` = '$string'");
		if(mysql_num_rows($GetIfBanned) != 0)
		{
			if(GetUnBanStatus($unbanid) == 2 || GetUnBanStatus($unbanid) == 1) SendUnBanError();
			else
			{
				UpdateUnBanStatus($unbanid, 2);
				mysql_query("DELETE FROM `Bans` WHERE `Name` = '$string'");
				?>
				<div class="green-box">
					<p align="left">
					Un-Ban ID <strong>#<?= $unbanid ?></strong> was verified as <img src='images/success-small.png'><br>
					And the player <strong><?= $string ?></strong> was Un-Banned!
					Click<a href="/unban.php?unban=<?= $unbanid ?>"><strong> here</strong></a> to go back!
					</p>
				</div>
				<?php
			}
		}
		else if(mysql_num_rows($GetIfBanned) == 0)
		{
			?>
			<div class="error-box">
				<p align="left">
				Error!<br>
				This player is not banned in our server!<br>
				Click<a href="/unban.php?unban=<?= $unbanid ?>"><strong> here</strong></a> to go back!
				</p>
			</div>
			<?php
		}
	}
	else if($unbanstatus == "false")
	{
		if(GetUnBanStatus($unbanid) == 2 || GetUnBanStatus($unbanid) == 1) SendUnBanError();
		else
		{
			UpdateUnBanStatus($unbanid, 1);
			?>
			<div class="green-box">
				<p align="left">
				Un-Ban ID <strong>#<?= $unbanid ?></strong> was verified as <img src='images/rejected.png'><br>
				Click<a href="/unban.php?unban=<?= $unbanid ?>"><strong> here</strong></a> to go back!
				</p>
			</div>
			<?php
		}
	}
	else
	{
		if(isset($_POST['postIT']))
		{
			if(isset($_COOKIE['sessionID'])) 
			{
				$comment = stripslashes($_POST['comment']);
				//-------------------------------------------------------  
				if(!empty($comment))
				{
					mysql_query("INSERT INTO `UnbansComments` (`UnBanID`, `PlayerName`, `Comment`, `Date`) VALUES ('$unbanid', '$userplayer', '$comment', '".date("d/m/Y")." at ".date("H:i")."')");
					//---------------------------------------------------
					Header("Location: /unban?unban=$unbanid");
				}
				else
				{
					?>
					<div class="error-box">
						<p align="left">
						A intervanit o eroare!<br>
						Asigura-te ca ai completat campurile cu date valide!
						</p>
					</div>
					<?php
				}
			}
			else
			{
				?>
				<div class="error-box">
					<p align="left">
						Nu poti accesa aceasta pagina fara a fi conectat la contul tau de pe server!<br>
						Daca vrei sa te conectezi, <a href="/account.php?action=login">click aici</a>.
					</p>
				</div>
				<?php
			}
		}
		else
		{
			$cQuery = mysql_query("SELECT * FROM `UnBans` WHERE `ID` = '$unbanid'"); 
			while($row = mysql_fetch_array($cQuery))
			{
				$pID = $row['ID'];
				$pName = $row['Name'];
				$pIP = $row['IP'];
				$pAdmin = $row['Admin'];
				$pInfo = $row['Info'];
				$pUnBan = $row['Unban'];
				$pGuilty = $row['Guilty'];
				$pReason = $row['Reason'];
			}
			?>
			<table class='bella'>
			<tbody>
				<tr><td><strong>Nume</strong>:</td><td><a href='playerstats.php?player= <?= $pName ?>' target='_blank' style='color:inherit;'> <?= $pName ?></a></td></tr>
				<?php
				if($mylevel >= 2 && !empty($pIP)) { ?> <tr><td><strong>Adresa IP</strong>:</td><td><i><?= $pIP ?></i></td></tr> <?php }
				else if(empty($pIP)) { ?> <tr><td><strong>Adresa IP</strong>:</td><td><i>No existing</i></td></tr> <?php }
				else { ?> <tr><td><strong>Adresa IP</strong>:</td><td><i>Privata</i></td></tr> <?php }
				?>
				<tr><td><strong>Admin</strong>:</td><td><a href='playerstats.php?player= <?= $pAdmin ?>' target='_blank' style='color:inherit;'> <?= $pAdmin ?></a></td></tr>
				<?php
				if(!empty($pReason)) { ?> <tr><td><strong>Motiv</strong>:</td><td><?= $pReason ?></td></tr> <?php }
				if(!empty($pInfo)) { ?> <tr><td><strong>Dovezi</strong>:</td><td><?= $pInfo ?></td></tr> <?php }
				if($mylevel >= 2 && $pUnBan == 0) { ?> <tr><td><strong>Action</strong>:</td><td><a href="/unban.php?unban=<?= $unbanid ?>&status=true"><img src='images/success-small.png'> <Strong>Accept</strong></a> | <a href="/unban.php?unban=<?= $unbanid ?>&status=false"><img src='images/rejected.png'> <Strong>Reject</strong></a> <?php }
				?>
			</tbody>
			</table>
			<?php
			if($pGuilty == 1) $string = "<font color='#27A500'>Acest jucator recunoaste ca este vinovat!</font><br><br>";
			if($pUnBan == 1) $StringStatus = "<img src='images/rejected.png'> <font color='red'>Cererea a fost respinsa!</font>";
			else if($pUnBan == 2) $StringStatus = "<img src='images/success-small.png'> <font color='green'>Cererea a fost acceptata!</font>";
			?>
			<p align="left"> 
				<?= $string ?>
				<?= $StringStatus ?>
			</p>
			<hr>
			<br>
			<p align="left">
			<font size="+1">Comentarii</font>
			<?php
			if(GetCommentsNumbers($pID) >= 1)
			{
				$Query = mysql_query("SELECT * FROM `UnbansComments` WHERE `UnBanID` = '$pID' ORDER BY `ID` DESC");
				while($row = mysql_fetch_array($Query))
				{
					if($mylevel >= 2) $color = "red";
					else $color = "grey";
					?>
					<div class="comment">
						<div style="float:left;"><strong><font color="<?= $color ?>"><?= $row['PlayerName']; ?></font>:</strong></div>
						<div style="float:right;"><?= $row['Date']; ?></div><br>
						<hr>
						<div style="float:left;">
						    <? echo($row['Comment']); ?>
						</div><br>
					</div>
					<br>
					<?php
				}
			}
			else
			{
				?>
				<br>
				Niciun comentariu postat.
				<?php
			}
			?>
			</p>
			<?php
			if($pUnBan == 0)
			{
				?>
				<br>
				<form method="POST">
				<p align="left">
				Posteaza un comentariu<br>
				<textarea name="comment" class="textbox" name="comment" style="width: 620px; max-width: 620px; height:120px;"></textarea><br>
				<input type="submit" name="postIT" value="Posteaza" class="button" style="margin-top: 2px;">
				</p>
				</form>
				<?php
			}
		}
	}
}
else
{
	?>
	<center>
	<div class="main-middle">
		<h1 class="ipsType_pagetitle"><center><i class="fa fa-unlock-alt"></i> Un-ban list!</center></h1>
		<hr>
		<a href="/requestunban.php" class="button">Aplica o cerere de scoatere a interdictiei <img src="images/add.png"></a>
		<hr>
		<div class="bella">
		<table class="bella"> 
		<table>
		<thead>
			<th>Name</th>
			<th>Admin</th>
			<th>Stare</th>
			<th>Comentari</th>
		</thead>
		
		<?php
		
		
		$Query = mysql_query("SELECT * FROM `UnBans` ORDER BY `ID` DESC");
		while($row = mysql_fetch_array($Query))
		{
			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			$pID = $row['ID'];
			$pName = $row['Name'];
			$pAdmin = $row['Admin'];
			$pUnBan = $row['Unban'];
			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			if($pUnBan == 0) $StringStatus = "<img src='images/pending.png'> In asteptare";
			else if($pUnBan == 1) $StringStatus = "<img src='images/rejected.png'> Respins";
			else if($pUnBan == 2) $StringStatus = "<img src='images/success-small.png'> Acceptat";
			?>
			<td><a href='/unban.php?unban=<?= $row["ID"] ?>'><font color='#fff'> <?= $pName ?></font></a></td>
			<td><?= $pAdmin ?></td>
			<td><?= $StringStatus ?></td>
			<td><?= GetCommentsNumbers($row["ID"]); ?></td>
			</tr>
			<?php
		}
		?>
		</table>
		</div>
	</div>
	</div>
	</table>
	<?php
}
require_once("a_Footer.php"); ?>