<?php require_once("a_Header.php"); ?>
<title>Top 100</title>
<?php
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
?>
<center>
	<div class="ex">
		<h1 class="ipsType_pagetitle"><center><i class="fa fa-trophy"></i> Top 100!</center></h1>
		<hr>
		<div class="orange-box2"><center><strong>The best of the best players are here! It is a honor to be in these lists!<br>This page has been lastly updated on <?= GetDateUpdate() ?></strong></center></div>
		<hr>
		<div style="border: 2px solid #3b3b3b; border-radius: 5px; padding: 10px;">
			<table border="0">
			<tbody><tr>
				<td><center><a href="#header" id="top_1" style="color:#0072FF;" onclick="ShowItem(1)"><i class="far fa-clock fa-4x"></i></a></center></td>
				<td><center><a href="#header" id="top_2" style="color:#0072FF;" onclick="ShowItem(2)"><i class="far fa-star fa-4x"></i></a></center></td>
				<td><center><a href="#header" id="top_3" style="color:#0072FF;" onclick="ShowItem(3)"><i class="fa fa-trophy fa-4x"></i></a></center></td>
				<td><center><a href="#header" id="top_4" style="color:#0072FF;" onclick="ShowItem(4)"><i class="fa fa-flag-checkered fa-4x"></i></a></center></td>
				<td><center><a href="#header" id="top_5" style="color:#0072FF;" onclick="ShowItem(5)"><i class="fa fa-crosshairs fa-4x"></i></a></center></td>
				<td><center><a href="#header" id="top_6" style="color:#0072FF;" onclick="ShowItem(6)"><i class="fa fa-chess-queen fa-4x"></i></a></center></td>
				</tr><tr>
				<td><center><strong>Activity</strong></center></td>
				<td><center><strong>Stunters</strong></center></td>
				<td><center><strong>Drifters</strong></center></td>
				<td><center><strong>Racers</strong></center></td>
				<td><center><strong>Killers</strong></center></td>
				<td><center><strong>Gang members</strong></center></td>
				</tr>
			</tbody></table>
		</div>
<script>

function ShowItem($id)
{
    for(i = 1; i < 7; i++)
	{
		_div_page = "Item_"  + i;
		_div_butt = "top_" + i;
		
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
	document.getElementById('top3').style.display='none';
}
</script>
<?php
ShowTopHeader();
function GetTopPlayerEx($topID, $player)
{
	if($topID == 1) $cachestring = "HoursMonth";
	if($topID == 2) $cachestring = "StuntMonth";
	if($topID == 3) $cachestring = "DriftMonth";
	if($topID == 4) $cachestring = "RaceMonth";
	if($topID == 5) $cachestring = "KillsMonth";
	if($topID == 6) $cachestring = "GangPoints";
	//------------------------------------------------------------------------------------------
	$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `$cachestring` DESC LIMIT $player");
	while($row = mysql_fetch_array($Query))
	{
		$name = $row['Name'];
		if($topID == 1) $string = "$name - $row[HoursMonth] Hours";
		if($topID == 2) $string = "$name - $row[StuntMonth] Points";
		if($topID == 3) $string = "$name - $row[DriftMonth] Points";
		if($topID == 4) $string = "$name - $row[RaceMonth] Points";
		if($topID == 5) $string = "$name - $row[KillsMonth] Points";
		if($topID == 6) $string = "$name - $row[GangPoints] Points";
	}
	return $string;
}
function ShowTopHeader()
{
	?>
	<div id='top3' style='display: block;'>
		<div style="clear:both;"></div>
		<br>
			<table class='bella'>
				<tbody><tr>
				<td>
					<strong><i class='fa fa-trophy'></i> Activity  - This month</strong><br>
					<br><font color='red'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(1, 1)?>
					<br><font color='#FFCC00'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(1, 2)?>
					<br><font color='#05C81F'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(1, 3)?>
				</td>
				<td>
					<strong><i class='fa fa-trophy'></i> Stunters - This month</strong><br>
					<br><font color='red'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(2, 1)?>
					<br><font color='#FFCC00'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(2, 2)?>
					<br><font color='#05C81F'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(2, 3)?>
				</td>
				<td>
					<strong><i class='fa fa-trophy'></i> Drifters - This month</strong><br>
					<br><font color='red'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(3, 1)?>
					<br><font color='#FFCC00'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(3, 2)?>
					<br><font color='#05C81F'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(3, 3)?>
				</td>
				<td>
					<strong><i class='fa fa-trophy'></i> Racers - This month</strong><br>
					<br><font color='red'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(4, 1)?>
					<br><font color='#FFCC00'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(4, 2)?>
					<br><font color='#05C81F'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(4, 3)?>
				</td>
				<td>
					<strong><i class='fa fa-trophy'></i> Killers - This month</strong><br>
					<br><font color='red'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(5, 1)?>
					<br><font color='#FFCC00'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(5, 2)?>
					<br><font color='#05C81F'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(5, 3)?>
				</td>
				<td>
					<strong><i class='fa fa-trophy'></i> Members - All the time</strong><br>
					<br><font color='red'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(6, 1)?>
					<br><font color='#FFCC00'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(6, 2)?>
					<br><font color='#05C81F'><i class='fa fa-star'></i></font> <?=GetTopPlayerEx(6, 3)?>
				</td>
				</tr></tbody>
			</table>
	</div>
	<?php
}
?>
<div id="Item_1" style="display: none;">
	<div style="float:left; padding-left: 50px;">
		<center><br><strong><font color="#0072FF"><i class="far fa-clock"></i></font> All the time</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `Hours` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="far fa-clock"></i> <?= $row['Hours'] ?> hours</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div style="float:right; padding-right: 50px;">
		<center><br><strong><font color="#0072FF"><i class="far fa-clock"></i></font> This month</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `HoursMonth` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="far fa-clock"></i> <?= $row['HoursMonth'] ?> hours</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
<?php
ShowTopHeader();
?>
</div>

<div id="Item_2" style="display: none;">
	<div style="float:left; padding-left: 50px;">
		<center><br><strong><font color="#0072FF"><i class="far fa-star"></i></font> All the time</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `StuntScore` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="far fa-star"></i> <?= $row['StuntScore'] ?> stunt points</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div style="float:right; padding-right: 50px;">
		<center><br><strong><font color="#0072FF"><i class="far fa-star"></i></font> This month</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `StuntMonth` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="far fa-star"></i> <?= $row['StuntMonth'] ?> stunt points</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
<?php
ShowTopHeader();
?>
</div>

<div id="Item_3" style="display: none;">
	<div style="float:left; padding-left: 50px;">
		<center><br><strong><font color="#0072FF"><i class="fa fa-trophy"></i></font> All the time</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `DriftScore` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="fa fa-trophy"></i> <?= $row['DriftScore'] ?> drift points</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div style="float:right; padding-right: 50px;">
		<center><br><strong><font color="#0072FF"><i class="fa fa-trophy"></i></font> This month</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `DriftMonth` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="fa fa-trophy"></i> <?= $row['DriftMonth'] ?> drift points</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
<?php
ShowTopHeader();
?>
</div>

<div id="Item_4" style="display: none;">
	<div style="float:left; padding-left: 50px;">
		<center><br><strong><font color="#0072FF"><i class="fa fa-flag-checkered"></i></font> All the time</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `RaceScore` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="fa fa-flag-checkered"></i> <?= $row['RaceScore'] ?> race points</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div style="float:right; padding-right: 50px;">
		<center><br><strong><font color="#0072FF"><i class="fa fa-flag-checkered"></i></font> This month</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `RaceMonth` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="fa fa-flag-checkered"></i> <?= $row['RaceMonth'] ?> race points</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
<?php
ShowTopHeader();
?>
</div>

<div id="Item_5" style="display: none;">
	<div style="float:left; padding-left: 50px;">
		<center><br><strong><font color="#0072FF"><i class="fa fa-crosshairs"></i></font> All the time</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `Kills` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="fa fa-crosshairs"></i> <?= $row['Kills'] ?> kills</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div style="float:right; padding-right: 50px;">
		<center><br><strong><font color="#0072FF"><i class="fa fa-crosshairs"></i></font> This month</strong></center><br>
		<table class="bella" style="width: 500px; padding-left:10px;">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `KillsMonth` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="fa fa-crosshairs"></i> <?= $row['KillsMonth'] ?> kills</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
<?php
ShowTopHeader();
?>
</div>

<div id="Item_6" style="display: none;">
	
		<center><br><strong><font color="#0072FF"><i class="fa fa-crosshairs"></i></font> All the time</strong></center><br>
		<table class="bella">
			<tbody>
			<?php
				$Query = mysql_query("SELECT * FROM `Accounts`  WHERE `GangID` >= '1' ORDER BY `GangPoints` DESC LIMIT 100"); $i = 0; 
				while($row = mysql_fetch_array($Query))
				{
					 $i++;
					 $gID = $row['GangID'];
					 //---------------------------------------------------------------------------------
					 $Query2 = mysql_query("SELECT * FROM `Gangs` WHERE `ID` = '$gID'"); 
					 while($row2 = mysql_fetch_array($Query2))
					 {
						 $GangName = $row2['GangName'];
					 }
					 ?>
					<tr>
						<td><?= $i ?></td>
						<td><font color="#0072FF"><i class="fa fa-user"></i></font> <?= $row['Name'] ?></td>
						<td><i class="fa fa-chess-queen"></i> <?= $row['GangPoints'] ?> gang points</td>
						<td><i class="fa fa-users"></i> <?= $GangName ?></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
<?php
ShowTopHeader();
?>
</div>
<?php 
require_once("a_Footer.php"); 
?>