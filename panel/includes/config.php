<?php

//MySQL Config
$db_host    = 'host';
$db_user    = 'user';
$db_pass    = 'password';
$db_name    = 'databaseName';

error_reporting(0);

mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name);	

$db_error = mysql_errno();

if($db_error != 0) {
	Header("Location: https://www.ess-ro.com/stunt/error/?err=$db_error");
}	
error_reporting(1);

//UCP Config
$domainname = "http://www.ess-ro.com/stunt/";
$forum_address = "https://www.ess-ro.com/stunt/forums";
$ucp_version = "V1";
$ucp_meta_description = "Bine ai venit pe website-ul comunitatii Empire Super Stunt! Aici poti gasii toate informatiile care te intereseaza in legatura cu server-ul nostru de joc, cereri ...";
$ucp_name = "Empire Super Stunt";
$contact_address1 = "thejohnny77@yahoo.com";
$contact_address2 = "theghost@yahoo.com";
$ucp_name_copy = '<font color="0072FF">Empire</font> <font color="#FCDB00">Super</font> <font color="#FF0000">Stunt</font>';
$under_maintenance = "0"; // 1 = Maintenance ON | 0 = Maintenance OFF   
				   
//SAMP Server Config
$server_name = "Empire Super Stunt";
$samp_version = "0.3.7";
$maxserverslots = "100";
$author = "Johnny";
$author2 = "Ghost";

//Including another file
require("functions.php");
require("arrays.php");
?>