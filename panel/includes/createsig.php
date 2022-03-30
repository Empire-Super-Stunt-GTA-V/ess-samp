<?php
require_once("config.php");

$var = mysql_real_escape_string($_GET["id"]);
$var2 = mysql_real_escape_string($_GET["style"]);
$trimmed = trim($var);
$trimmed2 = trim($var2);

$limit=1;

if ($trimmed == "") { echo "No username found in URL"; exit ; }
if ($trimmed2 == "") { echo "No style found in URL"; exit ; }
if (!isset($var)) { echo "<p>We dont seem to have a search parameter!</p>"; exit ; }
if (!isset($var2)) { echo "<p>We dont seem to have a search parameter!</p>"; exit ; }

$query = "SELECT * FROM `Accounts` WHERE `ID` = '$trimmed'";

$numresults=mysql_query($query);
$numrows=mysql_num_rows($numresults);

if ($numrows == 0) { echo "User was not found in our database"; exit; }
if (empty($s)) $s=0;

  $query .= " limit $s,$limit";
  $result = mysql_query($query) or die("Couldn't execute query");

    while ($row= mysql_fetch_array($result))
	{
	  $nume = $row["Name"];
	  $level = $row["Level"];
	  $kspree = $row['KillingSpree'];
	  $bkspree = $row['BestKillings'];
	  $clan = $row['ClanID'];
	  $vip = $row["VIP"];
	  $cash = $row["Cash"];
	  $kills = $row["Kills"];
	  $killerrank = CheckRank($kills, "Kills");
	  $deaths = $row["Deaths"];
	  $hours = $row["Hours"];
	  $gid = $row['GangID'];
	  $driftp = $row['DriftScore'];
	  $stuntp = $row['StuntScore'];
	  $racep = $row['RaceScore'];
	  $positive = $row["Positive"];
	  $negative = $row["Negative"];
	  $score = $row["Score"];
	  $coins = $row["Coins"];
	  $note = $row["StatsNote"];
	  $regd = $row["RegisterDate"];
	  $last = $row["LastOn"];
	  $prop_ = $row["Property"];
	  $on = $row["LoggedIn"];
	  $c4 = $row["C4"];
	  $house_ = $row["HouseID"];
	}
	if($prop_ == "0") $prop = "No";
	else $prop = "Yes";

	if($on == "1") $status = "Online";
	else $status = "Offline";

	if($house_!="0") $house = "Yes";
	else if($house_=="0") $house = "No";

	if ( $gid == 0 ) $pgang = "None";
	else 
	{
		$gangname2 = mysql_query("SELECT `GangName` FROM `Gangs` WHERE `ID` = '$gid'");
		$pgang = mysql_result($gangname2, 0, "GangName");
	}
	
	if($clan == 0) $pclan = "None";
	else 
	{
		$clanname2 = mysql_query("SELECT `Name` FROM `Clans` WHERE `ID` = '$clan'");
		$pclan = mysql_result($clanname2, 0, "Name");
	}
	$respect = "+$positive/-$negative";

if($trimmed2 == 1)
{
	$font_file 	= 'fonts/csm.ttf';
	$font_size  	= 10 ;
	$font_color 	= '#33CCFF';
	$image_file 	= "signature1.png";
	$mime_type 		= 'image/png' ;

	if(!function_exists('ImageCreate')) { echo "Error: Server does not support PHP image generation"; exit ; }
	if(!is_readable($font_file)) { echo "Error: The server is missing the specified font." ; exit ; }

	$font_rgb = hex_to_rgb($font_color) ;
	
	$image =  imagecreatefrompng($image_file);

	if(!$image) { echo "Error: The server could not create this image."; exit ; }

	$font_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);

    imagettftext($image, $font_size, 0, "200",  "25", $font_color, $font_file, "$nume (Note $note/10)");
    imagettftext($image, $font_size, 0, "213",  "56", $font_color, $font_file, "$level");
    imagettftext($image, $font_size, 0, "196",  "70", $font_color, $font_file, "$vip");
    imagettftext($image, $font_size, 0, "174",  "84", $font_color, $font_file, "$hours");
    imagettftext($image, $font_size, 0, "166",  "98", $font_color, $font_file, "$coins");
    imagettftext($image, $font_size, 0, "175",  "112", $font_color, $font_file, "$cash$");
    imagettftext($image, $font_size, 0, "187",  "125", $font_color, $font_file, "$respect");
    imagettftext($image, $font_size, 0, "161",  "140", $font_color, $font_file, "$kills");
    imagettftext($image, $font_size, 0, "180",  "155", $font_color, $font_file, "$deaths");
    imagettftext($image, $font_size, 0, "216",  "168", $font_color, $font_file, "$bkspree");
    imagettftext($image, $font_size, 0, "203",  "182", $font_color, $font_file, "$killerrank");
    
    imagettftext($image, $font_size, 0, "318",  "112", $font_color, $font_file, "$house");
    imagettftext($image, $font_size, 0, "335",  "98", $font_color, $font_file, "$prop");
    
    imagettftext($image, $font_size, 0, "353",  "56", $font_color, $font_file, "$racep");
    imagettftext($image, $font_size, 0, "359",  "84", $font_color, $font_file, "$stuntp");
    imagettftext($image, $font_size, 0, "356",  "70", $font_color, $font_file, "$driftp");
    
    imagettftext($image, $font_size, 0, "305",  "140", $font_color, $font_file, "$pclan");
    imagettftext($image, $font_size, 0, "310",  "155", $font_color, $font_file, "$pgang");
    imagettftext($image, $font_size, 0, "330",  "168", $font_color, $font_file, "$last");

	header('Content-type: ' . $mime_type) ;
	ImagePNG($image) ;

	ImageDestroy($image);
	exit;
}
if($trimmed2 == 2)
{
	$font_file 	= 'fonts/LEMONMILK.OTF';
	$font_file2 = 'fonts/COMICBD.TTF';
	$font_size  	= 10 ;
	$font_color 	= '#00FF00';
	$font_color2	= "#FF0000";
	$image_file 	= "PlayerStats2.png";
	$mime_type 		= 'image/png' ;
	
	if(!function_exists('ImageCreate')) { echo "Error: Server does not support PHP image generation"; exit ; }
	if(!is_readable($font_file)) { echo "Error: The server is missing the specified font." ; exit ; }
	
	$font_rgb = hex_to_rgb($font_color);
	$font_rg = hex_to_rgb($font_color2);
	
	$image = imagecreatefrompng($image_file);
	
	if(!$image) { echo "Error: The server could not create this image."; exit ; }
	
	$font_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
	$font_color23 = ImageColorAllocate($image, $font_rg['red'],$font_rg['green'],$font_rg['blue']);	
	
	if($on == 1) 
	{
		imagettftext($image, $font_size, 0, "404",  "102", $font_color, $font_file, "Online");
	}
	else 
	{
		imagettftext($image, $font_size, 0, "404",  "102", $font_color, $font_file, "Offline");
	}
	imagettftext($image, $font_size, 0, "110",  "25", $font_color, $font_file2, "$nume");
	imagettftext($image, $font_size, 0, "185",  "52", $font_color, $font_file, "$level");
	imagettftext($image, $font_size, 0, "168",  "69", $font_color, $font_file, "$vip");
	imagettftext($image, $font_size, 0, "150",  "85", $font_color, $font_file, "$hours");
	imagettftext($image, $font_size, 0, "284",  "52", $font_color, $font_file, "$kills");
	imagettftext($image, $font_size, 0, "294",  "69", $font_color, $font_file, "$deaths");
	imagettftext($image, $font_size, 0, "288",  "85", $font_color, $font_file, "$house");
	imagettftext($image, $font_size, 0, "307",  "102", $font_color, $font_file, "$prop");
	imagettftext($image, $font_size, 0, "148",  "118", $font_color, $font_file, "$coins");
	imagettftext($image, $font_size, 0, "410",  "52", $font_color, $font_file, "$respect");
	imagettftext($image, $font_size, 0, "153",  "102", $font_color, $font_file, "$cash$");
	imagettftext($image, $font_size, 0, "289",  "136", $font_color, $font_file, "$pgang");
	imagettftext($image, $font_size, 0, "286",  "118", $font_color, $font_file, "$pclan");
	imagettftext($image, $font_size, 0, "163",  "136", $font_color, $font_file, "$last");
	imagettftext($image, $font_size, 0, "400",  "69", $font_color, $font_file, "$regd");
	imagettftext($image, $font_size, 0, "430",  "85", $font_color, $font_file, "$note/10");
	
	header('Content-type: ' . $mime_type) ;
	ImagePNG($image);
	
	ImageDestroy($image);
	exit;
}
if($trimmed2 == 3)
{
	$font_file 	= 'fonts/csm.ttf';
	$font_size  	= 12 ;
	$font_color 	= '#00bfff';
	$font_color2 	= '#ffa500';
	$image_file 	= "signature3.png";
	$mime_type 		= 'image/png' ;

	if(!function_exists('ImageCreate')) { echo "Error: Server does not support PHP image generation"; exit ; }
	if(!is_readable($font_file)) { echo "Error: The server is missing the specified font." ; exit ; }

	$font_rgb = hex_to_rgb($font_color) ;
	$font_rgb2 = hex_to_rgb($font_color2) ;
	
	$image =  imagecreatefrompng($image_file);

	if(!$image) { echo "Error: The server could not create this image."; exit ; }

	$font_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
	$font_color2 = ImageColorAllocate($image,$font_rgb2['red'],$font_rgb2['green'],$font_rgb2['blue']);
    
    imagettftext($image, 15, 0, "10",  "90", $font_color2, $font_file, "$nume");
    
    imagettftext($image, $font_size, 0, "185",  "30", $font_color, $font_file, "$level");
    imagettftext($image, $font_size, 0, "185",  "45", $font_color, $font_file, "$vip");
    imagettftext($image, $font_size, 0, "185",  "60", $font_color, $font_file, "$hours");
    imagettftext($image, $font_size, 0, "185",  "75", $font_color, $font_file, "$coins");
    imagettftext($image, $font_size, 0, "185",  "90", $font_color, $font_file, "$kills");
    imagettftext($image, $font_size, 0, "185",  "105", $font_color, $font_file, "$deaths");
    imagettftext($image, $font_size, 0, "185",  "120", $font_color, $font_file, "$pgang");
    
    
    
    imagettftext($image, $font_size, 0, "370",  "30", $font_color, $font_file, "$stuntp");
    imagettftext($image, $font_size, 0, "370",  "45", $font_color, $font_file, "$driftp");
    imagettftext($image, $font_size, 0, "370",  "60", $font_color, $font_file, "$racep");
    imagettftext($image, $font_size, 0, "370",  "75", $font_color, $font_file, "$house");
    imagettftext($image, $font_size, 0, "370",  "90", $font_color, $font_file, "$prop");
    imagettftext($image, $font_size, 0, "370",  "105", $font_color, $font_file, "$respect");
    imagettftext($image, $font_size, 0, "370",  "120", $font_color, $font_file, "$pclan");

	header('Content-type: ' . $mime_type) ;
	ImagePNG($image) ;

	ImageDestroy($image);
	exit;
}
	function hex_to_rgb($hex)
	{
		if(substr($hex,0,1) == '#') $hex = substr($hex,1) ;
		if(strlen($hex) == 3) $hex = substr($hex,0,1) . substr($hex,0,1) . substr($hex,1,1) . substr($hex,1,1) . substr($hex,2,1) . substr($hex,2,1) ;

		$rgb['red'] = hexdec(substr($hex,0,2)) ;
		$rgb['green'] = hexdec(substr($hex,2,2)) ;
		$rgb['blue'] = hexdec(substr($hex,4,2)) ;

		return $rgb ;
	}
?>