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
function GetClanMembers($ID)
{
    $cMembers = mysql_query("SELECT * FROM `Accounts` WHERE `ClanID` = '$ID'"); $members = 0;
    while($rows = mysql_fetch_array($cMembers)) $members++;
    return $members;
}
?>
<title>Clans</title>
<center>
	<div class="ex">
<?php
$cID = isset($_GET['clan']) ? $_GET['clan'] : '';
$cID = mysql_real_escape_string($cID);
	
if(isset($cID) && $cID != "" && $cID != 0)
{
	$cQuery = mysql_query("SELECT * FROM `Clans` WHERE `ID` = '$cID'"); 
	while($row = mysql_fetch_array($cQuery))
	{
	?>
	<table class="bella">
	<colgroup><col width='25'><col width='100'><col width='100'><col width='25'><col width='25'><col width='25'><col width='100'></colgroup>
	<center>
		<?php DisplayHeader($userplayer, $row["Name"]);?>
		<hr>
		<div class="orange-box2">
			<font color="orange"></font>
			<center>
				<font color="orange"><i class="fa fa-users"></i></font> Below you will find advanced details and informations about this clan! <font color="orange"><i class="fa fa-users"></i></font>
			</center>
		</div>
		<hr>
		<b>Weapons:</b>
		<br>
			<img src="<?= $domainname ?>/images/guns/<?= $row["W1"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["W2"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["W3"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["W4"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["W5"] ?>.png"/>
			<img src="<?= $domainname ?>/images/guns/<?= $row["W6"] ?>.png"/>
		<br><br>
			This clan has <font color="#FF0000"><strong><?= GetClanMembers($cID) ?></strong></font> members, <font color="#FF0000"><strong><?= $row["Kills"] ?></strong></font> kills, <font color="#FF0000"><strong><?= $row["Deaths"] ?></strong></font> deaths, <font color="#FF0000"><strong><?= $row["Captures"] ?></strong></font> capture points &amp; <font color="#FF0000"><strong><?= $row["Points"] ?></strong></font> clan points in total!
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
		$mQuery = mysql_query("SELECT * FROM `Accounts` WHERE `ClanID` = '$cID' ORDER BY `ClanRank` DESC, `ClanPoints` DESC"); $rank = 0;
		while($row = mysql_fetch_array($mQuery))
		{
			$rank++; include("includes/arrays.php");
			if($rank == 1 || $rank == 2 || $rank == 3) $RankString = "<font color=#FF0000><i class='fa fa-star'></i></font>";
			else if($rank == 4 || $rank == 5 || $rank == 6) $RankString = "<font color=#FFCC00><i class='fa fa-star'></i></font>";
			else if($rank == 7 || $rank == 8 || $rank == 9) $RankString = "<font color=#05C81F><i class='fa fa-star'></i></font>";
			else $RankString = "<i class='fa fa-star'></i>";
		?>
		<tr>
			<td><?= $RankString ?></td>
			<td><a href="/playerstats.php?player=<?= $row["Name"]; ?>"><font color="#00BBF6"><b><?= $row["Name"]; ?> <?= $onoff_types[$row["LoggedIn"]]; ?></b></font></a></td>
			<td><i class="fa fa-chess-rook"></i> <?= $ranks_types_clan[$row["ClanRank"]]; ?></font></td>
			<td><i class="fa fa-chess-queen"></i> <?= $row["ClanPoints"]; ?></td>
			<td><i class="fa fa-flag"></i> <?= $row["ClanCaptures"]; ?></td>
			<td><font color="#05C81F"><i class="fa fa-bullseye"></i></font> <?= $row["ClanKills"]; ?></td>
			<td><font color="red"><i class="far fa-clock"></i></font> <?= $row["LastOn"]; ?></td>
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
	<?php DisplayHeader($userplayer, "Clans");?>
	<hr>
	<div class="orange-box2"><center><font color="orange"><i class="fa fa-users"></i></font> Below you will find informations and detailed statistics about our server clans. <font color="orange"><i class="fa fa-users"></i></font></center></div>
	<hr>
	<table class="bella">
	<thead>
		<th><i class="fa fa-trophy"></i></th>
		<th>Name</th>
		<th>Total Points</th>
		<th>Kills</th>
		<th>Captures</th>
		<th>Wins</th>
		<th>Losts</th>
		<th>Stage</th>
		<th>Members</th>
		<th>Created</th>
		<th>Founder</th>
	</thead>
	<?php

	$tQuery = mysql_query("SELECT * FROM `Clans` ORDER BY `Points` DESC LIMIT 100"); $rank = 0;

	if(mysql_num_rows($tQuery) != 0)
	{
		while($row = mysql_fetch_array($tQuery)) 
		{
			$rank ++;
			//-------------------------------------------------------------------------------------------
			if($rank == 1) $RankString = "<font color=#FF0000><i class='fa fa-star'></i></font>";
			else if($rank == 2) $RankString = "<font color=#FFCC00><i class='fa fa-star'></i></font>";
			else if($rank == 3) $RankString = "<font color=#05C81F><i class='fa fa-star'></i></font>";
			else $RankString = "<i class='fa fa-star'></i>";
			//-------------------------------------------------------------------------------------------
			$pStage = $row['Level'];
			$clanid = $row['ID'];
			//-------------------------------------------------------------------------------------------
			if($pStage == 1) $stage = "<font color='orange'><i class='fa fa-user'></i> Standard</font>";
			else if($pStage == 2) $stage = "<font color='red'><i class='fa fa-user'></i> Premium</font>";
			//-------------------------------------------------------------------------------------------
			$tQuery2 = mysql_query("SELECT * FROM `Accounts` WHERE `ClanID` = '$clanid' AND `ClanRank` = '4'");
			while($row2 = mysql_fetch_array($tQuery2)) { $foundername = $row2['Name']; }
			//-------------------------------------------------------------------------------------------
			echo "<tr>
					<td>".$RankString."</td>
					<td><a href='/clans.php?clan=".$row["ID"]."'>".$row["Name"]."</a></td>
					<td><i class='fa fa-chess-queen'></i> ".$row["Points"]."</td>
					<td><font color='#05C81F'><i class='fa fa-bullseye'></i></font> ".$row["Kills"]."</td>
					<td><i class='fa fa-flag'></i> ".$row["Captures"]."</td>
					<td><font color='#05C81F'><i class='fa fa-flag'></i></font> ".$row["Wins"]."</span></td>
					<td><font color='red'><i class='fa fa-times'></i></font> ".$row["Losts"]."/5</span></td>
					<td>".$stage."</td>
					<td><i class='fa fa-users'></i> ".GetClanMembers($clanid)."</font></td>
					<td><font color='#FFCC00'><i class='far fa-clock'></i></font> ".$row["Since"]."</font></td>
					<td><i class='fa fa-user'></i> $foundername</td>
				  </tr>";
		}
	}
	else if(mysql_num_rows($tQuery) == 0)
	{
		?>
		<tr>
		<td>No available clans.</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<tr>
		<?php
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