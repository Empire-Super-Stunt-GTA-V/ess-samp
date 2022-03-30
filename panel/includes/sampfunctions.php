<?php
require_once("config.php");
$function = isset($_GET['function']) ? $_GET['function'] : '';
if($function == "ipget")
{
	$ip = isset($_GET['ip']) ? $_GET['ip'] : '';
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	if($ip != "")
	{
		$country = "Unknown"; $city = "Unknown";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://ipinfo.io/$ip/json");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$ip_data_in = curl_exec($ch);
		curl_close($ch);
		
		$ip_data = json_decode($ip_data_in,true);
		$ip_data = str_replace('&quot;', '"', $ip_data);
		
		if($ip_data && $ip_data['country'] != null) { $country = $ip_data['country']; }
		if($ip_data && $ip_data['city'] != null) { $city = $ip_data['city']; }

	}
	$city = str_replace(array("ş","ţ","ă","î","â"),array("s","t","a","i","a"),$city);
	if($type == "") { ?> Error (try to put 'type' after)<?php }
	else if($type == 1) { ?><?=$country?><?php }
	else if($type == 2) { ?><?=$city?><?php }
}
else if($function == "detailsdb")
{
	$query = mysql_query("SELECT * FROM `ServerCFG`");
	while($row = mysql_fetch_array($query)) { $serverip = $row["ServerIP"]; }
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	if($ipaddress == $serverip)
	{
		$param = isset($_GET['param']) ? $_GET['param'] : '';
		if($param == "host") { ?><?=$db_host?><?php }
		else if($param == "user") { ?><?=$db_user?><?php }
		else if($param == "password") { ?><?=$db_pass?><?php }
		else if($param == "database") { ?><?=$db_name?><?php }
		else { ?>Nothing... Please verify that you put 'param' in url <?php }
	}
	else { ?> Sorry... but your IP are not eligible for this!<br>If you are the admin.. put server ip in database -> ServerCFG -> IP<?php }
}
?>