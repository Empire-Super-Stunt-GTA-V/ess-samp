<?php require_once("a_Header.php"); 
function GetDateUpdate()
{
	$Query = mysql_query("SELECT * FROM `ServerCFG`");
	while($row = mysql_fetch_array($Query))
	{
		$Date = $row['UpdateData'];
		$Time = $row['UpdateTime'];
		$sstring = "<font color='red'>$Date</font> at <font color='red'>$Time</font>.";
	}
	return $sstring;
}
function GetGangMembers($ID)
{
    $cMembers = mysql_query("SELECT * FROM `Accounts` WHERE `GangID` = '$ID'"); $members = 0;
    while($rows = mysql_fetch_array($cMembers)) $members++;
    return $members;
}
?>
<title>Gangs</title>
<center>
	<div class="ex">
<?php
$gID = isset($_GET['gang']) ? $_GET['gang'] : '';
$gID = mysql_real_escape_string($gID);

if(isset($gID) && $gID != "" && $gID != 0)
{
	$cQuery = mysql_query("SELECT * FROM `Gangs` WHERE `ID` = '$gID'"); 
	while($row = mysql_fetch_array($cQuery))
	{
	?>
	<table class="bella"> 
	<colgroup><col width='25'><col width='100'><col width='100'><col width='25'><col width='25'><col width='25'><col width='100'></colgroup>
	<center>
		<?php DisplayHeader($userplayer, $row["GangName"]);?>
		<hr>
		<div class="orange-box2">
			<font color="orange"></font>
			<center>
				<font color="orange"><i class="fa fa-users"></i></font> Below you will find advanced details and informations about this gang! <font color="orange"><i class="fa fa-users"></i></font>
			</center>
		</div>
		<hr>
		<b>Weapons:</b>
		<br>
			<img src="<?= $domainname ?>/images/guns/<?= $row["GangWeapon1"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["GangWeapon2"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["GangWeapon3"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["GangWeapon4"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["GangWeapon5"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["GangWeapon6"] ?>.png"/>
		<br><br>
			This gang has <font color="#FF0000"><strong><?= GetGangMembers($gID) ?></strong></font> members, <font color="#FF0000"><strong><?= $row["GangKills"] ?></strong></font> kills, <font color="#FF0000"><strong><?= $row["GangDeaths"] ?></strong></font> deaths, <font color="#FF0000"><strong><?= $row["GangCaptures"] ?></strong></font> capture points &amp; <font color="#FF0000"><strong><?= $row["GangPoints"] ?></strong></font> gang points in total!
		<br><br>
		<a href="#header" onclick="document.getElementById('_top10').style.display='block';"><strong><i class="fa fa-users"></i> View top 10 members! <i class="fa fa-users"></i></strong></a>
		<br><br>
	</center>
	<?php
	}
	?>
	<br>
	<thead>
		<th><strong><i class="fa fa-trophy"></i></strong></th>
		<th><strong>Name</strong></th>
		<th><strong>Rank</strong></th>
		<th><strong>Points</strong></th>
		<th><strong>Capture Points</strong></th>
		<th><strong>Kills</strong></th>
		<th><strong>Last ON</strong></th>
	</thead>
	<?php
		$mQuery = mysql_query("SELECT * FROM `Accounts` WHERE `GangID` = '$gID' ORDER BY `GangRank` DESC, `GangPoints` DESC"); $rank = 0;
		if(mysql_num_rows($mQuery) != 0)
		{	
			while($row = mysql_fetch_array($mQuery))
			{
				$LoggedIn = $row["LoggedIn"];
				$rank++; include("includes/arrays.php"); 
				if($rank == 1 || $rank == 2 || $rank == 3) $RankString = "<font color=#FF0000><i class='fa fa-star'></i></font>";
				else if($rank == 4 || $rank == 5 || $rank == 6) $RankString = "<font color=#FFCC00><i class='fa fa-star'></i></font>";
				else if($rank == 7 || $rank == 8 || $rank == 9) $RankString = "<font color=#05C81F><i class='fa fa-star'></i></font>";
				else $RankString = "<i class='fa fa-star'></i>";
			?>
			<tr>
				<td><?= $RankString ?></td>
				<td><a href="/playerstats.php?player=<?= $row["Name"]; ?>"><font color="#00BBF6"><b><?= $row["Name"]; ?> <?= $onoff_types[$row["LoggedIn"]]; ?></b></font></a></td>
				<td><i class="fa fa-chess-rook"></i> <?= $ranks_types_gang[$row["GangRank"]]; ?></font></td>
				<td><i class="fa fa-chess-queen"></i> <?= $row["GangPoints"]; ?></td>
				<td><i class="fa fa-flag"></i> <?= $row["GangCaptures"]; ?></td>
				<td><font color="#05C81F"><i class="fa fa-bullseye"></i></font> <?= $row["GangKills"]; ?></td>
				<td><font color="red"><i class="far fa-clock"></i></font> <?= $row["LastOn"]; ?></td>
			</tr>
			<?php
			}
		}
		else if(mysql_num_rows($mQuery) == 0)
		{
			?>
			<tr>
				<td>No existing members.</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php
		}
		?>
	</table>
	<?php
}	
else
{
	?>
	<?php DisplayHeader($userplayer, "Gangs");?>
	<hr>
	<div class="orange-box2"><center><font color="orange"><i class="fa fa-users"></i></font> Below you will find informations and detailed statistics about our server gangs. <font color="orange"><i class="fa fa-users"></i></font></center></div>
	<hr>
	<table class="bella">
	<thead>
		<th><i class="fa fa-trophy"></i></th>
		<th>Name</th>
		<th>Total Points</th>
		<th>Kills</th>
		<th>Captures</th>
		<th>Members</th>
		<th>Forum</th>
	</thead>
	<?php

	$tQuery = mysql_query("SELECT * FROM `Gangs` ORDER BY `GangPoints` DESC"); $rank = 0;

	
	while($row = mysql_fetch_array($tQuery)) 
	{
		$rank ++;
		//-------------------------------------------------------------------------------------------
		if($rank == 1) $RankString = "<font color=#FF0000><i class='fa fa-star'></i></font>";
		else if($rank == 2) $RankString = "<font color=#FFCC00><i class='fa fa-star'></i></font>";
		else if($rank == 3) $RankString = "<font color=#05C81F><i class='fa fa-star'></i></font>";
		else $RankString = "<i class='fa fa-star'></i>";
		//-------------------------------------------------------------------------------------------
		$gangid = $row['ID'];
		//-------------------------------------------------------------------------------------------
		echo "<tr>
				<td>".$RankString."</td>
				<td><a href='/gangs.php?gang=".$row["ID"]."'>".$row["GangName"]."</a></td>
				<td><i class='fa fa-chess-queen'></i> ".$row["GangPoints"]."</td>
				<td><font color='#05C81F'><i class='fa fa-bullseye'></i></font> ".$row["GangKills"]."</td>
				<td><i class='fa fa-flag'></i> ".$row["GangCaptures"]."</td>
				<td><i class='fa fa-users'></i> ".GetGangMembers($gangid)."</font></td>
				<td><a href='/forums?'><font color='FF9900'><i class='fa fa-folder-open'></i></font> Forum</a></td>
			  </tr>";
	}
	?>
	</table>
	<hr>
	<div class="blue-box"><center><strong>This page has been lastly updated on <?= GetDateUpdate() ?>!</strong></center></div>
	<hr>
	<?php
}
?>
</div>
<?php require_once("a_Footer.php"); ?>