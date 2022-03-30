<?php
require_once("a_Header.php"); 
$month = isset($_GET['month']) ? $_GET['month'] : '';
if($month != "")
{
	$filename = "includes/historyadmins/$month.php";
	if(file_exists($filename)) 
	{
		?><title>Admins - <?=GetMonthName(4+$month);?></title>
		<div class="ex"><?php
		DisplayHeader($userplayer, "Admins Team - Previous months"); ?>
		<hr>
		<div class="orange-box2">
			<center><font color="#FFCC00"><i class="far fa-clock fa-lg"></i></font><br>
			<strong><?=GetMonthName(4+$month);?></strong><br><br>
			<strong>Below you will find the full list of the active admins ordered by their activity for the month you have selected!<br>This page is being displayed as it was cached on the last day of that month.</strong></center>
		</div>
		<hr><?php
		require_once("includes/historyadmins/$month.php");
		?></div><?php
	} 
	else return header("Location: /admins");
} 
else if($month == "")
{
	?> 
	<title>Admins</title>
	<center>
	<div class="main-middle">
		<div class="ex">
			<table class="bella"> 
						<?php DisplayHeader($userplayer, "Admins Team");?>
						<tbody>
							<th><strong><i class="fa fa-trophy"></i></strong></th>
							<th><strong>Name</strong></th>
							<th><strong>Level</strong></th>
							<th><strong>Bans</strong></th>
							<th><strong>Kicks</strong></th>
							<th><strong>Warns</strong></th>
							<th><strong>Jails</strong></th>
							<th><strong>Mutes</strong></th>
							<th><strong>Reports</strong></th>
							<th><strong>Events</strong></th>
							<th><strong>Other</strong></th>
							<th><strong>Activity</strong></th>
							<th><strong>Total</strong></th>
							<th><strong>Online / Last On</strong></th>
							<th><strong>Admin Since</strong></th>
							<?php if($rcontype >= 2) { ?> <th><strong>Action</strong></th> <?php } ?>
							<p></p>
							<hr>
						<div class="blue-box">
						<center>
						<b><i class="fas fa-info-circle"></i> Mai jos puteti gasi lista intregii echipe administrative a server-ului, ordonati pe baza metricilor de activitate.<br>
						<i class="fas fa-exclamation-triangle"></i> Toti metricii / statisticile se reseteaza in prima zi a fiecarei luni.<br>
						<br>Aceasta pagina se actualizeaza automat la cateva ore.</b>
					</div>
				<hr>
			</tbody>
		</div>
	<?php
	$Query = mysql_query("SELECT * FROM `Accounts` WHERE `Level` > 0 ORDER BY `Activity` DESC"); $pRank = 0;
	while($row = mysql_fetch_array($Query))
	{
		$pRank++;
		//-------------------------------------------------------------------------------------------
		$pRconType = $row['RconType'];
		$pAdmin = $row['Level'];
		//-------------------------------------------------------------------------------------------
		if($pRconType == 1) $rank = "<font color=white><i class='fa fa-user'></i></font> ";
		else if($pRconType == 2) $rank = "<font color=#FF5555><i class='fa fa-user'></i></font> ";
		else if($pRconType == 3) $rank = "<font color=red><i class='fa fa-user'></i></font> ";
		else if($pAdmin != 0) $rank = "<font color='#09C'><i class='fa fa-user'></i></font> ";
		else $rank = "<font color='#09C'><i class='fa fa-user'></i></font> ";
		//-------------------------------------------------------------------------------------------
		if($pRank == 1) $RankString = "<font color=#FF0000><i class='fa fa-star'></i></font>";
		else if($pRank == 2) $RankString = "<font color=#FFCC00><i class='fa fa-star'></i></font>";
		else if($pRank == 3) $RankString = "<font color=#05C81F><i class='fa fa-star'></i></font>";
		else $RankString = "<i class='fa fa-star'></i>";
		//-------------------------------------------------------------------------------------------
		include("includes/arrays.php"); 
		?>
		<tr>
			<td><?=$RankString?></td>
			<td><?=$rank?><a href='/playerstats.php?player=<?=$row["Name"]?>'><font color=white><?=$row["Name"]?> <?=$onoff_types[$row["LoggedIn"]]?></a></td>
			<td><font color='#09C'><i class='fa fa-chess-queen'></i></font> <?=$row["Level"]?></td>
			<td><?=$row["Bans"]?></td>
			<td><?=$row["Kicks"]?></td>
			<td><?=$row["Warns"]?></td>
			<td><?=$row["Jails"]?></td>
			<td><?=$row["Mutes"]?></td>
			<td><font color='red'><i class='fa fa-flag'></i></font> <?=$row["ReportsClosed"]?> closed</td>
			<td><i class='fa fa-trophy'></i> <?=$row["EventsMaded"]?> made</td>
			<td><?=$row["ClearChats"]?></td>
			<td><font color='red'><i class='far fa-clock'></i></font> <?=$row["HoursAdmin"]?> hours</td>
			<td><?=$row["Activity"]?></td>
			<td><i class='far fa-calendar-check'></i> <?=$row['TimesOnline']?> times | <font color='#FFCC00'><?=$row["LastOn"]?></font></td>
			<td><font color='#FFCC00'><i class='fa fa-heart'></i></font> <?=$row["AdminSince"]?></td>
			<?php if($rcontype >= 2) { ?> <td><strong><font color='#09C'><i class='fas fa-hammer'></i></font><a href='/servercp.php?page=acp&id=<?=$row["ID"]?>'> ACP</a></strong></td> <?php } ?>
		</tr>
		<?php
	}
	?>		
			</table>
		
	<script>
	function onPastActivityShow() { document.getElementById("past_AA").style.display='block'; }
	function onPastActivityHide() { document.getElementById("past_AA").style.display='none'; }
	</script>
		<br>
		<center><strong><a href="#header" onclick="onPastActivityShow()"><i class="far fa-clock"></i> Click here for past activity</a></strong></center>
		<div id="past_AA" style="display: none;">
			<hr>
			<div class="orange-box2">
			<center>
			<font color="#FFCC00"><i class="far fa-clock fa-lg"></i></font><br><strong>2020</strong><br><br>
			<a href="/admins.php?month=1" class="button"><?=GetMonthName(5);?></a>
			<a href="/admins.php?month=2" class="button"><?=GetMonthName(6);?></a>
			<br><br>
			<center><a href="#header" onclick="onPastActivityHide()"><strong><i class="fa fa-times"></i> Hide</strong></a></center>
			</center></div>
			<hr>
		</div>
	 </div>
	<?php 
}
require_once("a_Footer.php"); ?>