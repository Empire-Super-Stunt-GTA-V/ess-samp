<?php require_once("a_Header.php"); ?>
<title>Player of the Month</title>
<?php
function GetDateUpdate()
{
	$Query = mysql_query("SELECT * FROM `ServerCFG`");
	//--------------------------------------------------------------------------
	while($row = mysql_fetch_array($Query))
	{
		$Date = $row['UpdateData'];
		//----------------------------------------------------------------------
		$Time = $row['UpdateTime'];
		//----------------------------------------------------------------------
		$sstring = "<font color='red'>$Date</font> at <font color='red'>$Time</font>.";
	}
	return $sstring;
}
?>
<center>
<div class="main-middle">
	<div class="ex">
		<div class="bella">
		    <center><font color="#FFCC00"><i class="fa fa-star fa-2x"></i> <i class="fa fa-trophy fa-3x"></i> <i class="fa fa-star fa-2x"></i></font></center>
			<?php DisplayHeader($userplayer, "Player of the Month");?>
		    <hr>
		    <div class="panel-box">
			<center><strong>Cei mai buni jucatori lună de lună se află aici! Este o onoare să te afli în această listă!</strong>
			<br>Câștigătorul acestei competiții primește un premiu în valoare de <font color="red">30</font> credite și un loc în <font color="red">Hall of Fame-ul</font> celor mai buni jucători de pe server ce se afla în partea de jos a paginii!</center>
			<br><br>
			<center>
			<strong>Fiecare metric valorează un procent din punctajul total după cum urmează</strong><br>
			20% Hours | 15% Stunt | 5% Drift | 10% Race | 10% Kills | 20% Positive Respect | 20% Gems<br>
			<br>
			<strong>De asemenea, fiecare metric are un anumit target, care neatins duce la scăderea punctajului cu procentul echivalent de mai sus</strong><br>
			Hours &gt; 100 | Stunt &gt; 3500 | Drift &gt; 8000 | Race &gt; 2000 | Kills &gt; 2500 | Respect &gt; 150 | Gems &gt; 15<br>
			<br>
			<strong>Există criterii de descalificare automată din competiție după cum urmează</strong><br>
			Suspendarea contului | Mai mult de 2 warn-uri pe server | Mai mult de 5 kick-uri pe server | Ban pentru mai mult de 3 zile<br>
			<br>
			</center>
			<br><center>Aceasta pagină se actualizează automat la câteva ore.<br><strong>Ultima actualizare: <font color="red"><?= GetDateUpdate() ?></font></strong></center></div>
			<hr>
		    <table class="bella">
		    <table><tbody>
			<th><strong><i class="fa fa-trophy"></i></strong></th>
			<th><strong>Nume</strong></th>
			<th><strong>Hours</strong></th>
			<th><strong>Stunt</strong></th>
			<th><strong>Drift</strong></th>
			<th><strong>Race</strong></th>
			<th><strong>Kills</strong></th>
			<th><strong>Respect</strong></th>
			<th><strong>Gems</strong></th>
			<th><strong>Points</strong></th>
			<th><strong>To Goal</strong></th>
			<th><strong>Last time online</strong></th>
			<th><strong>Player since</strong></th>
			<tr>
			    <?php
			    //--------------------------------------------------------------
				$Query = mysql_query("SELECT * FROM `Accounts` ORDER BY `PointsX2Month` DESC LIMIT 10"); 
				//--------------------------------------------------------------
				$rank = 0; 
				//--------------------------------------------------------------
				while($row = mysql_fetch_array($Query))
				{
				    $rank++;
				    //----------------------------------------------------------
					include("includes/arrays.php"); 
					//----------------------------------------------------------
					// Calculate To Goal
					//----------------------------------------------------------
					$_hmonth = $row['hoursMonth'];
					$_smonth = $row['StuntMonth'];
					$_dmonth = $row['DriftMonth'];
					$_rmonth = $row['RaceMonth'];
					$_gmonth = $row['GemsMonth'];
					$_rpmonth = $row['RespectPMonth'];
					$_npmonth = $row['RespectNMonth'];
					//----------------------------------------------------------
					$totalcount = 0;
					//----------------------------------------------------------
					if($_hmonth >= 99) $totalcount += 10;
					else if($_smonth >= 3499) $totalcount += 20;
					else if($_dmonth >= 7999) $totalcount += 10;
					else if($_rmonth >= 1999) $totalcount += 10;
					else if($_gmonth >= 30) $totalcount += 20;
					else if($_kmonth >= 2499) $totalcount += 10;
					else if($_rpmonth >= 149) $totalcount += 20;
					else $totalcount = 0;
					//----------------------------------------------------------
					if($rank == 1) $RankString = "<font color=#FF0000><i class='fa fa-star'></i></font>";
					else if($rank == 2) $RankString = "<font color=#FFCC00><i class='fa fa-star'></i></font>";
					else if($rank == 3) $RankString = "<font color=#05C81F><i class='fa fa-star'></i></font>";
					else $RankString = "<i class='fa fa-star'></i>";
				    //----------------------------------------------------------
					?>
					<tr>
						<td><?= $RankString ?></td>
						<td><font color="#FFCC00"><?= $row['Name'] ?></td></font>
                        <td><?= $row['HoursMonth'] ?></td>
                        <td><?= $row['StuntMonth'] ?></td>
                        <td><?= $row['DriftMonth'] ?></td>
                        <td><?= $row['RaceMonth'] ?></td>
                        <td><?= $row['KillsMonth'] ?></td>
                        <td><?= $row['RespectPMonth'] ?>/-<?= $row['RespectNMonth'] ?></td>
                        <td><?= $row['GemsMonth'] ?></td>
                        <td><?= $row['PointsX2Month'] ?></td>
                        <td><font color="#FF0000"><?= $totalcount ?>%</td></font>
                        <td><font color="#FFCC00"><?= $row['LastOn'] ?></td></font>
                        <td><font color="#FFCC00"><?= $row['RegisterDate'] ?></td></font>
					</tr>
					<?php
				}
				?>
			</tr>
			</table></tbody>
		</div>
	</div>
</div>

<?php require_once("a_Footer.php"); ?>