<?php
require_once("a_Header.php");
?>
<title>Ban list</title>
<?php
$tablename  = "Bans"; $targetpage = ""; $mylevel = "";
//require_once("includes/pagination.php");

$unban = isset($_GET['unban']) ? $_GET['unban'] : '';
$unban = mysql_real_escape_string($unban);

if (isset($_COOKIE['sessionID'])) 
{
	$GetLevel = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
	while ($row = mysql_fetch_array($GetLevel))
	{
		$mylevel = $row["RconType"];
		if($mylevel >= 2) $actionstring = "<th>Action</th>";
	}
} 

if(isset($unban)) 
{
	if ($mylevel >= 2 && isset($_COOKIE['sessionID'])) mysql_query("DELETE FROM `Bans` WHERE `ID` = '$unban'");
}
?>
<center>
<div class="main-middle">
	<div class="ex">
	    <?php DisplayHeader($userplayer, "Player Un-Ban");?>
	    <hr>
	    <?php
	    $totalbans = number_format(mysql_num_rows(mysql_query("SELECT * FROM `Bans`")));
	    echo'<div class="orange-box2"><center>Lista de mai jos cuprinde un total de <strong>'.$totalbans.'</strong> jucatori cu interdictie temporara pe server, ordonati dupa data expirarii crescator!</center></div>';
	    ?>
	    <hr>
	    <div style="height: 70px; background: url(iamges/mtab-box.png); border: 2px solid #3b3b3b; border-radius: 5px; padding: 10px;">
        <table border="0">
        <tbody><tr>
        <td><img src="/images/ro-flag2.png" width="40"></td>
        <td>
        Dacă te regăsești în această listă, poți aplica pentru unban. Aplicația pentru unban nu îți garantează eliminarea interdicției, cererea ta putând fi respinsă dacă nu ai dovezi suficiente pentru a-ți dovedii nevinovăția!<br>
        Ai însă oricând posibilitatea de a cumpăra UnBan pe server-ul nostru din <a href="/shop.php">Shop</a>, iar codul primit îl poți folosii pentru a scoate ban-ul de pe un nume sau IP pe <a href="/unbanp.php">această pagină</a>.
        </td>
        </tr>
        <tr>
        <td><img src="/images/uk-flag2.png" width="40"></td>
        <td>If you find your name on this list, you can make an unban appeal. Your appeal will not guarantee your unban as your appeal could be rejected if you do not have enough proofs to sustain your innocence!<br>
        You always have the posibility to purchase UnBan on our server from <a href="/shop.php">Shop</a>, and the given key can be used to unban a name or an IP on <a href="/unbanp.php">this page</a>.
        </td>
        </tr>
        </tbody></table>
        </div>
        <br>
        <center><a href="/unban.php" class="button">Aplică pentru scoaterea unban / Apply for unban</a> <a href="/unbanp.php" class="button">Folosește codul de unban / Use unban key</a></center>
        <br>
		<table class="bella"> 
	    <colgroup><col width='200'><col width='200'><col width='200'><col width='200'><col width='60'><col width='25'></colgroup>
<?php
if ($_GET['page'] == "") $page = 1;
else $page = $_GET['page'];
$Limit   = (($page * 20) - 20);
$BanList = mysql_query("SELECT * FROM `Bans` ORDER BY `BanExpire`");
while ($row = mysql_fetch_array($BanList)) 
{
	$timefromdb   = time();
	$timeleft     = $row["BanExpire"] - $timefromdb;
	$daysleft     = round((($timeleft / 24) / 60) / 60);
	$datetoexpire = date("d/M/Y", $row["BanExpire"]);
	$banexpire = $row['BanExpire'];
	if($mylevel >= 2) $action = "<td><p align='center'><a href='#unban-id-".$row["ID"]."' data-toggle='modal' class='button' style='height:10px;'>UnBan</a></p></td>";

    if($daysleft >= 0)
    {
		if($daysleft == 0) $BanStats = "<font color='#05C81F'><i class='fa fa-unlock-alt'></i> today</font>";
		else if($daysleft == 1 || $daysleft == 2 || $daysleft == 3) $BanStats = "<font color='#81D100'><i class='fa fa-unlock-alt'></i> ".$daysleft." days</font>";
		else if($daysleft == 4 || $daysleft == 5 || $daysleft == 6) $BanStats = "<font color='#FFCC00'><i class='fa fa-unlock-alt'></i> ".$daysleft." days</font>";
		else if($daysleft == 7 || $daysleft == 8 || $daysleft == 9 || $daysleft == 10) $BanStats = "<font color='#FF9900'><i class='fa fa-unlock-alt'></i> ".$daysleft." days</font>";
	    else if($daysleft >= 10 || $daysleft <= 299) $BanStats = "<font color='#FF0000'><i class='fa fa-unlock-alt'></i> ".$daysleft." days</font>";
    }
    ?>
	<tr>
		<td><a href='/playerstats.php?player=<?=$row["Name"]?>'><?=$row["Name"]?></a></td>
		<td><a href='/playerstats.php?player=<?=$row["Admin"]?>'><font color='#00BBF6'><i class='fa fa-user'></i> <?=$row["Admin"]?></font></td>
		<td><strong>Reason:</strong> <?=$row["Reason"]?></td>
		<td><?=$row["BanDate"]?> - <?=$row["BanTime"]?></td>
		<td><?=$BanStats?></td>
		<?=$action?>
	</tr>
	
	<div id="unban-id-<?=  $row["ID"] ?>" class="modal hide" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button">&times;</button>
			<h3><font color='#00BBF6'>UnBan</font> - <?= $row["Name"] ?></h3>
		</div>

		<?php
		if($daysleft > 0 && $row["BanExpire"] != -1 && $mylevel >= 2) 
		{
			?>
			<div class="modal-body">
				<p>
				You are sure to unban <font color="#FFCC00"><?= $row["Name"] ?></font>? 
				This player is banned for <font color="red"><?= $daysleft ?></font> days.
				</p>	
				<br>
				<a class="btn btn-primary" href="?unban=<?= $row["ID"] ?>">Confirm</a>
				<a data-dismiss="modal" class="btn" href="#">Cancel</a>
			</div>
			<?php		
		} 
		else if($row["BanExpire"] == -1 && $daysleft < 1 && $mylevel >= 2) 
		{
			?>
			<div class="modal-body">
				<p>
					You are sure to unban <font color="#FFCC00"><?= $row["Name"] ?></font>?
					This player is banned for <font color="red">Permanently</font>.
				</p>	
				<br>
				<a class="btn btn-primary" href="?unban=<?= $row["ID"] ?>">Confirm</a>
				<a data-dismiss="modal" class="btn" href="#">Cancel</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="modal-body">
				<p>
					<font size="2">
					An unexpected <font color="red">error</font> occurred! Please try again later or contact the manager's team.
					</font>
				</p>	
			</div>
			<?php
		}
		?>
	</div>
	<?php
}
echo "</table>$output
</div>
</div>
</div>";

require_once("a_Footer.php");
?>