<?php 
require_once("includes/config.php"); 
if($userblacklist == 1)
{
	?>
	<title>Account Suspended</title>
	<strong>
	Sorry, but your account <font color="red"><?=$userplayer?></font> are suspended!<br>
	Suspended by <font color="red"><?=GetPlayerNameByID($userblacklistby)?></font> on <font color="red"><?=$userblacklistdate?></font><br>
	For more details, please contact the <font color="red">Support</font> team.
	</strong>
	<?php
}
else return header("Location: /home");
?>