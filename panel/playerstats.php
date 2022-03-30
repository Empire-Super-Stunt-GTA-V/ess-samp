<?php require_once("a_Header.php"); ?>
<title>Online Player Stats</title>	
<div class="ex">
<?php
if(!isset($_GET["player"]))
{
?>
	<?php DisplayHeader($userplayer, "Online Player Stats");?>
	<center>
	<div class="main-middle">
		<div class="block-content collapse in">
		<div class="navigation">
		<form action = "playerstats.php" method = "GET">		
		<p>
		<hr>
		<div class="blue-box">
		<center>
		<font color="#09C">
		<i class='fa fa-users'></i>
		</font> View advanced player statistics by searching for the name of the account!</b></center>
		</div>
		<hr>
		<br>
		<strong><i class="fa fa-search fa-3x"></i> <i class="fa fa-user fa-3x"></i><br>
		Name of the player</strong><br>
		<form action = "playerstats.php" method = "GET">
		<input id="text" name = "player" class="form_field"><br><br>
		<button id="submit" onclick="name" class="button">Search</button>
		</form>			
		</form>
		</div>
		</div>
	</div>
	</center>
<?php
}
if(isset($_GET["player"]))
{	
	$PropName = ""; 
	
	$Name = mysql_real_escape_string(stripslashes($_GET["player"]));
	$QResult = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$Name'");

	if(mysql_num_rows($QResult) == 0)
	{
	?>
	<?php DisplayHeader($userplayer, "Online Player Stats");?>
    <center>
    	<div class="main-middle">
    		<div class="block-content collapse in">
    		<div class="navigation">
    		<form action = "playerstats.php" method = "GET">		
    		<p>
    		<hr>
    		<div class="blue-box">
    		<center>
    		<font color="#09C">
    		<i class='fa fa-users'></i>
    		</font> View advanced player statistics by searching for the name of the account!</b></center>
    		</div>
    		<hr>
    		<br>
    		<strong><i class="fa fa-search fa-3x"></i> <i class="fa fa-user fa-3x"></i><br>
    		Name of the player</strong><br>
    		<form action = "playerstats.php" method = "GET">
    		<input id="text" name = "player" class="form_field"><br><br>
    		<button id="submit" onclick="name" class="button">Search</button>
    		</form>			
    		</form>
    		</div>
    		</div>
    	</div>
	</center>
	<hr>
	<div class="warn-box">
    	<strong>Unfortunately there is no player with this name! Please try again your search after you make sure that the inputted details are valid!</strong>
    </div>
    <hr>
	<?php
	}
	else 
	{
		$row = mysql_fetch_array($QResult);
		
		if($row["GangID"] != 0) $Skin = $row["GangSkin"];
		else $Skin = $row["FavSkin"];

		switch($row["Property"])
		{
			case 0: $HProp = "No"; break;
			default: 
			{
				$HProp = "Yes"; 
				$QPN = mysql_query("SELECT `PropName` FROM `Properties` WHERE `ID` = '".$row["Property"]."'");
				$RPName = mysql_result($QPN, 0, "PropName");
				$PropName = "(<font color='#007700'>$RPName</font>)";
				break;
			}
		}
		switch($row["House"])
		{
			case 0: $House = "No"; break;
			default: $House = "Yes"; break;
		}	
		if($row["GangID"] == 0) $Gang = "None";
		else 
		{
			$QGName = mysql_query("SELECT `GangName` FROM `Gangs` WHERE `ID` = '".$row["GangID"]."'");
			$Gang = mysql_result($QGName, 0, "GangName");
		}	
		?>
		
    <center>
    <?php DisplayHeader($userplayer, "Online Player Stats");?>
    <hr>
    <div class="blue-box"><center><font color="#09C"><i class="fa fa-user"></i></font> View advanced player statistics by searching for the name of the account!</center></div>
    <hr>
    <br>
    <strong><i class="fa fa-search fa-3x"></i> <i class="fa fa-user fa-3x"></i><br>
    Name of the player</strong><br>
    <form action = "playerstats.php" method = "GET">
    <input id="text" name = "player" class="form_field"><br><br>
    <button id="submit" onclick="name" class="button">Search</button>
    </form>
    <br>
    <?php CheckIfBanned($Name); ?>
    <table class="bella" style="padding-top: 10px;">
    <colgroup><col width="300">
    <col width="300">
    <tr><th><strong>Statistics</strong></th>								
    <th><strong>Value</strong></th></tr>
    
    <?php
    $PropName = ""; $Name = "";
    $Name = mysql_real_escape_string(stripslashes($_GET["player"]));
    $QResult = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$Name'");
    $row = mysql_fetch_array($QResult);
    
    if($row["GangID"] != 0) $Skin = $row["GangSkin"];
    else $Skin = $row["FavSkin"];
    
    //-------------------------------------------------------------------------------------------
    $pOn++; $pOn = $row['LoggedIn'];
    if($pOn == 1) $pOnEx = "<font color=grey><font color=green>Yes<font color=grey></font>";
    else $pOnEx = "<font color=grey><font color=red>No<font color=grey></font>";
    
    //-------------------------------------------------------------------------------------------
    $jail++; $jail = $row['Jailed'];
    if($jail == 1) $jailex = "<font color=#00ff00>Yes</font>";
    else $jailex = "<font color=#00ff00>No</font>";
    
    //-------------------------------------------------------------------------------------------
    $warn++; $warn = $row['Warnings'];
    if($warn == 1) $warnex = "<font color=#00ff00>Yes</font>";
    else $warnex = "<font color=#00ff00>None</font>";
    
    //-------------------------------------------------------------------------------------------
    $muted++; $muted = $row['Muted'];
    if($muted == 1) $muteex = "<font color=#00ff00>Yes</font>";
    else $muteex = "<font color=#00ff00>No</font>";
    
    //-------------------------------------------------------------------------------------------
    $vip++; $vip = $row['VIP'];
    if($vip == 0) $vipex = "<font color=red>No</font>";
    else if($vip == 1) $vipex = "<font color=#00FF00>Yes</font></font>";
    else if($vip == 2) $vipex = "<font color=#00FF00>Yes</font> - <font color=orange>Gold</font></font>";
    
    //-------------------------------------------------------------------------------------------
    $vip++; $vip = $row['VIPTime'];
    if($vip == 0) $viptex = "<font color=#00FF00>Permanent</font>";
    else if($vip == 1) $viptex = "<font color=RED>Temporary</font></font>";
    
    //-------------------------------------------------------------------------------------------
    $admin++; $admin = $row['Level'];
    if($admin == 0) $adminex = "<font color=red>No</font>";
    else if($admin != 0) $adminex = "<font color=#00FF00>Yes</font> - Level: ".$row["Level"]."";
    
    //-------------------------------------------------------------------------------------------
    $spass++; $spass = $row['SPassword'];
    if($spass == -1) $spassex = "<font color=red>No</font> - You can always set one online on the server by typing /spassword.";
    else if($spass != 0) $spassex = "<font color=#00FF00>Yes</font>";
    
    //-------------------------------------------------------------------------------------------
    $email++; $email = $row['E-Mail'];
    if($email == "None") $emailex = "None yet, please add one to increase your account security level!";
    else if($email != 0) $emailex = "<font color=#00FF00>Yes</font>";
    
    //-------------------------------------------------------------------------------------------
    $pRcon = $row['RconType'];
    if($pRcon == 1) $RconString = "<font color=grey>- <font color=white>Rcon<font color=grey></font>";
    else if($pRcon == 2) $RconString = "<font color=grey>- <font color=#FF5555>Support<font color=grey> </font>";
    else if($pRcon == 3) $RconString = "<font color=grey>- <font color=red>King<font color=grey></font>";
    else $RconString = "";
    //-------------------------------------------------------------------------------------------
    $totalmonthex = "".$row["HoursMonth"]." hours, ".$row["StuntMonth"]." stunt points, ".$row["DriftMonth"]." drift points, ".$row["RaceMonth"]." race points, ".$row["KillsMonth"]." kills points";

    function ranks_types($rank, $type)
    {
    	if($type == 1)
    	{
    		if($rank == 1) $string = "Member Rank 1";
    		else if($rank == 2) $string = "Member Rank 2";
    		else if($rank == 3) $string = "Member Rank 3";
    		else if($rank == 4) $string = "Member Rank 4";
    		else if($rank == 5) $string = "Member Rank 5";
    		else if($rank == 6) $string = "Co-Leader";
    		else if($rank == 7) $string = "Leader";
    		else if($rank == 8) $string = "Owner";
    		else $string = "None";
    	}
    	//---------------------------------------------------
    	else if($type == 2)
    	{
    		if($rank == 1) $string = "Member";
    		else if($rank == 2) $string = "Co-Leader";
    		else if($rank == 3) $string = "Leader";
    		else if($rank == 4) $string = "Founder";
    		else $string = "None";
    	}
    	return $string;
    }
    ?>	

    <tr><td><i class="fa fa-user"></i> Name</td>							<td><font color=#00ff00><?= $row["Name"]; ?></td></font></tr>
    <tr><td><i class="fa fa-map-signs"></i> Online</td>						<td><?= $pOnEx ?></td></tr>
    <tr><td><i class="fa fa-user"></i> Admin</td>							<td><?= $adminex ?> <?= $RconString ?></td></tr>
    <tr><td><i class="fa fa-star"></i> VIP</td>								<td><?= $vipex ?></td></tr>
    <tr><td><i class="fa fa-hourglass-half"></i> VIP Valability</td>		<td><?= $viptex ?></td></tr>
    <tr><td><i class="fa fa-gem"></i> Gems</td>								<td><?= $row["Gems"]; ?></td></tr>
    <tr><td><i class="fa fa-money-bill-alt"></i> Money</td>					<td>$<?= $row["Cash"]; ?></td></tr>
    <tr><td><i class="fa fa-database"></i> Coins</td>						<td><?= $row["Coins"]; ?></td></tr>
    <tr><td><i class="far fa-dot-circle"></i> Killing Spree</td>			<td><?= $row["KillingSpree"]; ?></td></tr>
    <tr><td><i class="fa fa-crosshairs"></i> Headshots</td>					<td><?= $row["Headshots"]; ?></td></tr>
    <tr><td><i class="fa fa-universal-access"></i> Kills</td>				<td><?= $row["Kills"]; ?></td></tr>
    <tr><td><i class="fa fa-ambulance"></i> Deaths</td>						<td><?= $row["Deaths"]; ?></td></tr>
    <tr><td><i class="far fa-clock"></i> Online time</td>					<td><?= $row["Hours"]; ?> hours & <?= $row["Minutes"]; ?> minutes</td></tr>
    <tr><td><i class="fa fa-motorcycle"></i> Stunt Points</td>				<td><?= $row["StuntScore"]; ?></td></tr>
    <tr><td><i class="fa fa-car"></i> Drift Points</td>						<td><?= $row["DriftScore"]; ?></td></tr>
    <tr><td><i class="fa fa-flag-checkered"></i> Race Points</td>			<td><?= $row["RaceScore"]; ?></td></tr>
    <tr><td><i class="fa fa-thumbs-up"></i> Respect</td>					<td><font color="#05C81F">+<?= $row["Positive"]; ?></font> / <font color="#FF0000">-<?= $row["Negative"]; ?></font></td>
    <tr><td><i class="fa fa-bomb"></i> C4</td>								<td><?= $row["C4"]; ?></td></tr>
    <tr><td><i class="fa fa-building"></i> Business</td>					<td><?= $HProp ?></td></tr>
    <tr><td><i class="fa fa-home"></i> House</td>							<td><?= $House ?></td></tr>
    <tr><td><i class="fa fa-exclamation-triangle"></i> Active Warnings</td>	<td><?= $warnex ?></td></tr>
    <tr><td><i class="far fa-id-card"></i> Player Skin</td>					<td><?= $row["FavSkin"]; ?></td></tr>
    <tr><td><i class="fa fa-calendar-check"></i> This month statistics</td> <td><?= $totalmonthex ?></td></tr>
    <tr><td><i class="fa fa-user-circle"></i> Gang</td>						<td><font color="#0077CC"><?= $Gang ?></font> | Rank: <?= $row["GangRank"];?> (<font color="red"><?= ranks_types($row["GangRank"], 1) ?></font>)</td></tr>
    <tr><td><i class="fa fa-user-secret"></i> Clan</td>						<td><font color="#0077CC"><?= $row["ClanID"]; ?></font> | Rank: <?= $row["ClanRank"]; ?> (<font color="red"><?= ranks_types($row["ClanRank"], 2) ?></font>)</td></tr>
    <tr><td><i class="fa fa-heart"></i> Registration date</td>				<td><?= $row["RegisterDate"]; ?></td></tr>
    <tr><td><i class="fa fa-calendar-check"></i> Last time online</td>		<td><?= $row["LastOn"]; ?></td></tr>
    </table>
    
    <hr>
    <div class="blue-box-info">For more details and control options, visit your <a href="/account.php">My Account</a> area!</div>
    <hr>

    </center>
    <?php
	}
}
else
{
	?>
	<style>
	#refresh_TAB_DIV 
	{
		display:block;
		-webkit-animation: fadeinout 5s linear forwards;
		animation: fadeinout 5s linear forwards;
		animation-delay: 25s;
		-webkit-animation-delay: 25s;
	}
	</style>
    <center>
    		<table class="bella">
			    <hr>
			    <div class="blue-box">
				<center>
				<font color="#09C">
				<i class='fa fa-users'></i>
				</font>View the list with all connected players to the server!</b></center>
				</div>
				<hr>
    
    <?php
    $Query = mysql_query("SELECT * FROM `Accounts` WHERE `Status` >= 1 ORDER BY `ID` DESC"); $prank = -1;
    if(mysql_num_rows($Query) != 0)
    {
        while($row = mysql_fetch_array($Query))
        {
            $prank++;
            $pRcon = $row['RconType'];
        	$pAdmin = $row['Level'];
        	$pVip = $row['VIP'];
        	//-------------------------------------------------------------------------------------------
        	if($pRcon == 1) $rank = "<font color=white><i class='fa fa-user'></i></font> ";
        	else if($pRcon == 2) $rank = "<font color=#FF5555><i class='fa fa-user'></i></font> ";
			else if($pRcon == 3) $rank = "<font color=red><i class='fa fa-user'></i></font> ";
        	else if($pAdmin != 0) $rank = "<font color='#09C'><i class='fa fa-user'></i></font> ";
        	else if($pVip >= 1) $rank = "<font color='#FFCC00'><i class='fa fa-user'></i></font> ";
        	else $rank = "<font color='#09C'><i class='fa fa-user'></i></font> ";
        	//-------------------------------------------------------------------------------------------
        	$pLoggedIn = $row['LoggedIn'];
        	$pStatsNote = $row['StatsNote'];
        	$pStatusRank = $row['Status'];
        	$pAFK = $row['AFK'];
        	//-------------------------------------------------------------------------------------------
        	if($pStatusRank == 1) $pStatus = "<font color=#FF0000><i class='fa fa-times'></i></font> Not logged in yet.";
        	else if($pStatusRank == 2) $pStatus = "<font color=#05C81F><i class='far fa-check-circle'></i></font> Logged In";
        	//-------------------------------------------------------------------------------------------
        	$pNote = "<i class='fa fa-star'></i></font> $pStatsNote / 10 Note";
        	//-------------------------------------------------------------------------------------------
        	if($pLoggedIn == 0) $pNowIcon = "<font color='#FFCC00'><i class='fas fa-spinner fa-spin'></i></font>";
        	else if($pLoggedIn == 1) $pNowIcon = "<font color='#05C81F'><i class='fas fa-sync fa-spin'></i></font>";
        	//-------------------------------------------------------------------------------------------
        	if($pStatusRank == 1) $pAFKEx = "<font color='#FFCC00'><i class='fas fa-spinner fa-spin'></i></font> Logging In...";
        	else if($pAFK == -1) $pAFKEx = "<font color='#05C81F'><i class='fas fa-sync fa-spin'></i></font> Playing";
        	else if($pAFK != 0) $pAFKEx = "<font color='#FFFF00'><i class='fas fa-circle-notch fa-spin'></i></font> Inactive since $pAFK mins ago";
        	else $pAFK = "<td><font color='#FFCC00'><i class='fas fa-spinner fa-spin'></i></font> Logging In...</td>";
        	//-------------------------------------------------------------------------------------------
			?>
			<tr>
				<td><?= $prank ?></td>
				<td><?= $rank ?><a href='/playerstats.php?player=<?=$row["Name"]?>'><font color=white> <?= $row["Name"] ?></a></td>
				<td><?= $pStatus ?></td>
				<td><?= $pAFKEx ?></font></td>
				<td><?= $pNote ?></td>
				<td><font color='#FFCC00'><i class='far fa-clock'></i></font> <?= $row["TimePlayed"] ?></td>
			</tr>
			<?php
        }
    }
    else if(mysql_num_rows($Query) == 0)
    {
        ?>
        <tr>
    		<td>No online players yet.</td>
        </tr>
        <?php
    }
}
?>	
</table>
</div>
<?php require_once("a_Footer.php"); ?>