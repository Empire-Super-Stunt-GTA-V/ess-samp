<?php 
session_start();
require_once("a_Header.php");
require_once("includes/Authenticator.php");
$Authenticator = new Authenticator();

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

$action = isset($_GET['action']) ? $_GET['action'] : '';

if(!isset($action) || $action == "") CheckLoggedIn();

if(isset($_COOKIE['sessionID'])) 
{
	$Query = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
	while ($row = mysql_fetch_array($Query))
	{
		$Gems = $row['Gems'];
		$euro = $Gems/50;
	}
}
?>
<title>My Account</title>
<script>
function copyKey(x_key)
{	
	var _fake = document.createElement("input");
	
	x_key = "/shopkey " + x_key;

	document.body.appendChild(_fake);
	_fake.setAttribute("id", "fake_id");
	document.getElementById("fake_id").value = x_key;
	_fake.select();
	document.execCommand("copy");
	document.body.removeChild(_fake);
}
function copyToken(x_key)
{
	var _fake = document.createElement("input");
	
	document.body.appendChild(_fake);
	_fake.setAttribute("id", "fake_id");
	document.getElementById("fake_id").value = x_key;
	_fake.select();
	document.execCommand("copy");
	document.body.removeChild(_fake);
}
</script>
<?php
if($action == "my")
{
	if(!isset($_COOKIE['sessionID'])) Header('Location: ?action=login');
	?>
	<div class="ex">
		<h1 class="ipsType_pagetitle"><center>Hello, <font color='red'><?=$userplayer?></font>!</center></h1>
		<hr>
		<div class="orange-box2"><center><strong>Welcome to your player account. Below you can find advanced statistics and different control and customization options.</strong></center></div>
		<hr>
		<div style="border: 2px solid #3b3b3b; border-radius: 5px; padding: 10px;">
			<table border="0">
			<tbody>
			    <tr>
    				<td><center><a href="#header" id="pcp_1" style="color:#0072FF;" onclick="ShowItem(1)"><i class="fa fa-user fa-3x"></i></a></center></td>
    				<td><center><a href="#header" id="pcp_2" style="color:#0072FF;" onclick="ShowItem(2)"><i class="fa fa-dollar-sign fa-3x"></i></a></center></td>
    				<td><center><a href="#header" id="pcp_3" style="color:#0072FF;" onclick="ShowItem(3)"><i class="fa fa-shopping-cart fa-3x"></i></a></center></td>
    				<td><center><a href="#header" id="pcp_4" style="color:#0072FF;" onclick="ShowItem(4)"><i class="fa fa-gift fa-3x"></i></a></center></td>
    				<td><center><a href="#header" id="pcp_5" style="color:#0072FF;" onclick="ShowItem(5)"><i class="fa fa-unlock-alt fa-3x"></i></a></center></td>
    				<td><center><a href="#header" id="pcp_6" style="color:#0072FF;"><i class="fa fa-flag fa-3x"></i></a></center></td>
    				<td><center><a href="?action=logout" id="pcp_7" style="color:#0072FF;"><i class="fa fa-sign-out-alt fa-3x"></i></a></center></td>
				</tr>
				<tr>
    				<td><center><strong>My Statistics</strong></center></td>
    				<td><center><strong>Payment history</strong></center></td>
    				<td><center><strong>Orders history</strong></center></td>
    				<td><center><strong>My Gifts</strong></center></td>
    				<td><center><strong>Security Settings</strong></center></td>
    				<td><center><strong>Notifications</strong></center></td>
    				<td><center><strong>Sign out</strong></center></td>
				</tr>
			</tbody>
			</table>
	    </div>
    <script>
    function ShowItem($id)
    {
        for(i = 1; i < 7; i++)
    	{
    		_div_page = "Item_"  + i;
    		_div_butt = "pcp_" + i;
    		
    		if(i != $id) 
    		{
    			document.getElementById(_div_page).style.display='none';
    			document.getElementById(_div_butt).style.color='#0072FF';
    		}
    		else 			
    		{	
    			document.getElementById(_div_page).style.display='block';
    			document.getElementById(_div_butt).style.color='#AFAFAF';
    		}
    	}
    }
    </script>
	<?php
	$PropName = ""; $Name = "";
	
	$QResult = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
	$row = mysql_fetch_array($QResult);
	
	include("includes/arrays.php"); 
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
    if($row["ClanID"] == 0) $Clan = "None";
	else 
	{
		$QCName = mysql_query("SELECT `Name` FROM `Clans` WHERE `ID` = '".$row["ClanID"]."'");
		$Clan = mysql_result($QCName, 0, "Name");
	}
	//-------------------------------------------------------------------------------------------
	$pOn = $row['Status'];
	if($pOn == 1) $pOnEx = "<font color=grey><font color=green>Yes<font color=grey></font>";
	else $pOnEx = "<font color=grey><font color=red>No<font color=grey></font>";
	
	//-------------------------------------------------------------------------------------------
	$jail = $row['Jailed'];
	if($jail == 1) $jailex = "<font color=#00ff00>Yes</font>";
	else $jailex = "<font color=#00ff00>No</font>";
	
	//-------------------------------------------------------------------------------------------
	$warn = $row['Warnings'];
	if($warn == 1) $warnex = "<font color=#00ff00>Yes</font>";
	else $warnex = "<font color=#00ff00>None</font>";
	
	//-------------------------------------------------------------------------------------------
	$muted = $row['Muted'];
	if($muted == 1) $muteex = "<font color=#00ff00>Yes</font>";
	else $muteex = "<font color=#00ff00>No</font>";
	
	//-------------------------------------------------------------------------------------------
	$vip = $row['VIP'];
	if($vip == 0) $vipex = "<font color=red>No</font>";
	else if($vip == 1) $vipex = "<font color=#00FF00>Yes</font></font>";
	else if($vip == 2) $vipex = "<font color=#00FF00>Yes</font> - <font color=orange>Gold</font></font>";
	
	//-------------------------------------------------------------------------------------------
	$viptime = $row['VIPTime'];
	if($viptime == 0) $viptex = "<font color=#00FF00>Permanent</font>";
	else if($viptime == 1) $viptex = "<font color=RED>Temporary</font></font>";
	
	//-------------------------------------------------------------------------------------------
	$admin = $row['Level'];
	if($admin == 0) $adminex = "<font color=red>No</font>";
	else if($admin != 0) $adminex = "<font color=#00FF00>Yes</font> - Level: ".$row["Level"]."";
	
	//-------------------------------------------------------------------------------------------
	$spass = $row['SPassword'];
	if($spass == -1) $spassex = "<font color=red>No</font> - You can always set one online on the server by typing /spassword.";
	else if($spass != -1) $spassex = "<font color=#00FF00>Yes</font>";
	//-------------------------------------------------------------------------------------------
	$email = $row['E-Mail'];
	if($email == "None") $emailex = "<a href='/email.php'>None yet, please add one to increase your account security level!</a>";
	else if($email != "None") $emailex = "<i>".$email."</i>";
	//-------------------------------------------------------------------------------------------
	$totalmonthex = "".$row["HoursMonth"]." hours, ".$row["StuntMonth"]." stunt points, ".$row["DriftMonth"]." drift points, ".$row["RaceMonth"]." race points, ".$row["KillsMonth"]." kills points";
	//-------------------------------------------------------------------------------------------
	$pRcon = $row['RconType'];
	if($pRcon == 1) $RconString = "<font color=grey>- <font color=white>Rcon<font color=grey></font>";
	else if($pRcon == 2) $RconString = "<font color=grey>- <font color=#FF5555>Support<font color=grey> </font>";
	else if($pRcon == 3) $RconString = "<font color=grey>- <font color=red>Manager<font color=grey></font>";
	else $RconString = "";
	//-------------------------------------------------------------------------------------------
	$TwoFactAuth = $row['TwoFactAuth'];
	$TwoFactAuthSecret = $row['TwoFactAuthSecret'];
	//-------------------------------------------------------------------------------------------
	?>				
	<div id="Item_1" style="display: none;">
	<div class="main-middle">
		<div id="pcp1" style="display: block;">
		<table class="bella" style="padding-top: 10px;">
			<colgroup><col width="300">
			<col width="300">
					<tbody><tr><th><strong>Statistics</strong></th>							<th><strong>Value</strong></th></tr>
											
					<tr><td><i class="fa fa-user"></i> Name</td>							<td><font color=#00ff00><?= $row["Name"]; ?></td></font></tr>
					<tr><td><i class="fa fa-map-signs"></i> Online</td>						<td><?= $pOnEx ?></td></tr>
					<tr><td><i class="fa fa-user"></i> Admin</td>							<td><?= $adminex ?> <?= $RconString ?></td></tr>
					<tr><td><i class="fa fa-star"></i> VIP</td>								<td><?= $vipex ?></td></tr>
					<tr><td><i class="fa fa-hourglass-half"></i> VIP Valability</td>		<td><?= $viptex ?></td></tr>
					<tr><td><i class="fa fa-at"></i> E-Mail</td>                    		<td><?= $emailex ?></td></tr>
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
					<tr><td><i class="far fa-id-card"></i> Player Skin</td>					<td><?= $row["MySkin"]; ?></td></tr>
					<tr><td><i class="fa fa-calendar-check"></i> This month statistics</td> <td><?= $totalmonthex ?></td></tr>
					<tr><td><i class="fa fa-user-circle"></i> Gang</td>						<td><font color="#0077CC"><?= $Gang ?></font> | Rank: <font color="red"><?= $ranks_types_gang[$row["GangRank"]] ?></font></td></tr>
					<tr><td><i class="fa fa-user-secret"></i> Clan</td>						<td><font color="#0077CC"><?= $Clan ?></font> | Rank: <font color="red"><?= $ranks_types_clan[$row["ClanRank"]] ?></font></td></tr>
					<tr><td><i class="fa fa-unlock-alt"></i> Secondary Password</td>        <td><?= $spassex ?></td></tr>
					<tr><td><i class="fa fa-heart"></i> Registration date</td>				<td><?= $row["RegisterDate"]; ?></td></tr>
					<tr><td><i class="fa fa-calendar-check"></i> Last time online</td>		<td><?= $row["LastOn"]; ?></td></tr>
					<tr><td><i class="fa fa-star"></i> Statistics note</td>    	        	<td><?= $row["StatsNote"]; ?> / <font color="#05C81F">10</font></td></tr>
			
				</table>
				<hr>
				<div class="blue-box"><center><font color="#09C"><i class="fa fa-edit"></i></font> Below you can find signatures with your statistics to show them on the forum! <font color="#09C"><i class="fa fa-edit"></i></font></center></div>
				<hr>                  
				<div class="tab-pane" id="userbar">
					<br>        
					<center><img src="<?= $domainname ?>/includes/createsig.php?id=<?= $row['ID'] ?>&style=1"><br><br>
					<input type="text" STYLE="background-color: #252525;" size="57" class="textbox" value="[img]<?= $domainname ?>/includes/createsig?id=<?= $row['ID'] ?>&style=1[/img]">
					</center>						
				</div>
				<hr>
				<div class="blue-box"><center><font color="#09C"></font> Below you can generate account token or view the token if you have!<br>With this token, you can login in discord bot function (ESSBUSTER)</center></div>
				<hr>                  
				<div class="tab-pane" id="userbar">       
					<?php 
					
					if(isset($_POST["_generate_disc_token"])) { 
					$newtoken = md5(rand(100000000, 999999999));
					mysql_query("UPDATE `Accounts` SET `DiscordToken` = '$newtoken' WHERE `Name` = '$userplayer'"); 
					header("Location: /stunt/account.php"); }
					
					if(isset($_POST["_reset_disc_token"])) { 
					mysql_query("UPDATE `Accounts` SET `DiscordToken` = '0', `AlreadyLoggedInDiscord` = '0', `DiscordLoginAccount` = '0' WHERE `Name` = '$userplayer'"); 
					header("Location: /stunt/account.php"); }
					
					if($row['DiscordToken'] == "0") 
					{
						?>
						<form action="" method="POST">
						<input type="submit" value="Generate" name="_generate_disc_token" class="button">
						</form>
						<?php
					}
					else
					{
						?>
						<form action="" method="POST">
						Current Token:<br>
						<input type="text" STYLE="background-color: #252525;" size="57" class="textbox" value="<?=$row['DiscordToken']?>"><br>
						<input type="submit" value="Reset" name="_reset_disc_token" class="button">
						<td><a class="button" style="cursor:pointer;" onclick="copyToken('<?=$row['DiscordToken']?>')">Copy token</a></td>
						</form>
						<?php 
					} 
					?>
				</div>
	</div>
	</div>
	</div>
	
	<div id="Item_2" style="display: none;">
		  <table class="bella" style="padding-top: 10px;">
			<tbody>
				<tr>
					<th><strong>#</strong></th>
					<th><strong>Made by</strong></th>
					<th><strong>For</strong></th>
					<th><strong>Amount</strong></th>
					<th><strong>Payment method</strong></th>
					<th><strong>Reference</strong></th>
					<th><strong>Status</strong></th>
				</tr>
				<?php
				$Query = mysql_query("SELECT * FROM `Donation` WHERE `By` = '$userplayer' ORDER BY `ID` DESC");
				//------------------------------------------------------------------------
				if(mysql_num_rows($Query) != 0)
				{	
					while($row = mysql_fetch_array($Query))
					{
						$id = $row['ID'];
						$by = $row['By'];
						$for = $row['For'];
						$amount = $row['Amount'];
						$method = $row['Method'];
						$reference = $row['Reference'];
						$status = $row['Status'];
						$verefiedby = $row['VerifiedBy'];
						$lastdonation = $row['Date'];
					    if(empty($lastdonation)) $lastdonation = "Never";
						//--------------------------------------------------------------------
						$Query2 = mysql_query("SELECT * FROM `Accounts` WHERE `ID` = '$verefiedby'");
						while($row2 = mysql_fetch_array($Query2))
						{
							$verifiedbyname = $row2['Name'];
						}
						//--------------------------------------------------------------------
						if($method == 1) $methodstring = "<font color='#0072FF'><i class='fab fa-amazon-pay'></i></font> Paysafecard";
						//--------------------------------------------------------------------
						if($status == 1) $statusstring = "<font color='orange'><i class='fa fa-hourglass-half'></i></font> Pending";
						if($status == 2) $statusstring = "<font color='green'><i class='fas fa-check-circle'></i></font> Accepted by $verifiedbyname";
						if($status == 3) $statusstring = "<font color='red'><i class='fa fa-times-circle'></i></font> Rejected by $verifiedbyname";
						//--------------------------------------------------------------------
						?>
						<tr>
							<td><font color="#FFCC00"><?=$id?></font></td>
							<td><?=$by?></td>
							<td><?=$for?></td>
							<td><?=$amount?> €</td>
							<td><?=$methodstring?></td>
							<td><?=$reference?></td>
							<td><?=$statusstring?></td>
						<?php
					}
				}
				else if(mysql_num_rows($logs) == 0)
				{
					?>
					<tr>
						<td>No existing payments.</td>
						<td></td>
						<td></td>
					</tr>
					<?php
				}
				?>
				</tr>
			</tbody>
		</table>
		<hr>
		<div class="blue-box-info">
	    <p align="left">
		You currently have <font color="red"><?=$Gems?></font> gems with an estimated value of <font color="red"><?=$euro?> €</font>. You had in total so far, <font color="red">#</font> gems with an estimated value of <font color="red"><i class="fa fa-eur"></i> # €</font>.<br>
		Last donation was made on <font color="red"><?=$lastdonation?></font> and was in a value of <font color="red"> <?=$amount?> €</font>. You can always add more gems by following <a href="/addgems.php">this link</a>.
		</p>
		</div>
		<hr>
	</div>
	  
	<div id="Item_3" style="display: none;">
		<hr>
			<div class="blue-box">
			<center><font color="#05C81F"><i class="fa fa-shopping-cart"></i></font> <strong>Active orders</strong> - Below you will find the list of unused shop keys or orders that are still in pending</center>
			</div>
			<hr>
				<table class="bella" style="padding-top: 10px;">
				<tbody>
					<tr>
						<th><strong>Item</strong></th>
						<th><strong>Cost</strong></th>
						<th><strong>Reference Key</strong></th>
					</tr>
					<?php
					$logs = mysql_query("SELECT * FROM `LogKeys` WHERE `Name` = '$userplayer' AND `Gift` = '0' AND `Status` = '1' ORDER BY `ID` DESC");
					//------------------------------------------------------------------------
					if(mysql_num_rows($logs) != 0)
					{
						while($row = mysql_fetch_array($logs))
						{
							$item = $row['Type'];
							$cost = $row['Price'];
							$key = $row['Key'];
							//---------------------------------------------
							?>
							<tr>
								<td><?=$item?></td>
								<td><?=$cost?> Gems</td>
								<td><?=$key?></td>
							</tr>
							<?php
						}
						
					}
					else if(mysql_num_rows($logs) == 0)
					{
						?>
						<tr>
							<td>No existing orders.</td>
							<td></td>
							<td></td>
						</tr>
						<?php
					}
					?>
				</tbody>
				</table>
			<hr>
			<div class="blue-box">
			<center><font color="#FFCC00"><i class="fa fa-shopping-cart"></i></font> <strong>Confirmed orders</strong> - Below you will find the list of confirmed shop keys or orders</center>
			</div>
			<hr>
				<table class="bella" style="padding-top: 10px;">
				<tbody>
					<tr>
						<th><strong>Item</strong></th>
						<th><strong>Cost</strong></th>
						<th><strong>Reference Key</strong></th>
					</tr>
					<?php
					$logs = mysql_query("SELECT * FROM `LogKeys` WHERE `Name` = '$userplayer' AND `Gift` = '0' AND `Status` = '2' ORDER BY `ID` DESC");
					//------------------------------------------------------------------------
					if(mysql_num_rows($logs) != 0)
					{
						while($row = mysql_fetch_array($logs))
						{
							$item = $row['Type'];
							$cost = $row['Price'];
							$key = $row['Key'];
							//---------------------------------------------
							?>
							<tr>
								<td><?=$item?></td>
								<td><?=$cost?> Gems</td>
								<td><?=$key?></td>
							</tr>
							<?php
						}
					}
					else if(mysql_num_rows($logs) == 0)
					{
						?>
						<tr>
							<td>No existing orders.</td>
							<td></td>
							<td></td>
						</tr>
						<?php
					}
					?>
				</tbody>
				</table>
			<hr>
			<div class="blue-box">
			<center><font color="#FF0000"><i class="fa fa-shopping-cart"></i></font> <strong>Unconfirmed orders</strong> - Below you will find the list of unconfirmed shop keys or orders. For more details get in contact with our support team.</center>
			</div>
			<hr>
				<table class="bella" style="padding-top: 10px;">
				<tbody>
					<tr>
						<th><strong>Item</strong></th>
						<th><strong>Cost</strong></th>
						<th><strong>Reference Key</strong></th>
					</tr>
					<tr>
						<td>No existing orders.</td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				</table>
			<hr>
			
			<div class="blue-box-info">
		    <p align="left">
			You currently have <font color="red"><?=$Gems?></font> gems in a estimated value of <font color="red"><?=$euro?> €</font>. You can always add more gems by following <a href="/addgems.php">this link</a>.<br>
			You have <font color="red">#</font> orders in pending out of a total of <font color="red">#</font>. To purchase more items, follow <a href="/shop.php">this link</a>.<br>
			<br>
			To activate purchased items on the server, please type <strong>/shopkey</strong> followed by the reference key of the item you wish to activate!<br>
			Orders with <font color="red">*</font> cannot be activated on the server. You need to get in contact with our Support / Management team for their activation.
			</p>
		   </div>
	<hr>
	</div>
	
	<div id="Item_5" style="display: none;">
	    <?php
	    if(!empty($_POST['_apass']) && !empty($_POST['_cpass']) &&  !empty($_POST['_npass']))
	    {
	        $radioVal = $_POST["_pwtype"];
        	if($radioVal == "1" || $radioVal == "2") 
        	{
        	    $_SESSION['passwordtype'] = $radioVal;
    	        $_SESSION['currentpassword'] = md5($_POST['_apass']);
        	    $_SESSION['password1'] = md5($_POST['_cpass']);
        	    $_SESSION['password2'] = md5($_POST['_npass']);
        	    header("Location: ?action=password");
        	}
	    }
	    else if(isset($_POST['_clicked'])) header("Location: ?action=password");
	    ?>
		<hr>
			<div class="blue-box"><center><font color="#0072FF"><i class="fa fa-key"></i></font><strong> Update passwords</strong> - You can control your account main password or secondary password from this form. After you change your password, you will recieve a notification on your email!</center></div>
		<hr>
		<form action="" method="POST">
			<center>
				<input type="radio" STYLE="background-color: #252525;" name="_pwtype" value="1" checked=""> Main password <input type="radio" name="_pwtype" value="2"> Secondary password<br><br>
				<strong><font color="white"><i class="fa fa-unlock-alt"></i></font> Old password</strong><br>
				<input type="password" STYLE="background-color: #252525;" value="" name="_apass" class="form_field"><br><br>
				<strong><font color="white"><i class="fa fa-unlock-alt"></i></font> New password</strong><br>
				<input type="password" STYLE="background-color: #252525;" value="" name="_cpass" class="form_field"><br><br>
				<strong><font color="white"><i class="fa fa-unlock-alt"></i></font> Re-type new password</strong><br>
				<input type="password" STYLE="background-color: #252525;" value="" name="_npass" class="form_field"><br><br>
				<input type="submit" value="Update password" name="_clicked" class="button"> <a href="/recover.php" class="button">Update through email</a>
			</center>
		</form>
		<hr>
		<div class="blue-box">
		    <center><font color="#FF9900"><i class="fa fa-key"></i></font><strong> Update email</strong> - You can control your account email address by sending a reset key to your current one with the reset instructions!</center>
	    </div>
	    <hr>
	    <center>
			<font color="#FF9900"><i class="fa fa-at fa-4x"></i></font><br>
			<strong>
			You will receive a unique reset link on your current email address which expires in one hour after you send it.<br>
			You will need to follow the reset link that you received on your current email address, reconfirm your current email address, account passwords and security token in order to be able to reset it.<br><br>
			</strong>
		</center>
		<center><a href="#header" class="button" onclick="generateEmailKey(); SendEmail();">Generate email reset key</a></center>
		
		<div id="dialog_back" style="display: none; z-index: 100000; position: fixed; top: 0%; left: 0%; right: 100%; width: 100%; height: 100%; background: url(&quot;/images/black-box.png&quot;);"></div>

	    <div id="dialog_boxm" style="display: none; z-index: 100001; position: fixed; top: 48%; left: 35%; width: 400px; height: 55px; background: url(/images/green-box.png); border-radius: 10px;">
		<strong><div style="float:left; width:60px;"><i class="far fa-check-circle fa-4x" style="padding-top: 5px; padding-left: 5px;"></i></div><div style="float:right; width:340px;"><p align="left">The email reset key has been successfully generated.<br>You will recieve it soon on <?=$email?>!<br><br><a href="#header" onclick="hideDialog();">Close.</p></a></div></strong>
	    </div>
		
		<hr>
		<div class="blue-box">
		    <center><font color="#0072FF"><i class="fa fa-key"></i></font><strong> Manage Two-Factor-Authentication</strong> - You can enable/disable Two-Factor-Authentication</center>
	    </div>
	    <hr>
		<?php 
		if(isset($_POST["_generate_qr_code"])) { 
		$secret = $Authenticator->generateRandomSecret();
		mysql_query("UPDATE `Accounts` SET `TwoFactAuth` = '1', `TwoFactAuthSecret` = '$secret' WHERE `Name` = '$userplayer'"); 
		header("Location: /stunt/account.php"); }
		
		if(isset($_POST["_disable_qr_code"])) {
		mysql_query("UPDATE `Accounts` SET `TwoFactAuth` = '0', `TwoFactAuthSecret` = '' WHERE `Name` = '$userplayer'"); 
		header("Location: /stunt/account.php"); }
		if($TwoFactAuth == 0) 
		{ 
			?> 
			<center>
				<font color="#FF0000"><i class="fas fa-qrcode fa-4x"></i></font><br>
				<strong>If you will click to 'Generate QR Code', you will create an 'Two Factor Authentication' for your account!<br><br></strong>
				<form action="" method="POST">
					<input type="submit" value="Generate QR Code" name="_generate_qr_code" class="button">
				</form>
			</center>
			<?php 
		} 
		else if($TwoFactAuth == 1) 
		{
			$qrCodeUrl = $Authenticator->getQR("ESS-RO.COM (Account ID: $userid)", $TwoFactAuthSecret);
			?>
			<center><strong>You need to scan this QR code with <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en">THIS</a> Application (On Mobile)</strong></center><br>
			<img style="text-align: center;;" class="img-fluid" src="<?php   echo $qrCodeUrl ?>" width="100" alt="Verify this Google Authenticator"><br><br>
			<form action="" method="POST">
				<input type="submit" value="Disable Two Factor Authentication" name="_disable_qr_code" class="button">
			</form>
			<?php
		}
		?>
	   
		<script>
		function generateEmailKey()
		{
            document.getElementById("dialog_back").style.display='block'; 
			document.getElementById("dialog_boxm").style.display='block'; 
		}
		function hideDialog()
		{
			document.getElementById("dialog_back").style.display='none'; 
			document.getElementById("dialog_boxm").style.display='none';
		}
		</script>
		
		<?php
		function SendEmail()
		{
		    $to = $email;
		    $headers = "no-reply@ess-ro.com";
		
		    $subject = "Empire Super Stunt - Email reset key";
		    $message = "Hello, ".$userplayer."\nBelow you will find your reset link that you will need to follow to change the linked email address of your player account!\n\nSecurity token: $token\n\n\n<a href ='http://www.ess-ro.com/requestemail?&key=$randomkey'>this link.\n\nIf you have not requested this, please consider changing your account passwords immediatly as your account may be compromised! Remember not to provide anyone with these sensitive details as you may risk losing your account!\n\nFor more informations and any questions, please visit www.ESS-RO.com!";
		    
		    mail($to, $subject, $message, $headers); 
		}
		?>
	</div>
	
	<div id="Item_4" style="display: none;">
		<div class="main-middle">
		<hr>
		<?php
		$QResult = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
		$row = mysql_fetch_array($QResult);
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		$GetGifts = $row['Gifts'];
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		?>
		<div class="blue-box-info">
			You currently have <font color="red"><strong><?= $GetGifts ?></strong></font> unopened gifts. To open them, just press on the <strong>Open gift!</strong> button above!<br>
			These gifts are our reward for active players, once at a couple of hours, the server will automatically give you a gift if you have more than one hour online!<br>
			You can also give someone else your gift before opening it, by typing <strong>/Give Gift</strong> on the server. The sent gift will be the one that you lastly recieved!
		</div>
		<hr>
		<br>
		<center><img src="/images/gifts/gift-all.png"></center>
		<?php
		if($GetGifts >= 1)
		{
			?>
			<br>
			<a href="?action=opengift" class="buy-item">Open gift</a>
			<br>
			<?php
		}
		?>
		<br>
		<hr>
		<div class="blue-box"><center><font color="#05C81F"><i class="fa fa-gift"></i></font> <strong>Unused gifts</strong> - You can use them on the server, by typing /shopkey followed by the key reference.</center></div>
		<hr>
 
		<table class="bella" style="padding-top: 10px;">
		<colgroup>
			<col width="300">
			<col width="300">
			<col width="300">
		</colgroup>
		<tbody>
		<tr>
			<th><strong>Item</strong></th>
			<th><strong>Key Reference</strong></th>
			<th><strong>Action</strong></th>
		</tr>
		
		<?php 
		$logs = mysql_query("SELECT * FROM `LogKeys` WHERE `Name` = '$userplayer' AND `Gift` = '1' AND `Status` = '1' ORDER BY `ID` DESC");
		//------------------------------------------------------------------
		if(mysql_num_rows($logs) != 0)
		{
			while($row = mysql_fetch_array($logs))
			{
				$amount = $row['Amount']; 
				$item = $row['Type']; 
				$key = $row['Key'];
				?>
					<tr>
						<td><?=$amount?> <?=$item?></td> 
						<td><font color=#FFCC00><?=$key?></font></td>
						<td><a class="button" style="cursor:pointer;" onclick="copyKey('<?=$key?>')">Copy key</a></td>
					</tr>
				<?php
			}
		}
		else if(mysql_num_rows($logs) == 0)
		{
			?>
			<tr>
				<td>No existing gifts.</td>
				<td></td>
				<td></td>
			</tr>
			<?php
		}
		?>
		</table>
		
		<br>
		<hr>
		<div class="blue-box"><center><font color="#FFCC00"><i class="fa fa-gift"></i></font> <strong>Used gifts</strong> - These are keys from gifts that you have already used on the server. They are kept in your account history for any future reference.</center></div>
		<hr>
 
		<table class="bella" style="padding-top: 10px;">
		<tbody>
		<tr>
			<th><strong>Item</strong></th>
			<th><strong>Key Reference</strong></th>
		</tr>
		
		<?php 
		$logs = mysql_query("SELECT * FROM `LogKeys` WHERE `Name` = '$userplayer' AND `Gift` = '1' AND `Status` = '2' ORDER BY `ID` DESC");
		//------------------------------------------------------------------
		if(mysql_num_rows($logs) != 0)
		{
			while($row = mysql_fetch_array($logs))
			{
				$amount = $row['Amount']; 
				$item = $row['Type']; 
				$key = $row['Key'];
				?>
					<tr>
						<td><?=$amount?> <?=$item?></td> 
						<td><font color=#FFCC00><?=$key?></font></td>
					</tr>
				<?php
			}
		}
		else if(mysql_num_rows($logs) == 0)
		{
			?>
			<tr>
				<td>No existing gifts.</td>
				<td></td>
			</tr>
			<?php
		}
		?>
		
		</table>
		</div>
	</div>
	<?php
} 
else if($action == "password")
{
    if(!isset($_COOKIE['sessionID'])) Header('Location: ?action=login');
    ?>
    <div class="ex">
        <h1 class="ipsType_pagetitle"><center>Parola contului!</center></h1>
        <?php
        if(!empty($_POST['_apass']) && !empty($_POST['_cpass']) &&  !empty($_POST['_npass']))
	    {
	        $radioVal = $_POST["_pwtype"];
        	if($radioVal == "1" || $radioVal == "2") 
        	{
        	    $_SESSION['passwordtype'] = $radioVal;
    	        $_SESSION['currentpassword'] = md5($_POST['_apass']);
        	    $_SESSION['password1'] = md5($_POST['_cpass']);
        	    $_SESSION['password2'] = md5($_POST['_npass']);
        	}
	    }
        $currentpassword = $_SESSION['currentpassword'];
        $password1 = $_SESSION['password1'];
	    $password2 = $_SESSION['password2'];
        if($_SESSION['passwordtype'] == 1)
        {
            if($password1 == $password2)
            {
                $Query	= mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer' AND `Password` = '$currentpassword'");
        		$Rows   = mysql_num_rows($Query);
        		if($Rows == 0)
        		{
        		    ?>
        		    <hr>
        		    <div class="error-box">
        		        <p align="left">
        		        A aparut o eroare neasteptata!<br>
        		        Reia din nou procesul de schimbare a parolei cu mai multa atentie!
        		        </p>
    		        </div>
        		    <hr>
        		    <?php
        		}
        		else if($Rows != 0)
        		{
        		    mysql_query("UPDATE `Accounts` SET `Password` = '$password1'  WHERE `Name` = '$userplayer'");
        		    ?>
        		    <hr>
        		    <div class="green-box">
        		        <p align="left">
        		        Succes!<br>
        		        Parola contului tau a fost actualizata cu succes!<br>Pentru siguranta contului tau, a fost trimisa o notificare catre adresa de email inregistrata in cont!
        		        </p>
    		        </div>
        		    <hr>
        		    <?php
        		}
            }
            else
            {
                ?>
    		    <hr>
    		    <div class="error-box">
    		        <p align="left">
    		        A aparut o eroare neasteptata!<br>
    		        Reia din nou procesul de schimbare a parolei cu mai multa atentie!
    		        </p>
		        </div>
    		    <hr>
    		    <?php
            }
        }
        else if($_SESSION['passwordtype'] == 2)
        {
            if($password1 == $password2)
            {
                $Query	= mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer' AND `SPassword` = '$currentpassword'");
        		$Rows   = mysql_num_rows($Query);
        		if($Rows == 0)
        		{
        		    ?>
        		    <hr>
        		    <div class="error-box">
        		        <p align="left">
        		        A aparut o eroare neasteptata!<br>
        		        Reia din nou procesul de schimbare a parolei cu mai multa atentie!
        		        </p>
    		        </div>
        		    <hr>
        		    <?php
        		}
        		else if($Rows != 0)
        		{
        		    mysql_query("UPDATE `Accounts` SET `SPassword` = '$password1'  WHERE `Name` = '$userplayer'");
        		     ?>
        		    <hr>
        		    <div class="green-box">
        		        <p align="left">
        		        Succes!<br>
        		        Parola contului tau a fost actualizata cu succes!<br>Pentru siguranta contului tau, a fost trimisa o notificare catre adresa de email inregistrata in cont!
        		        </p>
    		        </div>
        		    <hr>
        		    <?php
        		}
            }
            else
            {
                ?>
    		    <hr>
    		    <div class="error-box">
    		        <p align="left">
    		        A aparut o eroare neasteptata!<br>
    		        Reia din nou procesul de schimbare a parolei cu mai multa atentie!<br>
					Daca nu ai inca o parola secundara in cont, te rugam sa adaugi una pe server, folosind comanda /spassword!
    		        </p>
		        </div>
    		    <hr>
    		    <?php
            }
        }
        else
        {
            ?>
            <hr>
            <div class="blue-box"><center>Pe aceasta pagina vei putea modifica parola contului tau de pe server!</center></div>
            <hr>
            <form action="" method="POST"><center>
    		  <input type="radio" name="_pwtype" value="1" checked=""> Parola principala <input type="radio" name="_pwtype" value="2"> Parola secundara<br>
    		  <strong>Parola actuala</strong><br>
    		  <input type="password" STYLE="background-color: #252525;" value="" name="_apass" class="form_field"><br><br>
    		  <strong>Parola noua</strong><br>
    		  <input type="password" STYLE="background-color: #252525;" value="" name="_cpass" class="form_field"><br><br>
    		  <strong>Rescrie parola noua</strong><br>
    		  <input type="password" STYLE="background-color: #252525;" value="" name="_npass" class="form_field"><br><br>
    		  <input type="submit" value="Modifica parola" name="_clicked" class="button"> <a href="/recover.php" class="button">Reseteaza prin email</a>
		    </center></form>
		    <?php
        }
        $_SESSION['currentpassword'] = 0;
        $_SESSION['password1'] = 0;
	    $_SESSION['password2'] = 0;
        $_SESSION['passwordtype'] = 0;
        ?>
        </div>
        <?php
}
else if($action == "logoutex")
{
	$sessid = $_COOKIE['sessionID']; $page = "";
	mysql_query("DELETE FROM `Sessions` WHERE SessID='$sessid'");
	unset($_COOKIE['sessionID']);
	setcookie('sessionID', '', time() - 3600);
	$_SESSION['ServerNameLogged'] = "";
	$_SESSION['RconType'] = 0;
	header('Location: index');
}
else if($action == "logout")
{
	$sessid = $_COOKIE['sessionID']; $page = "";
	mysql_query("DELETE FROM `Sessions` WHERE SessID='$sessid'");
	unset($_COOKIE['sessionID']);
	setcookie('sessionID', '', time() - 3600);
	$_SESSION['ServerNameLogged'] = "";
	$_SESSION['logout'] = 1;
	$_SESSION['RconType'] = 0;
	header('Location: ?action=login');
}
else if($action == "login") 
{
	?>
	<div class="block">
	<div class="main-middle">
	<div class="ex">  
	<h1 class="ipsType_pagetitle"><center><i class="fa fa-key"></i> Login to your player account!</center></h1>
	<?php
	if($_SESSION['logout'] == 1)
	{	
		?>
		<div id="_info">
			<hr>
			<div class="s-box">
				<center>You have been succesfully signed out of your player account!</center>
			 </div>
			<hr>
		</div>
		<?php
		$_SESSION['logout'] = 0;
	}
	else
	{
		?>
		<div id="_info">
			<hr>
			<div class="orange-box2">
				<center>You are not connected yet to your player account on our server!</center>
			</div>
			<hr>
		</div>
		<?php
	}
	
	$lUser = ""; $lPass = ""; $lPass2 = "Null";

	if(isset($_POST['seets2'])) 
	{
		$lUser 				= mysql_real_escape_string(stripslashes($_POST['Nickname2']));
		$lPass 				= mysql_real_escape_string(stripslashes(md5($_POST['Password2'])));
		$lPass2             = $_POST['Spassword'];
		
		if($lPass2 == "") $lPass2 = "Null";
		else $lPass2 = mysql_real_escape_string(stripslashes(md5($_POST['Spassword'])));
		
		$Query				= mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$lUser' AND `Password` = '$lPass' AND `SPassword` = '$lPass2'");
		$Rows				= mysql_num_rows($Query);
		
		if($Rows == 0) 
		{
			?>
			<script>
				document.getElementById('_info').style.display = 'none';
			</script>
			<hr>
			<div class="error-box">
				<p align="left">Eroare!<br>Contul specificat nu exista sau parola introdusa este gresita!</p>
			</div>
			<hr>
			<?php
		}
		else if($Rows != 0)
		{
			$row = mysql_fetch_array($Query);
			if(isset($_POST['rememberme2'])) 
			{
				$sesidx=uniqid(rand());
				$sesid=substr($sesidx, 0, 44);
				mysql_query("INSERT INTO `Sessions` VALUES (0, '$sesid', '".$row['ID']."')");					
				setcookie('sessionID', $sesid, 0, '/', 'ess-ro.com');
			} 
			else 
			{
				$sesidx=uniqid(rand());
				$sesid=substr($sesidx, 0, 44);
				mysql_query("INSERT INTO `Sessions` VALUES (0, '$sesid', '".$row['ID']."')");					
				setcookie('sessionID', $sesid, time()+60*60*24*365, '/', 'ess-ro.com');
			}
			Header("Location: ?action=my");
			$ipadress = $_SERVER['REMOTE_ADDR'];
			mysql_query("INSERT INTO `DiscordDmAlerts` VALUES (0, '".$row['ID']."', 'New login have been registred in our panel! | IP: $ipadress')");
		}
		if(isset($_COOKIE['sessionID'])) Header('Location: ?action=my');
	}
	?>
	<center>
		<div style="height: 70px; background: url(images/mtab-box.png); border: 2px solid #3b3b3b; border-radius: 5px; padding: 10px;">
		<table border="0">
		<tbody><tr>
		<td><img src="/images/ro-flag2.png" width="40"></td>
		<td>
		Autentifică-te cu contul tău de pe server pentru a avea acces la mai multe opțiuni de control și personalizare a profilului tău de jucător.<br>
		Vei avea acces la statistici avansate, istoricul donațiilor, comenzilor, și cadourilor tale, notificări și opțiuni de control a setărilor de securitate, astfel încât contul tău să rămână mereu în siguranță. 
		</td>
		</tr>
		<tr>
		<td><img src="/images/uk-flag2.png" width="40"></td>
		<td>Sign in with your player account on our server to have access to more control and customization options for your player profile.<br>
		You will have access to advanced statistics, your donations, orders and gifts history, notifications and security control options so that your account will always stay safe.
		</td>
		</tr>
		</tbody></table>
		</div>
			<form action="" method="POST">
				<center>
				<br>
				<strong><font color="white"><i class="fa fa-user"></i></font> Player name</strong><br>
				<input type="text" STYLE="background-color: #252525;" value="" name="Nickname2" class="form_field" style="margin-top: 3px;"><br><br>
				<strong><font color="white"><i class="fa fa-unlock-alt"></i></font> Main account password</strong><br>
				<input type="password" STYLE="background-color: #252525;" value="" name="Password2" class="form_field" style="margin-top: 3px;"><br><br>
				<strong><font color="white"><i class="fa fa-key"></i></font> Secondary password <a href="#header" title="Optional field, only if you have a secondary password added to your account (/SPASSWORD)!"><font color="#FFCC00"><i class="fa fa-info-circle"></i></font></a></strong><br>
				<input type="password" STYLE="background-color: #252525;" value="" name="Spassword" class="form_field" style="margin-top: 3px;"><br><br>
				<input type="checkbox" name="rememberme2" value="070718" class="button" style="margin-bottom: 5px; margin-top: -10px;"> <div style="display:inline;"><strong>Keep me always signed in</strong></div><br>
				<input type="submit" value="Sign In" name="seets2" class="button">
				<a href="/recover.php" class="button">Forgot password</a>
				
		</center></form>
	<?php
}
else if($action == "opengift")
{
    if(!isset($_COOKIE['sessionID'])) Header("Location: ?action=login");
	else
	{
	    $QResult = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");
		$row = mysql_fetch_array($QResult);
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		$count = $row['Gifts'];
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		if($count == 0) header("Location: /stunt/account.php");
		else if($count != 0)
		{
    		$remaing = $row['Gifts']-1;
    		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		mysql_query("UPDATE `Accounts` SET `Gifts` = $remaing WHERE `Name` = '$userplayer'");
    		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		$RewardAmount = 0;
    		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		$ItemID = 0;
    		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		$RewardText = "";
    		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		$szRandomKey = rand(1000000000, 9999999999);
    		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		$szRandom = rand(0,8);
    		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		switch($szRandom)
    		{
    		    case 0:
    		    {
    		        $RewardText = "Nimic"; $RewardAmount = 0; $ItemID = 0;
    		        break;
    		    }
    		    case 1:
    		    {
    		        $RewardText = "Stunt Points"; $RewardAmount = rand(1, 20); $ItemID = 8;
    		        break;
    		    }
    		    case 2:
    		    {
    		        $RewardText = "Race Points"; $RewardAmount = rand(1, 20); $ItemID = 9;
    		        break;
    		    }
    		    case 3:
    		    {
    		        $RewardText = "Drift Points"; $RewardAmount = rand(1, 20); $ItemID = 7;
    		        break;
    		    }
    		    case 4:
    		    {
    		        $RewardText = "Coins"; $RewardAmount = rand(1, 30); $ItemID = 4;
    		        break;
    		    }
    		    case 5:
    		    {
    		        $RewardText = "Hours"; $RewardAmount = rand(1, 3); $ItemID = 10;
    		        break;
    		    }
    		    case 6:
    		    {
    		        $RewardText = "Gems"; $RewardAmount = rand(1, 2); $ItemID = 5;
    		        break;
    		    }
    		    case 7:
    		    {
    		        $RewardText = "Money"; $RewardAmount = rand(1, 50000); $ItemID = 3;
    		        break;
    		    }
    		    case 8:
    		    {
    		        $RewardText = "Kills"; $RewardAmount = rand(1, 20); $ItemID = 6;
    		        break;
    		    }
    		}
    		if($ItemID != 0)
    		{
        		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        		mysql_query("INSERT INTO `LogKeys` (`ID`, `Name`, `Status`, `Key`, `Type`, `Amount`, `Date`) VALUES (0, '$userplayer', '1', '$szRandomKey', '$RewardText', '$RewardAmount', '0')");
        		mysql_query("INSERT INTO `ShopKeys` (`ID`, `Key`, `Item`, `Amount`) VALUES (0, '$szRandomKey', '$ItemID', '$RewardAmount')");
        		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    		}
    		echo'
    	         <center>
                 <div class="main-middle">
                 <div class="ex">
                    <br>
                    <center><img src="/images/gifts/gift-'.$ItemID.'.png"></center>
                    <br>
                    <h1 class="ipsType_pagetitle">+'.$RewardAmount.' '.$RewardText.'</h1>
                    <br>
                    <a href="?action=my" class="buy-item">View all gifts!</a>
				 </div>
				 </div>
                 </center>';
		}
	}
}
else if($action == "banned")
{
    if(isset($_COOKIE['sessionID']))
    {
        $bandetails = mysql_query("SELECT * FROM `Bans` WHERE `Name` = '$userplayer'");
    	while($row = mysql_fetch_array($bandetails))
    	{
    	    $timefromdb = time();
			$timeleft   = $row['BanExpire'] - $timefromdb;
			$daysleft   = round((($timeleft / 24) / 60) / 60);
			//------------------------------------------------------------------
			if($row['BanExpire'] == -1 && $daysleft < 1) $banstatus = "Status: <font color='red'>Permanent ban.</font>"; else $banstatus = "Status: $daysleft Day(s) left.";
    	
        echo'<center>
        <div class="main-middle">
        <div class="ex">
        <h1 class="ipsType_pagetitle"><center>Banned!</center></h1>
        <hr>
        
        <div class="panel-box">
        Sorry <font color="orange">'.$row["Name"].'</font> but you have a ban!<br><br>
        Your account has been banned by Admininstrator <font color="0072FF">'.$row["Admin"].'</font>!<br>
        '.$banstatus.'<br>
        Reason: <font color="orange">'.$row["Reason"].'</font><br>
        <br>
        You received a ban on the server and website on the date of <font color="orange">'.$row["BanDate"].'</font> at <font color="orange">'.$row["BanTime"].'</font>!<br><br>
        If you only have a ban on the server and you do not have a forum.<br>You can send a private message to a manager with the server!<br>
        Or contact an owner of the server!<br><br>
        Visit the forum at <font color="red">www.ess-ro.com/forums</font>!<br>
        </div>
        <hr>
        </center>';
        
    	}
    }
}
require_once("a_Footer.php");
?>