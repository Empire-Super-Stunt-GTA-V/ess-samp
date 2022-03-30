<?php
require_once("a_Header.php");
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : '';
$kick = isset($_GET['kick']) ? $_GET['kick'] : '';
$player = isset($_GET['player']) ? $_GET['player'] : '';
?>
<div class="ex">
<div class="panel-heading widget-heading widget-draggable" ng-dblclick="toggleGroup(files)">
<?php
if(!isset($_COOKIE['sessionID'])) return print("<div class='error-box' align='left'>A aparut o eroare neasteptata! Te rugam, asigura-te ca esti logat pe cont-ul de pe server!<br><a href='/account.php'>Click aici</a> pentru redirect!</div>");
if($rcontype >= 2)
{
	if($page == "" && $player == "" && $kick == "")
	{
		DisplayHeader($userplayer, "Server Control Panel");
		?>
		<title>Server Control Panel - Home</title>
		<hr>
		<div class="blue-box">Here are the Server Control Panel. Here you can control Server Stuffs.</div>
		<hr>
		<center><table>
		<tbody><tr><td>
		<?php
		if($rcontype >= 2)
		{
			?>
			<a class="animated-button-header newbutton-header" href="?page=kickplayer" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fa fa-ban fa-8x" style="color:#0072FF;"></i><br><span style="color:white">Kick online player</span></a>&nbsp
			<a class="animated-button-header newbutton-header" href="?page=editplayer" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fas fa-user-edit fa-8x" style="color:#0072FF;"></i><br><span style="color:white">Edit player stats</span></a>&nbsp
			<a class="animated-button-header newbutton-header" href="?page=rconlogs" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fas fa-low-vision fa-8x" style="color:#0072FF;"></i><br><span style="color:white">RCON logs</span></a>&nbsp
			<a class="animated-button-header newbutton-header" href="?page=blockedaccounts" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fas fa-lock fa-8x" style="color:#0072FF;"></i><br><span style="color:white">Blocked accounts</span></a>&nbsp
			<a class="animated-button-header newbutton-header" href="?page=discordoptions" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fab fa-discord fa-8x" style="color:#0072FF;"></i><br><span style="color:white">Discord options</span></a>&nbsp
			<br><br>
			<a class="animated-button-header newbutton-header" href="?page=logspanel" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fas fa-clipboard-list fa-8x" style="color:#0072FF;"></i><br><span style="color:white">Panel logs</span></a>&nbsp
			<?php
		}
		if($rcontype == 3)
		{
			?>
			<a class="animated-button-header newbutton-header" href="?page=iptools" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fas fa-tools fa-8x" style="color:#0072FF;"></i><br><span style="color:white">IP tools</span></a>&nbsp
			<a class="animated-button-header newbutton-header" href="?page=donations" style="text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);border-color: #000;max-width:158px;max-height:120px;min-width:158px;"><i class="fas fa-hand-holding-usd fa-8x" style="color:#0072FF;"></i><br><span style="color:white">Verify donations</span></a>&nbsp
			<?php
		}
		?>
		<br><br>
		</td></tr>
		</tbody></table></center>
		<?php
	}
	else if($page == "acp")
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		//$id = isset($_GET['id']) ? $_GET['id'] : '';
		$Query = mysql_query("SELECT * FROM `Accounts` WHERE `ID` = '$id' AND `Level` >= 1"); 
		if(mysql_num_rows($Query) != 0)
		{
			?> <title>ServerCP - Manage Admin</title>  <?php
			DisplayHeader($userplayer, "Server Control Panel - Manage Admin");
			while($row = mysql_fetch_array($Query)) 
			{
				?>
				<hr>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title" align="left" style="margin-left: 5px;"><i class="fas fa-user"></i> Client Information</h3>
					</div>
					<div class="panel-body">
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-4 control-label" style="padding-top:0px">Name:</label>
								<div class="col-sm-8">
									<p class="form-control-static" style="padding-top:0px"><?=$row['Name']?></p>
								</div>
							</div>
							<hr>
							<?php if($rcontype == 3) { ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" style="padding-top:0px">Email:</label>
								<div class="col-sm-8">
									<p class="form-control-static" style="padding-top:0px"><?=$row['E-Mail']?></p>
								</div>
							</div>
							<hr> <?php } ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" style="padding-top:0px">Last Login:</label>
								<div class="col-sm-8">
									<p class="form-control-static" style="padding-top:0px"><?=$row['LastOn']?></p>
								</div>
							</div>
							<hr>
							<?php if($rcontype == 3) { ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" style="padding-top:0px">Last IP:</label>
								<div class="col-sm-8">
									<p class="form-control-static" style="padding-top:0px"><?=$row['IP']?></p>
								</div>
							</div>
							<hr> <?php } ?>
							<div class="form-group">
								<label class="col-sm-4 control-label" style="padding-top:0px">Admin Warning Points:</label>
								<div class="col-sm-8">
									<p class="form-control-static" style="padding-top:0px"><?=$row['AWP']?>/5</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<?php
			}
		}
		else if(mysql_num_rows($Query) == 0) return header("Location: /servercp");
		
	}
	else if($page == "logspanel")
	{
		$view = isset($_GET['view']) ? $_GET['view'] : '';
		?> <title>ServerCP - Panel Logs</title> 
		<?php
		if($view == "")
		{
			DisplayHeader($userplayer, "Server Control Panel - Panel Logs");
			?>
			<hr>
			<div class="blue-box"><strong>Here you can view all actions what are actioned in our panel</strong></div>
			<hr>
			<table class="bella">
			<colgroup><col width='10'><col width='10'><col width='10'><col width='280'></colgroup>
			<tbody>
				<?php
				$Query = mysql_query("SELECT * FROM `LogsPanel` ORDER BY `ID` DESC"); 
				//------------------------------------------------------------------------
				if(mysql_num_rows($Query) != 0)
				{
					while($row = mysql_fetch_array($Query)) 
					{
						$count++;
						$str = $row['Log'];
						?>
						<tr>
							<td><font color='#FF0000'><i class="fa fa-edit"></i></font><strong> <?=GetPanelLogType($row['Type'])?></strong></td>
							<td><a href="?page=logspanel&view=<?=$row['ID']?>"><font color="#FFCC00"><i class="far fa-clock"></i></font> <?=$row['Date']?></a></td>
							<td><font color="#0080ff"><i class="fas fa-user"></i></font> <?=GetPlayerNameByID($row['AccID'])?></td>
							<td><?=custom_length($str, 100)?></td>
						</tr>
						<?php
					}
				}
				else if(mysql_num_rows($Query) == 0) { ?><tr><td>No existing informations.</td></tr><?php }
				?>
			</tbody>
			</table>
			<?php
		}
		else
		{
			DisplayHeader($userplayer, "Server Control Panel - Panel Logs <font color='red'>#$view</font>");
			?>
			<hr>
			<div class="blue-box">
			<table class="bella">
			<colgroup><col width='10'><col width='10'><col width='10'><col width='280'></colgroup>
			<tbody>
			<?php
			$Query = mysql_query("SELECT * FROM `LogsPanel` WHERE `ID` = '$view'"); 
			//------------------------------------------------------------------------
			if(mysql_num_rows($Query) != 0)
			{
				while($row = mysql_fetch_array($Query)) 
				{
					?>
					<tr>
						<td><font color='#FF0000'><i class="fa fa-edit"></i></font><strong> <?=GetPanelLogType($row['Type'])?></strong></td>
						<td><font color="#FFCC00"><i class="far fa-clock"></i></font> <?=$row['Date']?></td>
						<td><font color="#0080ff"><i class="fas fa-user"></i></font> <?=GetPlayerNameByID($row['AccID'])?></td>
						<td><?=$row['Log']?></td>
					</tr>
					<?php
				}
			}
			else if(mysql_num_rows($Query) == 0) return header("Location: /servercp?page=logspanel");
			?>
			</tbody>
			</table>
			</div>
			<hr>
			<?php
		}
	}
	else if($page == "discordoptions")
	{
		$message1 = $_POST['message_1'];
		$message2 = $_POST['message_2'];
		if(isset($_POST['send_1'])) { CreatePanelLog(1, $userid, "Sent message <strong>$message1</strong> to Discord BOT"); mysql_query("INSERT INTO `DiscordBotMessages` (`ID`, `Message`) VALUES (NULL, '$message1');"); }
		if(isset($_POST['send_2'])) { CreatePanelLog(1, $userid, "Sent message <strong>$message2</strong> to Discord BOT (DM ALL)"); mysql_query("INSERT INTO `DiscordBotDmMessage` (`ID`, `DmMessage`) VALUES (NULL, '$message2');"); }
		DisplayHeader($userplayer, "Server Control Panel - Discord Options");
		?> <title>ServerCP - Discord Options</title> <?php
		if($rcontype >= 2)
		{
			?>
			<hr><div class="green-box">Here you can send message in discord server by ESSBUSTER:</div><hr>
			<form action="" method="POST">
				<center>
				<br>
				<strong><font color="white"><i class="fa fa-box"></i></font> Message</strong><br>
				<input type="text" STYLE="background-color: #252525;" value="" name="message_1" class="form_field" style="margin-top: 3px;"><br>
				<input type="submit" value="Send" name="send_1" class="button">
				</center>
			</form>
			<?php
		}
		if($rcontype == 3)
		{
			?>
			<br>
			<hr><div class="green-box">Here you can send a DM for all servers from discord.<br>(Note: Please do not spam to avoid the members leave action):</div><hr>
			<form action="" method="POST">
				<center>
				<br>
				<strong><font color="white"><i class="fa fa-box"></i></font> Message</strong><br>
				<textarea name="message_2" class="textbox" name="message_2" cols="50" rows="5"></textarea><br><br>
				<input type="submit" value="Send" name="send_2" class="button">
				</center>
			</form>
			<?php
		}
	}
	else if($page == "blockedaccounts")
	{
	    ?>
	    <title>ServerCP - Blocked Accounts</title>
	    <center>
			<?php DisplayHeader($userplayer, "Server Control Panel - Blocked Accounts"); ?>
	        <hr>
			<div class="blue-box">
			<center><strong>The full list of blocked accounts are here!<br>
			If you want to block or un-block some accounts visit <a href="?page=editplayer"><strong>This </a>link!<font color="red">
			<?php if($rcontype == 3) { ?> (#10) <?php } ?>
			<?php if($rcontype == 2) { ?> (#9) <?php } ?>
			</font></strong></center>
			</div>
			<hr>
			<table class="bella" style="padding-top: 10px;">
			<tbody>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>By</th>
					<th>Date</th>
			    </tr>
			    <?php
		    	$Query = mysql_query("SELECT * FROM `Accounts` WHERE `BlackList` = '1' ORDER BY `BlackListDate` DESC"); 
				//------------------------------------------------------------------------
				if(mysql_num_rows($Query) != 0)
				{
					while($row = mysql_fetch_array($Query)) 
					{
					    $count++;
					    ?>
					    <tr>
    						<td><font color='#FFCC00'><?=$count?></font></td>
    						<td><?=$row['Name']?></td>
    						<td><?=GetPlayerNameByID($row['BlackListBy']);?></td>
    						<td><?=$row['BlackListDate']?></td>
    					</tr>
    					<?php
					}
				}
				else if(mysql_num_rows($Query) == 0)
				{
					?>
					<tr>
						<td>No existing informations.</td>
						<td></td>
					</tr>
					<?php
				}
				?>
			</tbody>
			</table>
		</center> 
		<?php
	}
	else if($page == "rconlogs")
	{
	    ?>
	    <title>ServerCP - Rcon Logs</title>
		<?php DisplayHeader($userplayer, "Server Control Panel - Rcon Logs"); ?>
		<hr>
	    <?php
	    if(isset($_POST['_verify']))
		{
		    $name = $_POST['_name'];
		    if(empty($name)) $namex = "Not specified";
		    if(!empty($name)) $namex = $name;
		    ?>
		    <center> 
    			<div class="blue-box">
    			<center><strong><font color='red'><?=$namex?></font>'s RCON Logs: <a href="#header" title="If you want to search faster use CTRL+F button"><font color="#FFCC00"><i class="fa fa-info-circle"></i></font></a></strong></center>
    			</div>
    			<hr>
    			<table class="bella" style="padding-top: 10px;">
				<tbody>
					<tr>
						<th>#</th>
						<th>Log</th>
						<th>Date</th>
				    </tr>
				    <?php
			    	$Query = mysql_query("SELECT * FROM `LogsRcon` WHERE Log LIKE '%$name%' OR Date LIKE '%$name%' ORDER BY `ID` DESC"); 
					//------------------------------------------------------------------------
					if(mysql_num_rows($Query) != 0)
					{
						while($row = mysql_fetch_array($Query)) 
						{
						    $count++;
						    $log = $row['Log'];
						    $date[1] = $row['Date'];
						    $date[2] = $row['Time'];
						    ?>
						    <tr>
        						<td><font color='#FFCC00'><?=$count?></font></td>
        						<td><?=$log?></td>
        						<td><strong><?=$date[1]?> at <?=$date[2]?></strong></td>
        					</tr>
        					<?php
						}
					}
					else if(mysql_num_rows($Query) == 0)
					{
						?>
						<tr>
							<td>No existing informations.</td>
							<td></td>
							<td></td>
						</tr>
						<?php
					}
					?>
				</tbody>
				</table>
			</center>
            <?php   
		}
		else
		{
			?>
			<div class="blue-box">Here you can find the Rcon Logs</div>
			<hr>
			<center>
			<div class="block">
			<div class="main-middle"> 
				<form action= "" method = "POST">
						<strong><font color="white"></font> Player Name / Date <a href="#header" title="If you want to see all Rcons logs leave it empty!"><font color="#FFCC00"><i class="fa fa-info-circle"></i></font></a></strong>
						<br>
						<input type="text" STYLE="background-color: #252525;" name="_name">
						<br>
						<button type = "submit" class="button" name = "_verify">Verify log</button>
						<button class="button"><a href='/servercp.php'>Back</a></button>
				</form>
			</div>
			</div>
			</center>
			<?php
		}
	}
	else if($page == "iptools")
	{
		DisplayHeader($userplayer, "Server Control Panel - IP Tools"); 
		?><hr><?php
	    if($rcontype == 3)
		{
		    ?>
		    <title>ServerCP - IP Tools</title>
		    <?php
    		if(isset($_POST['_verify']))
    		{
    		    $name = $_POST['_name'];
    		    if(empty($name)) $namex = "Not specified";
    		    if(!empty($name)) $namex = $name;
    		    ?>
    		    <center>
        			<div class="blue-box">
        			<center><strong><font color='red'><?=$namex?></font>'s IP Adress!<br> This IP Adresses was ordered by news to olds!</strong></center>
        			</div>
        			<hr>
        			<table class="bella" style="padding-top: 10px;">
    				<tbody>
    					<tr>
    						<th>#</th>
    						<th>Names</th>
    						<th>IP Adress</th>
    						<th>Location info <sup class="labelBeta"><font color="red">BETA</font></sup></th>
    				    </tr>
    				    <?php
    			    	$Query = mysql_query("SELECT * FROM `Akas` WHERE Names LIKE '%$name%' ORDER BY `ID` DESC"); 
    					//------------------------------------------------------------------------
    					if(mysql_num_rows($Query) != 0)
    					{
    						while($row = mysql_fetch_array($Query)) 
    						{
    						    $count++;
    						    $names = $row['Names'];
    						    $ipadress = $row['IP'];
    						    ?>
    						    <tr>
            						<td><font color='#FFCC00'><?=$count?></font></td>
            						<td><?=$names?></td>
            						<td><strong><?=$ipadress?></strong></td>
            						<td><?=CheckLocation($ipadress)?></td>
            					</tr>
            					<?php
    						}
    					}
    					else if(mysql_num_rows($Query) == 0)
    					{
    						?>
    						<tr>
    							<td>No existing informations.</td>
    							<td></td>
    							<td></td>
    							<td></td>
    						</tr>
    						<?php
    					}
    					?>
    				</tbody>
    				</table>
    			</center>
                <?php   
    		}
    		else
    		{
    			?>
				<div class="blue-box">Here you can find the server Player's IP Adress, and others advanced details</div>
				<hr>
    			<center>
    			<div class="block">
    			<div class="main-middle">
    				<form action= "" method = "POST">
    						<strong><font color="white"></font> Player Name <a href="#header" title="If you want to see all users IP Adress - leave it empty!"><font color="#FFCC00"><i class="fa fa-info-circle"></i></font></a></strong>
    						<br>
    						<input type="text" STYLE="background-color: #252525;" name="_name">
    						<br>
    						<button type = "submit" class="button" name = "_verify">Verify IP</button>
    						<button class="button"><a href='/servercp.php'>Back</a></button>
    				</form>
    			</div>
				</div>
    			</center>
    			<?php
    		}
		}
		else header("Location: /servercp?page=deny");
	}
	else if($page == "donations")
	{
		DisplayHeader($userplayer, "Server Control Panel - Donations"); 
	    if($rcontype == 3)
		{
		    ?>
		    <title>ServerCP - Donations</title>
		    <?php
    		$setstatus = isset($_GET['setstatus']) ? $_GET['setstatus'] : '';
    		$pageid = isset($_GET['id']) ? $_GET['id'] : '';
    		//----------------------------------------------------------------
    		if($setstatus == "")
    		{
    			?> 
    			<hr>
    			<div class="blue-box">
    			<center><strong>Unverified donations</strong></center>
    			</div>
    			<hr>
    				<table class="bella" style="padding-top: 10px;">
    				<tbody>
    					<tr>
    						<th>#</th>
    						<th>By</th>
    						<th>For</th>
    						<th>Amount</th>
    						<th>Method</th>
    						<th>Reference</th>
    						<th>Action</th>
    					</tr>
    					<?php
    					$Query = mysql_query("SELECT * FROM `Donation` WHERE `Status` = 1");
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
    							//--------------------------------------------------------------------
    							if($method == 1) $methodstring = "<font color='#0072FF'><i class='fab fa-amazon-pay'></i></font> Paysafecard";
    							//--------------------------------------------------------------------
    							$actionstring1 = "<a href='?page=donations&setstatus=2&id=$id'> <font color=green><i class='fas fa-check-circle'></i></font> Accept</a>";
    							$actionstring2 = "<a href='?page=donations&setstatus=3&id=$id'> <font color=red><i class='fa fa-times-circle'></i></font> Reject</a>";
    							//--------------------------------------------------------------------
    							?>
    							<tr>
    								<td><font color='#FFCC00'><?=$id?></font></td>
    								<td><?=$by?></td>
    								<td><?=$for?></td>
    								<td><?=$amount?> €</td>
    								<td><?=$methodstring?></td>
    								<td><?=$reference?></td>
    								<td><?=$actionstring1?> | <?=$actionstring2?></td>
    							</tr>
    							<?php
    						}
    					}
    					else if(mysql_num_rows($Query) == 0)
    					{
    						?>
    						<tr>
    							<td>No existing donations.</td>
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
    				</tbody>
    				</table>
    			<div id='_confirmed_donations_less' style='display: block;'>
    			<hr>
    			<div class="blue-box">
    			<center><strong>Verified donations</strong></center>
    			</div>
    			<hr>
    				<table class="bella" style="padding-top: 10px;">
    				<tbody>
    					<tr>
    						<th>#</th>
    						<th>By</th>
    						<th>For</th>
    						<th>Amount</th>
    						<th>Method</th>
    						<th>Reference</th>
    						<th>Date</th>
    						<th>Status</th>
    					</tr>
    					<?php
    					$Query = mysql_query("SELECT * FROM `Donation` WHERE `Status` >= 2 ORDER BY `ID` DESC LIMIT 6");
    					$asd = mysql_query("SELECT * FROM `Donation` WHERE `Status` >= 2 ORDER BY `ID` DESC");
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
    							$date = $row['Date'];
    							$time = $row['Time'];
    							//---------------------------------------------
    							$Query2 = mysql_query("SELECT * FROM `Accounts` WHERE `ID` = '$verefiedby'");
    							while($row2 = mysql_fetch_array($Query2))
    							{
    								$verifiedbyname = $row2['Name'];
    							}
    							//---------------------------------------------
    							if($method == 1) $methodstring = "<font color='#0072FF'><i class='fab fa-amazon-pay'></i></font> Paysafecard";
    							//---------------------------------------------
    							if($status == 1) $statusstring = "<font color='orange'><i class='fa fa-hourglass-half'></i></font> Pending";
    							if($status == 2) $statusstring = "<font color='green'><i class='fas fa-check-circle'></i></font> Accepted by $verifiedbyname";
    							if($status == 3) $statusstring = "<font color='red'><i class='fa fa-times-circle'></i></font> Rejected by $verifiedbyname";
    							//---------------------------------------------
    							?>
    							<tr>
    								<td><font color="#FFCC00"><?=$id?></font></td>
    								<td><?=$by?></td>
    								<td><?=$for?></td>
    								<td><?=$amount?> €</td>
    								<td><?=$methodstring?></td>
    								<td><?=$reference?></td>
    								<td><?=$date?> at <?=$time?></td>
    								<td><?=$statusstring?></td>
    							</tr>
    							<?php
    						}
    						
    					}
    					else if(mysql_num_rows($Query) == 0)
    					{
    						?>
    						<tr>
    							<td>No existing donations.</td>
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
					</tbody>
				</div>
    			
    			<?php
    			if(mysql_num_rows($asd) >= 7)
    			{
    				?>
    				<br>
    				<center>
    					<a href="#header" id="_confirmed_donations_button" class="button" onclick="
    						document.getElementById('_confirmed_donations_less').style.display='none';
    						document.getElementById('_confirmed_donations_more').style.display='block';
    						document.getElementById('_confirmed_donations_button').style.display='none';">Load more...
    					</a>
    				</center>
    				</div>
    				<?php
    			}
    			else
    			{
    				?>
    				</div>
    				<?php
    			}
    			
    			?>
    			<div id='_confirmed_donations_more' style='display: none;'>
    			<hr>
    			<div class="blue-box">
    			<center><strong>Verified donations</strong></center>
    			</div>
    			<hr>
    				<table class="bella" style="padding-top: 10px;">
    				<tbody>
    					<tr>
    						<th>#</th>
    						<th>By</th>
    						<th>For</th>
    						<th>Amount</th>
    						<th>Method</th>
    						<th>Reference</th>
    						<th>Date</th>
    						<th>Status</th>
    					</tr>
    					<?php
    					$Querys = mysql_query("SELECT * FROM `Donation` WHERE `Status` >= 2 ORDER BY `ID` DESC");
    					//------------------------------------------------------------------------
    					if(mysql_num_rows($Querys) != 0)
    					{
    						while($row = mysql_fetch_array($Querys))
    						{
    							$id = $row['ID'];
    							$by = $row['By'];
    							$for = $row['For'];
    							$amount = $row['Amount'];
    							$method = $row['Method'];
    							$reference = $row['Reference'];
    							$status = $row['Status'];
    							$verefiedby = $row['VerifiedBy'];
    							$date = $row['Date'];
    							$time = $row['Time'];
    							//---------------------------------------------
    							$Query2 = mysql_query("SELECT * FROM `Accounts` WHERE `ID` = '$verefiedby'");
    							while($row2 = mysql_fetch_array($Query2))
    							{
    								$verifiedbyname = $row2['Name'];
    							}
    							//---------------------------------------------
    							if($method == 1) $methodstring = "<font color='#0072FF'><i class='fab fa-amazon-pay'></i></font> Paysafecard";
    							//---------------------------------------------
    							if($status == 1) $statusstring = "<font color='orange'><i class='fa fa-hourglass-half'></i></font> Pending";
    							if($status == 2) $statusstring = "<font color='green'><i class='fas fa-check-circle'></i></font> Accepted by $verifiedbyname";
    							if($status == 3) $statusstring = "<font color='red'><i class='fa fa-times-circle'></i></font> Rejected by $verifiedbyname";
    							//---------------------------------------------
    							?>
    							<tr>
    								<td><font color="#FFCC00"><?=$id?></font></td>
    								<td><?=$by?></td>
    								<td><?=$for?></td>
    								<td><?=$amount?> €</td>
    								<td><?=$methodstring?></td>
    								<td><?=$reference?></td>
    								<td><?=$date?> at <?=$time?></td>
    								<td><?=$statusstring?></td>
    							</tr>
    							<?php
    						}
    						
    					}
    					else if(mysql_num_rows($Quers) == 0)
    					{
    						?>
    						<tr>
    							<td>No existing donations.</td>
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
					</tbody>
				</div>
    			<?php
    		}
    		else if($setstatus == 2)
    		{	
    			$Query = mysql_query("SELECT * FROM `Donation` WHERE `ID` = '$pageid'");
    			while($row = mysql_fetch_array($Query))
    			{
    				if($row['Status'] != 2 && $row['Status'] != 3)
    				{
						CreatePanelLog(2, $userid, "Accepted donation #$pageid");
    				    mysql_query("UPDATE `Donation` SET `Status` = '2', `VerifiedBy` = '$userid', `Date` = '".date("d.m.Y")."', `Time` = '".date("H:i")."' WHERE `ID` = '$pageid'");
    					$Query = mysql_query("SELECT * FROM `Donation` WHERE `ID` = '$pageid'");
    					while($row = mysql_fetch_array($Query))
    					{
    						$Name = $row['For'];
    						$Price = $row['Amount'] * 50;
    						//----------------------------------------------------------------------
    						$Query2 = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$Name'");
    						while($row2 = mysql_fetch_array($Query2))
    						{
    							$gems = $row2['Gems'];
    							$totalgems = $gems + $Price;
    							mysql_query("UPDATE `Accounts` SET `Gems` = '$totalgems' WHERE `Name` = '$Name'");
    						}
    					}
    					?>
    					<div class="ex">
    						<div class="green-box">
    							<p align="left">
    							Succes - Payment #<strong><?=$pageid?></strong> was verified<br>
    							As <strong><font color=yellow>Accept</font></strong>
    							Click<a href="?page=donations"><strong> here</strong></a> to go back!
    							</p>
    						</div>
    					</div>
    					<?php
    				}
    				else Header("Location: ?page=deny");
    			}
    		}
    		else if($setstatus == 3)
    		{		
				CreatePanelLog(2, $userid, "Declined donation #$pageid");
    			$Query = mysql_query("SELECT * FROM `Donation` WHERE `ID` = '$pageid'");
    			while($row = mysql_fetch_array($Query))
    			{
    				if($row['Status'] != 2 && $row['Status'] != 3)
    				{
    					mysql_query("UPDATE `Donation` SET `Status` = '3', `VerifiedBy` = '$userid', `Date` = '".date("d.m.Y")."', `Time` = '".date("H:i")."' WHERE `ID` = '$pageid'");
    					?>
    					<div class="ex">
    						<div class="green-box">
    							<p align="left">
    							Succes - Payment #<strong><?=$pageid?></strong> was verified<br>
    							As <strong><font color=yellow>Reject</font></strong>
    							Click<a href="?page=donations"><strong> here</strong></a> to go back!
    							</p>
    						</div>
    					</div>
    					<?php
    				}
    				else Header("Location: ?page=deny");
    			}
    		}
    		else Header("Location: ?page=deny");
		}
		else header("Location: /servercp?page=deny");
	}
	else if($page == "kickplayer")
	{
	    ?>
	    <title>ServerCP - Kick Online Player</title>
		<?php DisplayHeader($userplayer, "Server Control Panel - Kick Online Player"); 
		if($kick == 0)
		{
			if($rcontype >= 1) $actionstring = "Action"; 
			?> 
			<center>
			<div class="bella">
			<table class="bella"> 
				<tbody>
					<th>#</th>
					<th>Name</th>
					<th><?= $actionstring ?></th>
					<p></p>
					<hr>
				</tbody>
				<div class="info">
					<center><b>Here you can kick an online player</b></center>
				</div>
				<hr>		
			</center>
			<?php
			$Query = mysql_query("SELECT * FROM `Accounts` WHERE `Status` > 0 AND `Kicked` = 0 ORDER BY `ID` DESC"); $pID = 0;
			if(mysql_num_rows($Query) != 0)
			{
    			while($row = mysql_fetch_array($Query))
    			//-------------------------------------------------------------------------------------------
    			{
    				$pID++;
    				$pRconType = $row['RconType'];
    				$pAdmin = $row['Level'];
    				$ID = $row['ID'];
    				//---------------------------------------------------------------------------------------
    				if($pRconType == 1) $rank = "<font color=white><i class='fa fa-user'></i></font>";
    				else if($pRconType == 2) $rank = "<font color=#FF5555><i class='fa fa-user'></i></font>";
    				else if($pRconType == 3) $rank = "<font color=red><i class='fa fa-user'></i></font>";
    				else if($pAdmin != 0) $rank = "<font color='#09C'><i class='fa fa-user'></i></font>";
    				else $rank = "<i class='fa fa-user'></i>";
    				//---------------------------------------------------------------------------------------- 
    				$actionstring2 = "<a href='?kick=$ID'> <font color=#FF0000><i class='fas fa-times'></i></font> Kick</a>";
    				?>
    				<tr>
    					<td><font color='#FFCC00'><?=$pID?></font></td>
    					<td><?=$rank?> <?=$row["Name"]?></td>
    					<td><?=$actionstring2?></td>
    				</tr>
    				<?php
	            } 
			}
            else if(mysql_num_rows($Query) == 0)
			{
			    ?>
			    <tr>
    		        <td>No online players yet.</td>
    		        <td></td>
    		        <td></td>
                </tr>
				<?php
			}
			?>
			</table>
			</div>
			<?php
		}
	}
	else if($kick >= 1)
	{
	    ?>
	    <title>ServerCP - Kick Online Player</title>
	    <?php
		DisplayHeader($userplayer, "Server Control Panel - Kick Online Player"); 
		$Query = mysql_query("SELECT * FROM `Accounts` WHERE `ID` = $kick");
		while($row = mysql_fetch_array($Query))
		{
			$kickname = $row['Name'];
			$reason = $_POST['Reason2'];
			if(isset($_POST['seets2'])) 
			{
				if($row['Name'] == $userplayer || $row['RconType'] >= $rcontype || $row['Status'] == 0 || $reason == "") Header("Location: ?page=deny");
				else
				{
					CreatePanelLog(3, $userid, "Kicked online player $kickname");
					mysql_query("UPDATE `Accounts` SET `Kicked` = '1', `KickReason` = '$reason', `KickAdmin` = '$userplayer' WHERE `ID` = '$kick'");
					//---------------------------------------------------------------------
					Header('Location: ?page=kickplayer'); 
				}
				
			}
			if($row['Status'] >= 1)
			{
				?>
				<br>
				<center>
				<div class="block">
				<div class="main-middle">
				<h1 class="ipsType_pagetitle"><center>Kick <font color='#FF0000'><?= $row['Name'] ?></font></center></h1>
					<form action= "" method = "POST">
							<strong><font color="white"></font> Kick reason</strong>
							<br>
							<input type="text" STYLE="background-color: #252525;" name="Reason2">
							<br>
							<button type = "submit" class="button" name = "seets2">Kick</button>
							<button class="button"><a href='?page=kickplayer'>Cancel</a></button>
					</form>
				</div>
				</div>
				</center>
				<?php
			}
			else
			{
				?>
					<br>
					<div class="block">
					<div class="main-middle">

					<div class="error-box">
						<p align="left">Error! This player is offline!<br>Click<a href='?page=kickplayer'> here</a> to back!</p>
					</div>
					</div>
					</div>
				<?php
			}
		}
	}
	else if($page == "editplayer")
	{
	    ?>
	    <title>ServerCP - Edit Player Stats</title>
		<?php DisplayHeader($userplayer, "Server Control Panel - Edit Player Stats"); ?>
		<hr>
		<div class="blue-box">Here you can edit an offline Player Stats</div>
		<hr>
		<?php
		if(isset($_POST['value_1'])) 
		{	
		    if(!empty($_POST['Editp'])) Header("Location: ?player=".$_POST['Editp'].""); 
		    else Header("Location: ?page=deny");
		}
		?>
		<center>
		<div class="block">
		<div class="main-middle">
			<form action= "" method = "POST">
					<strong><font color="white"><i class="fa fa-user"></i></font> Player name</strong>
					<br>
					<input type="text" STYLE="background-color: #252525;" name="Editp">
					<br>
					<button type = "submit" class="button" name = "value_1">Edit</button>
					<button class="button"><a href='/servercp.php'>Cancel</a></button>
			</form>
		</div>
		</div>
		</center>
		<?php
	}
	else if(isset($_GET["player"]))
	{		
	    ?>
	    <title>ServerCP - E.P.S - <?=$_GET["player"]?></title>
	    <?php
		$option = isset($_GET['option']) ? $_GET['option'] : '';
		$Name = mysql_real_escape_string(stripslashes($_GET["player"]));
		$QResult = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$Name'");
		//-------------------------------------------------------------------------
		if($option == 0)
		{
			?> 
			<?php DisplayHeader($userplayer, "Server Control Panel - Edit Player Stats"); ?>
			<center>
			<div class="main-middle">
			<div class="bella">
			<table class="bella"> 
			<tbody>
				<th>#</th>
				<th>Item</th>
				<th>Value</th>
				<th>Action</th>
				<p></p>
				<hr>
			</tbody>
			<?php
			if($_SESSION['Action'] != "")
			{
				$pn = $_GET["player"];
				$string = $_SESSION['Action'];
				CreatePanelLog(4, $userid, "Seted stats $pn to $string");
				Success2("You has seted <font color='#EAFF00'>$pn's</font> stats to <font color='#00EAFF'>$string</font>");
				$_SESSION['Action'] = ""; ?> <hr> <?php
			}
			else
			{
				?>
				<div class="info">
				<center><b>Here you can edit <font color='#FF0000'><?= $_GET["player"] ?>'s</font> stats! </b></center>
				</div>
				<hr>
				<?php
			}
			//------------------------------------------------------------------
			if(mysql_num_rows($QResult) == 0) Header("Location: ?page=deny");
			else
			{ 
				while($row = mysql_fetch_array($QResult))
				{
					if($row['RconType'] == 1) $rconrank = "RCON";
					else if($row['RconType'] == 2) $rconrank = "Support";
					else if($row['RconType'] == 3) $rconrank = "Manager";
					else $rconrank = "None";
					//----------------------------------------------------------
					function GetColor($value)
					{
				        if($value == 0) $color = "red";
					    else if($value >=1) $color = "green";
					    return $color;
					}
					function GetNameString($value)
					{
					    if($value == 1) $string = "Yes";
					    else if($value == 0) $string = "No";
					    return $string;
					}
					function GetBlockName($value)
					{
					    if($value == 1) $string = "Click for UnBlock";
				        else if($value == 0) $string = "<i class='img sp_QbfE9lfrth6_1_5x sx_23c6f1'></i> Click for Block"; 
				        return $string;
					}
					function GetWhatToSet($value)
					{
					    if($value == 1) $what = 0;
					    else if($value == 0) $what = 1;
					    return $what;
					}
					//----------------------------------------------------------
					$count = 1;
					if($rcontype == 3) { ?> <tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Gems</td>		            <td><font color=<?= GetColor($row['Gems']);?>><?= $row['Gems'] ?></font></td>			                <td><a href='?player=<?= $Name ?>&option=1' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++; } ?>
			        <tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Admin 1 Acces</td>        <td><font color=<?= GetColor($row['AdminAccesForAdmin1']);?>><?= GetNameString($row['AdminAccesForAdmin1']); ?></font></td>     <td><a href='?player=<?= $Name ?>&option=2' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
				    <tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Coins</td>		        <td><font color=<?= GetColor($row['Coins']);?>><?= $row['Coins'] ?></font></td>			                                        <td><a href='?player=<?= $Name ?>&option=3' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
					<tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Level</td>		        <td><?= $row['Level'] ?></td>			                                                                                        <td><a href='?player=<?= $Name ?>&option=4' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
					<tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Race</td>		            <td><font color=<?= GetColor($row['RaceScore']);?>><?= $row['RaceScore'] ?></font></td>		                                    <td><a href='?player=<?= $Name ?>&option=5' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
				    <tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Drift</td>		        <td><font color=<?= GetColor($row['DriftScore']);?>><?= $row['DriftScore'] ?></font></td>                                       <td><a href='?player=<?= $Name ?>&option=6' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
				    <tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Stunt</td>		        <td><font color=<?= GetColor($row['StuntScore']);?>><?= $row['StuntScore'] ?></font></td>	                                    <td><a href='?player=<?= $Name ?>&option=7' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
				    <tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Hours</td>		        <td><font color=<?= GetColor($row['Hours']);?>><?= $row['Hours'] ?></font></td>	                                                <td><a href='?player=<?= $Name ?>&option=8' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
		        	<tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>RCON</td>		            <td><?= $rconrank ?></td>				                                                                                        <td><a href='?player=<?= $Name ?>&option=9' data-toggle='modal' class='button'>Edit</a></td></tr> <? $count++;?>
	        	    <tr><td><font color='#FFCC00'><?=$count?></font></td>     <td>Block Account</td>		<td><?= GetNameString($row['BlackList']); ?></td>				                                                                <td><a href='?player=<?= $Name ?>&option=10&set=<?= GetWhatToSet($row['BlackList']); ?>' data-toggle='modal' class='button'><?= GetBlockName($row['BlackList']); ?></a></td></tr>
					</table>
					</div>
					</div>
					<?php
				}
			}
		}
		if($option == 2)
		{
			?>
			<?php DisplayHeader($userplayer, "Server Control Panel - Edit Player Stats"); ?>
			<hr>
			<center>
			<div class="block">
			<div class="main-middle">
			<div class="blue-box">Here you can edit <font color="red"><?=$Name?></font>'s <font color="red">Admin Access</font></div>
			<hr>
				<form action= "" method = "POST">
					<strong><font size=3> Set Admin Access</font></strong>
					<br>
					<input type="radio" STYLE="background-color: #252525;" name="adminacc" value="1" checked=""> Remove<br>
					<input type="radio" name="adminacc" value="2"> Promove<br>
					<br>
					<button type = "submit" class="button" name = "setac">Set</button>
					<button class="button"><a href='/servercp.php'>Cancel</a></button>
					
				</form>
			</div>
			</div>
			</center>
			<?php
		}
		if($option == 9)
		{
			?>
			<?php DisplayHeader($userplayer, "Server Control Panel - Edit Player Stats"); ?>
			<hr>
			<center>
			<div class="block">
			<div class="main-middle">  
			<div class="blue-box">Here you can edit <font color="red"><?=$Name?></font>'s <font color="red">Rcon Rank</font></div>
			<hr>
				<form action= "" method = "POST">
					<br>
					<input type="radio" STYLE="background-color: #252525;" name="rcon" value="1" checked=""> Remove<br>
					<input type="radio" name="rcon" value="2"> Rcon<br>
					<?php
					if($rcontype == 3)
					{
						?>
						<input type="radio" name="rcon" value="3"> Support<br>
						<?php
					}
					?>
					<br>
					<button type = "submit" class="button" name = "setr">Set</button>
					<button class="button"><a href='/servercp.php'>Cancel</a></button>
					
				</form>
			</div>
			</div>
			</center>
			<?php
		}
		if($option >= 1)
		{
			$set = isset($_GET['set']) ? $_GET['set'] : '';
			//-----------------------------------------------------------------
			$set2 = $_POST['Amount2'];
			if(isset($_POST['set'])) Header("Location: ?player=$Name&option=$option&set=$set2");
			
			if(isset($_POST['setac']))
			{
				$radioValue = $_POST["adminacc"];
				if($radioValue == "1") Header("Location: ?player=$Name&option=$option&set=1");
				else if($radioValue == "2") Header("Location: ?player=$Name&option=$option&set=2");
			}
			
			if(isset($_POST['setr']))
			{
				$radioVal = $_POST["rcon"];
				if($radioVal == "1") Header("Location: ?player=$Name&option=$option&set=1");
				else if($radioVal == "2") Header("Location: ?player=$Name&option=$option&set=2");
				else if($radioVal == "3") Header("Location: ?player=$Name&option=$option&set=3");
			}
			//-----------------------------------------------------------------
			if($option == 1) 
			{
				$what = "Gems";
				$what2 = "Gems";
				$rankwhatneed = 3;
			}
			if($option == 3) 
			{
				$what = "Coins";
				$what2 = "Coins";
				$rankwhatneed = 2;
			}
			if($option == 4)
			{
				$what = "Level";
				$what2 = "Level";
				$rankwhatneed = 2;
			}
			if($option == 5) 
			{
				$what = "Race Points";
				$what2 = "RaceScore";
				$rankwhatneed = 2;
			}
			if($option == 6)
			{
				$what = "Drift Points";
				$what2 = "DriftScore";
				$rankwhatneed = 2;
			}
			if($option == 7) 
			{
				$what = "Stunt Points";
				$what2 = "StuntScore";
				$rankwhatneed = 2;
			}
			if($option == 8) 
			{
				$what = "Hours";
				$what2 = "Hours";
				$rankwhatneed = 2;
			}
			if($option == 10 && $set >= 0)
			{
			    mysql_query("UPDATE `Accounts` SET `BlackList` = '$set', `BlackListBy` = '$accID', `BlackListDate` = '".date("d F, Y")."' WHERE `Name` = '$Name'");
				//--------------------------------------------------------------
				Header("Location: ?player=$Name");
				if($set == 1) { $_SESSION['Action'] = "Blacklist ON"; }
				else if($set == 0) { $_SESSION['Action'] = "Blacklist OFF"; }
			}
			//-----------------------------------------------------------------
			if($option == 1 || $option == 3 || $option == 4 || $option == 5 || $option == 6 || $option == 7 || $option == 8)
			{
				if($set == "" && $rcontype >= $rankwhatneed)
				{
					?>
					<?php DisplayHeader($userplayer, "Server Control Panel - Edit Player Stats"); ?>
					<hr>
					<center>
					<div class="block">
					<div class="main-middle">
					<div class="blue-box">Here you can edit <font color="red"><?=$Name?></font>'s <font color="red"><?=$what?></font></div>
					<hr>
						<form action= "" method = "POST">
								<strong><font color="white"></font> Amount</strong>
								<br>
								<input type="text" STYLE="background-color: #252525;" name="Amount2">
								<br>
								<button type = "submit" class="button" name = "set">Set</button>
								<button class="button"><a href='/servercp.php'>Cancel</a></button>
						</form>
					</div></div>
					</center>
					<?php
				}
				else if($set >= 0 && $rcontype >= $rankwhatneed)
				{
					mysql_query("UPDATE `Accounts` SET `$what2` = '$set' WHERE `Name` = '$Name'");
					//----------------------------------------------------------
					Header("Location: ?player=$Name");
					$_SESSION['Action'] = "$what $set";
				}
			}
			if($option == 2)
			{
			    if($set >= 1)
				{
    				$dbset = $set - 1;
    				//--------------------------------------------------------------
    				mysql_query("UPDATE `Accounts` SET `AdminAccesForAdmin1` = '$dbset' WHERE `Name` = '$Name'");
    				Header("Location: ?player=$Name");
					if($dbset == 1) { $_SESSION['Action'] = "Admin Access ON"; }
					else if($dbset == 0) { $_SESSION['Action'] = "Admin Access OFF"; }
				}
			}
			if($option == 9)
			{
				$Query = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$Name'");
				while($row = mysql_fetch_array($Query)) $RconType = $row['RconType'];
				//--------------------------------------------------------------
				if($set >= 1)
				{
					if($Name != $userplayer) 
					{
						if($rcontype > $RconType)
						{
							$dbset = $set - 1;
							//--------------------------------------------------
							mysql_query("UPDATE `Accounts` SET `RconType` = '$dbset' WHERE `Name` = '$Name'");
							Header("Location: ?player=$Name");
							if($dbset == 0) { $_SESSION['Action'] = "RCON RANK OFF"; }
							else if($dbset == 1) { $_SESSION['Action'] = "RCON RANK Rcon"; }
							else if($dbset == 2) { $_SESSION['Action'] = "RCON RANK Support"; }
							else if($dbset == 3) { $_SESSION['Action'] = "RCON RANK Manager"; }
						}
						else Header("Location: ?page=deny");
					}
					else Header("Location: ?page=deny");
				}
			}
		}
	}
	else if($page == "deny")
	{
		?>
		<title>ServerCP - Error</title>
		<br>
		<div class="block">
		<div class="main-middle">
		<div class="error-box">
			<p align="left">A intervenit o eroare!<br>Daca crezi ca eroarea persista, raporteaza-l!</p>
		</div>
		</div>
		</div>
		<?php
	}
	else return header("Location: /servercp");
	?>
	</div>
	<?php
}
else Header('Location: /'); 
require_once("a_Footer.php"); 
?>