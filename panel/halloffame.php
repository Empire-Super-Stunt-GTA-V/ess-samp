<?php require_once("a_Header.php"); ?>
<title>Hall Of Fame</title>
<center>
<div class="main-middle">
	<div class="ex">
		<div class="bella">
			<?php DisplayHeader($userplayer, "Hall Of Fame");?>
		    <hr>
		    <br>
		    <font size="3"><font color="white"><font color="orange">Server Mananger</font><br><br>
			<?php
			$Query = mysql_query("SELECT * FROM `Accounts` WHERE `RconType` = 3"); 
			while($row = mysql_fetch_array($Query))
			{
				?>
				<strong><?=$row['Name']?></strong><br>
				<?php
			}
			?>
			</font></font><br>
		    <font size="3"><font color="white"><font color="orange">Server Support</font><br><br>
			<?php
			$Query = mysql_query("SELECT * FROM `Accounts` WHERE `RconType` = 2"); 
			while($row = mysql_fetch_array($Query))
			{
				?>
				<strong><?=$row['Name']?></strong><br>
				<?php
			}
			?>
			</font></font><br>
		    <font size="3"><font color="white"><font color="orange">Server Mapper</font><strong><br><br>Kalashnicov <br>and others in our community.</strong><br><br></font></font>
		    <font size="3"><font color="white"><font color="orange">Server Developer</font><strong><br><br>Johnny & Ghost_</strong><br><br></font></font>
		    <font size="3"><font color="white"><font color="orange">Website Developer</font><strong><br><br>Johnny & Ghost_</strong><br><br></font></font>
		    <br>
		    <hr>
		    <font size="2"><font color="white"><b>Aici sunt trecuti toti cei care au contribuit la dezvoltarea serverului si mentinerea lui 24/7.</font></b></font>
		    <hr>
	    </div>
	</div>
</div>
<?php require_once("a_Footer.php"); ?>