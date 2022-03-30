<?php 
session_start();
$sessid = mysql_real_escape_string($_COOKIE['sessionID']);
if(isset($_COOKIE['sessionID'])) 
{
	$sesidq = "SELECT * FROM `Sessions` WHERE `SessID` = '$sessid'"; 
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	$sesid = mysql_query($sesidq); $works = mysql_num_rows($sesid);
	//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
	if($works >= 1)
	{
		while($row = mysql_fetch_array($sesid)) 
		{ 
			$accID = $row['AccID']; 
			$Query = mysql_query("SELECT * FROM `Accounts` WHERE `ID` = '$accID'");
			while($row2 = mysql_fetch_array($Query)) 
			{ 
				$userplayer = $row2['Name']; 
				$userid = $row2['ID'];
				$rcontype = $row2['RconType'];
				$userblacklist = $row2['BlackList'];
				$userblacklistby = $row2['BlackListBy'];
				$userblacklistdate = $row2['BlackListDate'];
				$_SESSION['ServerNameLogged'] = $userplayer;
				$_SESSION['RconType'] = $rcontype;
			}
		}
	}
	else 
	{
		$delete = mysql_query("DELETE FROM `Sessions` WHERE SessID='$sessid'");
		setcookie('sessionID', null, -1, '/'); 
		unset($_COOKIE['sessionID']);
		$_SESSION['ServerNameLogged'] = "";
		$_SESSION['RconType'] = 0;
	}
}
else 
{
	unset($_COOKIE['sessionID']);
	setcookie('sessionID', '', time() - 3600);
}
// -> Some Informations from database
$ServerSlots = 100;
$PlayersOnline = mysql_num_rows(mysql_query("SELECT * FROM `Accounts` WHERE `LoggedIn` = 1"));
$TotalPlayers = mysql_num_rows(mysql_query("SELECT * FROM `Accounts`"));

function GetTopPlayer($topID, $player)
{
	if($topID == 1) $cachestring = "Activity";
	if($topID == 2) $cachestring = "HoursMonth";
	if($topID == 3) $cachestring = "KillsMonth";
	if($topID == 4) $cachestring = "StuntMonth";
	if($topID == 5) $cachestring = "DriftMonth";
	if($topID == 6) $cachestring = "RaceMonth";
	//------------------------------------------------------------------------------------------
	$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `$cachestring` DESC LIMIT $player");
	while($row = mysql_fetch_array($Query))
	{
		$name = $row['Name'];
		if($topID == 1) $string = "<font color='FFCC00'>$name</font> - $row[Activity] admin points";
		if($topID == 2) $string = "<font color='FFCC00'>$name</font> - $row[HoursMonth] hours";
		if($topID == 3) $string = "<font color='FFCC00'>$name</font> - $row[KillsMonth] kills";
		if($topID == 4) $string = "<font color='FFCC00'>$name</font> - $row[StuntMonth] stunt points";
		if($topID == 5) $string = "<font color='FFCC00'>$name</font> - $row[DriftMonth] drift points";
		if($topID == 6) $string = "<font color='FFCC00'>$name</font> - $row[RaceMonth] race points";
	}
	return $string;
}
function GetTopGang($gang)
{
	$Query = mysql_query("SELECT * FROM `Gangs` ORDER BY `GangPoints` DESC LIMIT $gang");
	while($row = mysql_fetch_array($Query))
	{
		$name = $row['GangName'];
		$string = "<font color='FFCC00'>$name</font> - $row[GangPoints] gang points";
	}
	return $string;
}
function GetLastDonation()
{
	$Query = mysql_query("SELECT * FROM `Donation` WHERE `Status` = 2 ORDER BY `ID`");
	while($row = mysql_fetch_array($Query))
	{
		$name = $row['By'];
		$amount = $row['Amount'];
		$date = $row['Date'];
		$time = $row['Time'];
		//----------------------------------------------------------------------------
		$string = "<strong><font color='#FFCC00'>$name</font></strong><br>
				  donated <strong>$amount</strong> euro<br>
		          on <strong><font color='#FFCC00'>$date</font></strong> at <strong><font color='#FFCC00'>$time</font></strong>";
	}
	return $string;
}
function GetCountOfTodayPeak()
{
	$Query = mysql_query("SELECT * FROM `ServerCFG`"); 
	while($row = mysql_fetch_array($Query)) $count = $row['TodayPeak'];
	return $count;
}
function GetAvaragePlayers()
{
    $Query = mysql_query("SELECT * FROM `ServerCFG`"); 
	while($row = mysql_fetch_array($Query)) $count = $row['RecordP'];
	return $count;
}
function GetServerIP()
{
    $Query = mysql_query("SELECT * FROM `ServerCFG`"); 
	while($row = mysql_fetch_array($Query)) $ip = $row['ServerIP'];
	return $ip;
}
function DisplayHeader($author, $text)
{
	if(isset($_COOKIE['sessionID']))
	{
		?>
		<div style="float:left; padding-top: 9px; padding-bottom: 9px;"><strong>Buna, <a href="/account.php"><font color="red"><?=$author?></font></a>!</strong></div>
		<div style="float:right; padding-top: 9px; padding-bottom: 9px;"><a href="/account.php?action=logout"><strong>Deconecteaza-te!</strong></a></div>
		<?php
	}
	else
	{
		?>
		<div style="float:left; padding-top: 9px; padding-bottom: 9px;"><strong>Niciun cont conectat.</strong></div>
		<div style="float:right; padding-top: 9px; padding-bottom: 9px;"><a href="/account.php"><strong>Conecteaza-te!</strong></a></div>
		<?php
	}
	?>
	<h1 class="ipsType_pagetitle"><center><?=$text?></center></h1>
	<?php
}
function GetPanelLogType($type)
{
	switch($type)
	{
		case 1: $string = "Discord Settings"; break;
		case 2: $string = "Donation Settings"; break;
		case 3: $string = "Online Player Kick"; break;
		case 4: $string = "Player Stats Modify"; break;
		default: $string = "Undefined"; break;
	}
	return $string;
}
function CreatePanelLog($type, $accid, $log) 
{
	$date1 = date("d.m.Y");
	$date2 = date("H:i");
	mysql_query("INSERT INTO `LogsPanel` VALUES (0, '$type', '$accid', '$log', '$date1 at $date2')");					
}
function custom_length($x, $length)
{
	if(strlen($x)<=$length)
	{
		return $x;
	}
	else
	{
		$y=substr($x,0,$length) . '...';
		return $y;
	}
}
function GetPlayerNameByID($id)
{
    $Query = mysql_query("SELECT * FROM `Accounts` WHERE `ID` = '$id'");
    while($row = mysql_fetch_array($Query)) $string = $row['Name']; 
    return $string;
}
function GetIfPlayerOnline($status)
{
	if($status == 1) $string = "<div style='float:right;'><a href='#header' title='Player is online!'><font color='#05C81F'><i class='far fa-check-circle'></i></font></a></div>";
	else $string = "";
	return $string;
}
function GetMonthName($month)
{
	if($month == 1) $string = "January";
	if($month == 2) $string = "February";
	if($month == 3) $string = "March";
	if($month == 4) $string = "April";
	if($month == 5) $string = "May";
	if($month == 6) $string = "June";
	if($month == 7) $string = "July";
	if($month == 8) $string = "August";
	if($month == 9) $string = "September";
	if($month == 10) $string = "October";
	if($month == 11) $string = "November";
	if($month == 12) $string = "December";
	return $string;
}
function CheckRank($Value, $Option)
{
	if($Option == "Kills")
	{
		if($Value >= 0) $Rank = "Newbie";
		if($Value > 199) $Rank = "Soldier";
		if($Value > 399) $Rank = "Advanced Killer";
		if($Value > 599) $Rank = "Expert Killer";
		if($Value > 799) $Rank = "Assasin";
		if($Value > 999) $Rank = "Exterminator";
		if($Value > 1299) $Rank = "Psycho";
		if($Value > 1599) $Rank = "Ultra Killer";
		if($Value > 1999) $Rank = "Godlike";
		return $Rank;
	}
	else if($Option == "StuntRank")
	{	
		if($Value >= 0) $StuntRank = "Newbie";
		if($Value > 199) $StuntRank = "Experienced Stunter";
		if($Value > 499) $StuntRank = "Advanced Stunter";
		if($Value > 799) $StuntRank = "Expert Stunter";
		if($Value > 999) $StuntRank = "Professional Stunter";
		if($Value > 1499) $StuntRank = "Super Stunter";
		return $StuntRank;
	}
	else if($Option == "DriftRank")
	{
		if($Value >= 0) $DriftRank = "Newbie";
		if($Value > 199) $DriftRank = "Experienced Drifter";
		if($Value > 499) $DriftRank = "Pro Drifter";
		if($Value > 799) $DriftRank = "Hot Wheels";
		if($Value > 999) $DriftRank = "Master Drifter";
		if($Value > 1299 ) $DriftRank = "Fire Tires";
		if($Value > 2499 ) $DriftRank = "Drift King";
		return $DriftRank;
	}
	else if($Option == "RaceRank")
	{
		if($Value >= 0) $RaceRank = "Newbie";
		if($Value > 199) $RaceRank = "Experienced Driver";
		if($Value > 499) $RaceRank = "Most Wanted Driver";
		if($Value > 799) $RaceRank = "Street Legend";
		if($Value > 999) $RaceRank = "Street King";
		if($Value > 1299) $RaceRank = "King of the Road";
		return $RaceRank;
	}
}
function CheckIfBanned($userplayer)
{
	$startcheck = mysql_num_rows(mysql_query("SELECT * FROM `Bans` WHERE `Name` = '$userplayer'"));
	
	if($startcheck != 0)
	{
		$bandetails = mysql_query("SELECT * FROM `Bans` WHERE `Name` = '$userplayer'");
		while($row = mysql_fetch_array($bandetails))
		{
			$timefromdb = time();
			$timeleft   = $row["BanExpire"] - $timefromdb;
			$daysleft   = round((($timeleft / 24) / 60) / 60);
			
			if($row["BanExpire"] == -1 && $daysleft < 1) $BanStats = "Status: <b>Permanent ban</b>.";
			else $BanStats = "Status: <b>$daysleft</b> Day(s) left.";
			
			Error("<p align=left><b>This account is banned.</b>
				   <br>
				   <br>
				   Banned by: <b>".$row["Admin"]."</b> on <b>".$row["BanDate"]." at ".$row["BanTime"]."</b>, for reason: <b>".$row["Reason"]."</b>.<br>
				   $BanStats</p>");
		}
	}
}
function CheckMaintenance($under_maintenance2)
{	
	if($under_maintenance2 == "1")
	{
		Header("Location: /stunt/error/?err=maintenance");
	}
	return 1;
}
function FindNonLinks()
{
	$text = @file_get_contents("");
	
	$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	
	if(preg_match($reg_exUrl, $text, $url)) 
	{
		echo preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $text);
	} 
	else 
	{
		echo $text;
	}
}
function CheckBanned($userplayer)
{
	$url = $_SERVER['REQUEST_URI'];
	$startcheck = mysql_num_rows(mysql_query("SELECT * FROM `Bans` WHERE `Name` = '$userplayer'"));
	
	if($startcheck != 0 && $url == '/account.php?action=banned')
	{
		return 1;
	}
	else if($startcheck != 0 && $url != '/account.php?action=banned')
	{
		Header("Location: /stunt/account.php?action=banned");
	}
	else if($startcheck == 0 && $url == '/account.php?action=banned')
	{
		Header("Location: /stunt/account.php?action=my");
	}
}
function CheckLocation($ip)
{
    $country  = "Unknown"; $city  = "Unknown";
    
    //curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=$ip"); -> This is an old site
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://ipinfo.io/$ip/json");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $ip_data_in = curl_exec($ch);
    curl_close($ch);
    
    $ip_data = json_decode($ip_data_in,true);
    $ip_data = str_replace('&quot;', '"', $ip_data);
    
    if($ip_data && $ip_data['country'] != null) 
    {
        $country = $ip_data['country'];
    }
    
	if($ip_data && $ip_data['city'] != null) 
	{
        $city = $ip_data['city'];
    }
    return ''.$country.', '.$city;
}
function CheckLoggedIn()
{
	if(!isset($_COOKIE['sessionID']))
	{
		Header("Location: /stunt/account.php?action=login");
	}
	else 
	{
		Header("Location: /stunt/account.php?action=my");
	}
}
function Info($info)
{
?>
<div class="alert alert-info"><?= $info ?></div>
<?php
}
function Success2($succes)
{
?>
	<div class="orange-box"><strong><?= $succes ?></strong></div>
<?php
}
function Success($succes)
{
?>
	<div class="orange-box"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?= $succes ?></strong></div>
<?php
}
function Error($error)
{
?>
    <div class="alert alert-danger" role="alert">
	    <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $error ?>
    </div>
<?php
}
function Error2($error)
{
?>
	<div class="alert alert-error"><?= $error ?></div>
<?php
}
?>