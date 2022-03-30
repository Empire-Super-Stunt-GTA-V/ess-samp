<?php 
ob_start(); 
require_once("includes/config.php"); 
CheckMaintenance($under_maintenance);
?>
<!DOCTYPE html>
<html class="no-js">
    
    <script type="text/javascript">
    var vglnk = {key: '8653c99d85908e3299367e4fefc38304'};
    (function(d, t) {
        var s = d.createElement(t);
            s.type = 'text/javascript';
            s.async = true;
            s.src = '//cdn.viglink.com/api/vglnk.js';
        var r = d.getElementsByTagName(t)[0];
            r.parentNode.insertBefore(s, r);
    }(document, 'script'));
</script>

	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<?php 
			$totallogs = number_format(mysql_num_rows(mysql_query("SELECT * FROM `Logs`")));
			$totalbans = number_format(mysql_num_rows(mysql_query("SELECT * FROM `Bans`")));
			$totalplayers = mysql_num_rows(mysql_query("SELECT * FROM `Accounts` WHERE `LoggedIn` = 1")); 
			$totaladmins = mysql_num_rows(mysql_query("SELECT * FROM `Accounts` WHERE `Level` < 1")); 
		?>
		
		<meta name="description" content="<?= $ucp_meta_description ?>">
		<meta name="author" content="<?= $author ?>">
		<meta name="robots" content="index, follow">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<style type="text/css">
		
			.messagebox{
			position:auto;
			width:auto;
			margin-left:30px;
			border:1px solid #c93;
			background:#ffc;
			padding:3px;
			}
			.messageboxok{
			position:auto;
			width:auto;
			margin-left:30px;
			border:1px solid #349534;
			background:#C9FFCA;
			padding:3px;
			color:#008000;
			
			}
			.messageboxerror{
			position:auto;
			width:auto;
			margin-left:30px;
			border:1px solid #CC0000;
			background:#F7CBCA;
			padding:3px;
			color:#CC0000;
			}

		</style>
		<link href="/stunt/assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="/stunt/assets/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<link href="/stunt/assets/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
		<link href="/stunt/assets/styles.css" rel="stylesheet" media="screen">	
		<link href="/stunt/assets/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">
		<link href="/stunt/assets/fontawesome-all.min.css" rel="stylesheet" media="screen">
		<link href="/stunt/assets/fa-svg-with-js.min.css" rel="stylesheet" media="screen">
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', 'UA-60512324-2', 'auto');
			ga('send', 'pageview');
		</script>
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->	
		<script src="<?= $domainname ?>/assets/modernizr-2.6.2-respond-1.1.0.min.js"></script>
	</head>
	<head>
	<script data-ad-client="ca-pub-4300900783272679" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	</head>
	<style>
	  hr
	  {
		padding: 1px;
		margin: 4px; 	
	  }
	</style>
	<!-- ::: NAVIGATION BARS ::: -->
	<style>
	.fixed-nav-bar 
	{
	  position: fixed;
	  top: 0;
	  left: 0;
	  z-index: 9999;
	  width: 100%;
	  height: 50px;
	}
	</style>
	<body>
	<br><br><br><br>
	<nav class="fixed-nav-bar">
	<div id="branding" class="clearfix" style="fixed-nav-bar" align="center">
    <ul class="ipsList_inline" id="community_app_menu">
        
    <li id="nav_menu_22">
    <a href="<?=$domainname?>" title="Go to Homepage"><img src="<?= $domainname ?>/images/hbuttons/home-button.png" width="50"></a>
	</li><li id="nav_menu_22">
	<a id="nav_menu_22_trigger" href="/forums" title="Go to Forums"><img src="<?= $domainname ?>/images/hbuttons/forum-button.png" width="50"> </a>
	</li>
	
	<li id="nav_menu_18">
	    <div class="dropdown">
          <a id="nav_menu_18_trigger" href="<?=$domainname?>/account.php" title="" class=""><img src="<?= $domainname ?>/images/hbuttons/playerpanel-button.png" width="77"> <span class="dropdownIndicator"></span></a>
          <div class="dropdown-content boxShadow" style="position: fixed;" align="left">
            <a href="<?=$domainname?>/account.php" style="z-index: 10000;">My Account</a>
            <a href="<?=$domainname?>/playerstats.php" style="z-index: 10000;">Online Player Stats</a>
            <a href="<?=$domainname?>/recover.php" style="z-index: 10000;">Recover Account</a>
          </div>
        </div>
	</li>
				
	<li id="nav_menu_16">
	<a id="nav_menu_16_trigger" href="<?=$domainname?>/top.php" title="Top Gangs, Admins, Players and more!"><img src="<?= $domainname ?>/images/hbuttons/top-button.png" width="50"> </a>
	</li>
				
	<li id="nav_menu_8">
	<a id="nav_menu_8_trigger" href="<?=$domainname?>/logs.php" title=""><img src="<?= $domainname ?>/images/hbuttons/logs-button.png" width="50"></a>
	</li>
    
    <li id="nav_menu_30">
    <a id="nav_menu_30_trigger" href="<?=$domainname?>/admins.php" title="Go to Admins page"><img src="<?= $domainname ?>/images/hbuttons/admins-button4.png" width="50"></a>
    </li>
    
    <li id="nav_menu_31">
    <a id="nav_menu_31_trigger" href="<?=$domainname?>/clans.php" title="Go to Clans page"><img src="<?= $domainname ?>/images/hbuttons/clans-button.png" width="50"></a>
    </li>
    
    <li id="nav_menu_32">
    <a id="nav_menu_32_trigger" href="<?=$domainname?>/gangs.php" title="Go to Gangs Page"><img src="<?= $domainname ?>/images/hbuttons/gangs-button.png" width="50"></a>
    </li>
    
    <li id="nav_menu_33">
    <a id="nav_menu_33_trigger" href="<?=$domainname?>/shop.php" title="Go to Shop"><img src="<?= $domainname ?>/images/hbuttons/shop-button2.png" width="50"></a>
    </li>
    
    <li id="nav_menu_34">
    <a id="nav_menu_34_trigger" href="<?=$domainname?>/banlist.php" title="Go to UnBan"><img src="<?= $domainname ?>/images/hbuttons/unban-button.png" width="50"></a>
    </li>
    
    <!--<li id="nav_menu_35">
    <a id="nav_menu_35_trigger" href="<?=$domainname?>/account" title="Go to Gifts"><img src="<?= $domainname ?>/images/hbuttons/gifts-button.png" width="50"></a>
    </li>-->
    
    <li id="nav_menu_36">
    <a id="nav_menu_36_trigger" href="<?=$domainname?>/potm.php" title="Go to Player of the Month competition"><img src="<?= $domainname ?>/images/hbuttons/potm-button2.png" width="50"></a>
    </li>
    
	<?php 
	if(isset($_COOKIE['sessionID'])) 
	{					
		//CheckBanned($userplayer);									
		$getskin = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$userplayer'");								
		while($row = mysql_fetch_array($getskin))
		{
			$gang = $row["GangID"];
			$mylevel = $row["RconType"];
			if($gang != 0) $skin = $row["GangSkin"];
			else $skin = $row["FavSkin"];
		}
	} 
	?>		
	</center>
	</div>
	</nav>
	</ul>
	</body>
    <center>
	<p>
        <a href="/forums" title="Go to community index" rel="home" accesskey="1">
        <img src="https://i.imgur.com/LoCOHrc.png" alt="logo" style="width:300px;"></a>
    </p>
	<br>
    <div class="max_header_bi" style="display:block";>
	
    <div id="board_header_block2" style="display:inline-block; width:1170px; height:120px; margin-right:auto; margin-top: -12px; margin-bottom:7px;" class="block_adblackh">
    
    <div style="height: 95px; background: url(/stunt/images/mtab-box.png); border: 2px solid #FF9900; border-radius: 5px; padding: 10px;">
	<table border="0">
	<tbody>
		<tr>
			<td><img src="/stunt/images/ro-flag2.png" width ="32"></td>
			<td><strong>
                <strong>Notificare importantă!<br>
                Vă recomandăm să adăugați în SA-MP la favorite în locul IP-ului, adresa: <font color="#FFCC00">SAMP.ESS-RO.COM:7777</font></strong>
			</td>
		</tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
			<td><img src="/stunt/images/uk-flag2.png" width ="32"></td>
			<td><strong>Important notification!<br>
             We recomand to add the following address in your SA-MP favorites instead of the IP: <font color="#FFCC00">SAMP.ESS-RO.COM:7777</font></strong>
			</td>
		</tr>
	</tbody>
	</table>
	</div>
    
    </div>
	</div>
<?php include("assets/styles.php"); ?> 
	