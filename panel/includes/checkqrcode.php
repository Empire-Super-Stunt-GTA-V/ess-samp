<?php 
require_once("Authenticator.php");
$Authenticator = new Authenticator();
require_once("config.php");
$user = isset($_GET['user']) ? $_GET['user'] : '';
$code = isset($_GET['code']) ? $_GET['code'] : '';
if($user && $code)
{
	$QResult = mysql_query("SELECT * FROM `Accounts` WHERE `Name` = '$user'");
	$row = mysql_fetch_array($QResult);
	$secret = $row['TwoFactAuthSecret'];
	$checkResult = $Authenticator->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance
	if($checkResult) { print("1"); }
	else { print("0"); }
}