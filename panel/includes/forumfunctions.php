<?php 
require_once("config.php"); 
$type = isset($_GET['type']) ? $_GET['type'] : '';
if($type == 1) { return print("samp.ess-ro.com:7777"); }
if($type == 2) { return print(GetServerIP()); }
if($type == 3) { return print($PlayersOnline); }
if($type == 4) { return print($ServerSlots); }
if($type == 5) { return print(GetCountOfTodayPeak()); }
if($type == 6) { return print($TotalPlayers); }
if($type == 7) { return print(GetAvaragePlayers()); }
if($type == 8) { return print($_SESSION['ServerNameLogged']); }
?>
