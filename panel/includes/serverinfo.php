<?php

require_once("SampQueryAPI.php");

$serverIP = "193.203.39.153";
$serverPort = 7777;

try
{
    $rQuery = new QueryServer( $serverIP, $serverPort );

    $aInformation = $rQuery->GetInfo( );
    $aServerRules = $rQuery->GetRules( );
    $aBasicPlayer = $rQuery->GetPlayers( );
    $aTotalPlayers = $rQuery->GetDetailedPlayers( );

    $rQuery->Close( );
}
catch (QueryServerException $pError)
{
    $status = 'Offline';
}
if(isset($aInformation) && is_array($aInformation))
{
	$hostname = $aInformation['Hostname'];
	$version = $aServerRules['version'];
	$time = $aServerRules['worldtime'];
	$mapname = $aInformation['Map'];
	$mode = $aInformation['Gamemode'];
	$status = $aInformation['Password'] ? "Passworded" : "Online";
	$players = $aInformation['Players'];
	$web = $aServerRules['weburl'];
	$maxplayers = $aInformation['MaxPlayers'];
}
	$font_file 		= "fonts/COMICBD.TTF";
	$font_size  	= 8 ;
	$font_color 	= "#00FF00";
	$image_file 	= "server_info2.png";
	$mime_type 		= "image/png";

	$font_rgb = hex_to_rgb($font_color) ;

	$image =  imagecreatefrompng($image_file);
	
	if(!$image) { echo ('Error: The server could not create this image.'); exit; }
	
	$font_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']) ;
	$image_width = imagesx($image);
	
imagettftext($image, $font_size, 0, "66",  "19", $font_color, $font_file, "$serverIP:$serverPort");
imagettftext($image, $font_size, 0, "59",  "35", $font_color, $font_file, "$players / $maxplayers");
imagettftext($image, $font_size, 0, "60",  "50", $font_color, $font_file, "$version");
imagettftext($image, $font_size, 0, "66",  "65", $font_color, $font_file, "$web");
imagettftext($image, $font_size, 0, "346",  "19", $font_color, $font_file, "$mode");
imagettftext($image, $font_size, 0, "337",  "34", $font_color, $font_file, "$mapname");
imagettftext($image, $font_size, 0, "352",  "50", $font_color, $font_file, "$status");
imagettftext($image, $font_size, 0, "375",  "66", $font_color, $font_file, "$time");
imagettftext($image, $font_size, 0, "125",  "90", $font_color, $font_file, "$hostname");

	header('Content-type: ' . $mime_type) ;
	ImagePNG($image) ;

	ImageDestroy($image);
	exit;

	function hex_to_rgb($hex) 
	{
		if(substr($hex,0,1) == '#') $hex = substr($hex,1) ;
		if(strlen($hex) == 3) 
		{
			$hex = substr($hex,0,1) . substr($hex,0,1) .
				   substr($hex,1,1) . substr($hex,1,1) .
				   substr($hex,2,1) . substr($hex,2,1) ;
		}
		if(strlen($hex) != 6) { echo('Error: Invalid color "'.$hex.'"'); exit; }
		$rgb['red'] = hexdec(substr($hex,0,2)) ;
		$rgb['green'] = hexdec(substr($hex,2,2)) ;
		$rgb['blue'] = hexdec(substr($hex,4,2)) ;
		//*********************************************
		return $rgb ;
	}
?>