<?php require_once("a_Header.php"); ?>
<title><?= $ucp_name ?></title>
<div class="ex">
	<link href="/stunt/assets/Slider/js-image-slider.css" rel="stylesheet" type="text/css">
	  <script src="/stunt/assets/Slider/js-image-slider.js" type="text/javascript"></script>
	  <div style="float:right; width: 850px; padding-left: 5px; padding-right: 5px; padding-bottom: 1px;">
		<?php DisplayHeader($userplayer, "Empire Super Stunt Community");?>
		<hr>
		<div class="blue-box">
			<center>Bine ai venit pe website-ul comunitatii <strong>Empire Super Stunt</strong>! Aici poti gasii toate informatiile care te intereseaza in legatura cu server-ul nostru de joc, cereri unban, top-uri, log-uri, plangeri si reclamatii, tutoriale, moduri, si alte sute de utilizatori activi zi de zi cu care poti socializa intr-un mediu placut si relaxant!</center>
		</div>
		<hr>
			<div id="slider" style="background;">
				<img src="/stunt/images/Slider/1.jpg" alt="Du-te acum la party de la beach <font color='red'>/djs</font>!">
				<img src="/stunt/images/Slider/2.jpg" alt="Mape de roleplay la <font color='red'>/sf</font>!"></a>
				<img src="/stunt/images/Slider/3.jpg" alt="Castiga un turismo la 3 cirese  <font color='red'>/lv</font>!">
				<img src="/stunt/images/Slider/4.jpg" alt="Castiga coins & money la  <font color='red'>/jj</font>!">
				<img src="/stunt/images/Slider/5.png" alt="An old photo, but good <font color='red'>2018</font>!">
			</div>
      </div>
	  <div style="float:left; width: 280px; padding-left: 5px; padding-right: 5px;">
			<center><strong>Top 3 this month!</strong></center>
			<table class="mtab">
				<tbody></tbody>
				<colgroup><col width="40"></colgroup>
				<tbody>
					<tr>
						<td><a href="/stunt/gangs.php"><img src="/stunt/images/index-tg.png"></a></td>
						<td>
						1. <?=GetTopGang(1)?><br>
						2. <?=GetTopGang(2)?><br>
						3. <?=GetTopGang(3)?><br>
						</td>
					</tr>
					<tr>
						<td><a href="/stunt/admins.php"><img src="/stunt/images/index-ta.png"></a></td>
						<td>
						1. <?=GetTopPlayer(1, 1)?><br>
						2. <?=GetTopPlayer(1, 2)?><br>
						3. <?=GetTopPlayer(1, 3)?><br>
						</td>
					</tr>
					<tr>
						<td><a href="/stunt/top.php"><img src="/stunt/images/index-th.png"></a></td>
						<td>
						1. <?=GetTopPlayer(2, 1)?><br>
						2. <?=GetTopPlayer(2, 2)?><br>
						3. <?=GetTopPlayer(2, 3)?><br>
						</td>
					</tr>
					<tr>
						<td><a href="/stunt/top.php"><img src="/stunt/images/index-tk.png"></a></td>
						<td>
						1. <?=GetTopPlayer(3, 1)?><br>
						2. <?=GetTopPlayer(3, 2)?><br>
						3. <?=GetTopPlayer(3, 3)?><br>
						</td>
					</tr>
					<tr>
						<td><a href="/stunt/top.php"><img src="/stunt/images/index-ts.png"></a></td>
						<td>
						1. <?=GetTopPlayer(4, 1)?><br>
						2. <?=GetTopPlayer(4, 2)?><br>
						3. <?=GetTopPlayer(4, 3)?><br>
						</td>
					</tr>
					<tr>
						<td><a href="/stunt/top.php"><img src="/stunt/images/index-td.png"></a></td>
						<td>
						1. <?=GetTopPlayer(5, 1)?><br>
						2. <?=GetTopPlayer(5, 2)?><br>
						3. <?=GetTopPlayer(5, 3)?><br>
						</td>
					</tr>
					<tr>
						<td><a href="/stunt/top.php"><img src="/stunt/images/index-tr.png"></a></td>
						<td>
						1. <?=GetTopPlayer(6, 1)?><br>
						2. <?=GetTopPlayer(6, 2)?><br>
						3. <?=GetTopPlayer(6, 3)?><br>
						</td>
					</tr>
				</tbody>
			</table>
		<br>
		<center><strong>Player of the month</strong></center>
		<table class="mtab">
		    <colgroup><col width="40"></colgroup>
		    <tbody><tr>
					<td><font color="#FFCC00"><i class="fa fa-trophy fa-2x"></i></font></td>
					<td><strong><font color="red">#</font></strong> so far with<br><strong><font color="#FFCC00">#</font></strong> Points and <strong>#%</strong> to goal!<hr><a href="/potm.php">Check out the full list for this month!</a></td>
				</tr>
			</tbody>
		</table>
		<br>
		<center><strong>Server statistics</strong></center>
		<table class="mtab">
			<colgroup><col width="40"></colgroup>
			<tbody>
			<tr>
				<td><img src="/stunt/images/samp.png" width="32"></td>
				<td>
					samp.ess-ro.com | <font color="#FF0000"><?=GetServerIP();?></font><br><a href="samp://<?=GetServerIP();?>:7777">Connect</a> | <a href="/playerstats.php"><?=$PlayersOnline?> / <?=$ServerSlots?></a> | <font color="#FFCC00"><?=GetCountOfTodayPeak();?> today peak</font>
					<hr>
					Accounts: <font color="#FFCC00"><?=$TotalPlayers?></font> | Average: <font color="#FFCC00"><?=GetAvaragePlayers();?></font> online<br>
				</td>
			</tr>
			</tbody>
		</table>
		<!--
		<br>
		<div class='passprotect'>
            <img src='/stuntimages/protectpass.png' style='float:left;'>
            Important! Ai grija de contul tau! Un owner sau un alt admin nu iti va cere niciodata PAROLA contului tau! Daca cineva cu numele unui admin iti va cere parola, fii sigur ca acea persoana are intentii rele cu contul tau! Singurul loc unde este sigur sa iti pui parola este acest site si serverul nostru de SA-MP!
        </div>
        -->
	  </div>
	  <div style="padding-top: 30px; clear:both;"></div>
	  <table class="mtab">
			<tbody>
				<tr>
					<td>
						<div style="float: left; width: 40px;"><img src="/stunt/images/action-1.png" height="42"></div>
						<div style="float: right; width:74%;">
							<?=GetLastDonation();?></div>
					</td>
					<td>
						<div style="float: left; width: 26%;"><img src="/stunt/images/action-3.png" height="42"></div>
						<div style="float: right; width:74%;">
							<strong>#</strong><br>has won the race<br>
							<strong>#</strong> in <strong>x:xx</strong> minutes
						</div>
					</td>
					<td>
						<div style="float: left; width: 26%;"><img src="/stunt/images/action-3.png" height="42"></div>
						<div style="float: right; width:74%;">
							<strong>#</strong><br>has won the race<br>
							<strong>#</strong> in <strong>x:xx</strong> minutes
						</div>
					</td>
					<td>
						<div style="float: left; width: 26%;"><img src="/stunt/images/action-3.png" height="42"></div>
						<div style="float: right; width:74%;">
							<strong>#</strong><br>has won the race<br>
							<strong>#</strong> in <strong>x:xx</strong> minutes
						</div>
					</td>
					<td>
						<div style="float: left; width: 26%;"><img src="/stunt/images/action-3.png" height="42"></div>
						<div style="float: right; width:74%;">
							<strong>#</strong><br>has won the race<br>
							<strong>#</strong> in <strong>x:xx</strong> minutes
						</div>
					</td>
				</tr>
			</tbody>
	</table>          
	</div>
<?php require_once("a_Footer.php"); ?>