<?php
require_once("a_Header.php");

$tablename = "Logs";
$targetpage = "";

?>
<title>Logs</title>

<?php
	
	if($_GET['page'] == "") { $page = 1; } 
	else { $page = $_GET['page']; }
	
	$view = $_GET['view']; 
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	//--------------------------------------------------------------------------
	if($view == 0)
	{
		if($type == "") $string = "Cele mai recente log-uri!";
		else if($type == 1) $string = "<font color='#FF0000'>Change Name log</font>!";
		else if($type == 2) $string = "<font color='#FF0000'>Trade log</font>!";
		else if($type == 3) $string = "<font color='#FF0000'>Warn log</font>!";
		else if($type == 4) $string = "<font color='#FF0000'>Buy VIP log</font>!";
		else if($type == 5) $string = "<font color='#FF0000'>Ban log</font>!";
		else if($type == 6) $string = "<font color='#FF0000'>Kick log</font>!";
		else $string = "<font color='#FF0000'>Unknown log</font>!";
	}
	else if($view >= 1) $string = "Log<font color='#FF0000'> #$view</font>!";
	//--------------------------------------------------------------------------
	if($view == 0) $divclassEx = "<hr>
								  <div class='blue-box'><center>Pentru a cauta in log-uri o informatie ce te intereseaza, acceseaza <a href='?type=search'>functia de cautare</a>!</center></div>
								  <hr>";
    ?>
	<center>
		<div class="main-middle">
		<div class="ex">
		    <?php
		    if($type != 'search')
		    {
		        ?>
				<?php DisplayHeader($userplayer, $string);?>
		        <?= $divclassEx ?>
		        <?php
		    }
		    ?>
		<table class="bella">
	<?php
	function get_type_name($type)
	{
		if($type == 1) $asd = "Change Name log"; $typ = 1;
		if($type == 2) $asd = "Trade log"; $typ = 2;
		if($type == 3) $asd = "Warn log"; $typ = 3;
		if($type == 4) $asd = "BuyVIP log"; $typ = 4;
		if($type == 5) $asd = "Ban log"; $typ = 5;
		if($type == 6) $asd = "Kick log"; $typ = 6;
		return $asd;
	}
	$limit = (($page * 20) - 20);
	if($view == 0)
	{
		if($type == "")
		{	
		    require_once("includes/pagination.php"); 
		    ?>
		    <th>Type</th>
            <th>Date</th>
	        <th>Log</th>
	        <?php
			$Query = mysql_query("SELECT * FROM `Logs` WHERE `ID` > '0' ORDER BY `ID` DESC LIMIT $limit, 20");
			while($row = mysql_fetch_array($Query))
			{
			?>
				<tr>
					<td><a href="?type=<?= $row["Type"] ?>&page=1"><font color="#FF0000"><i class="fa fa-edit"></i></font> <font color="#FFFFFF"><?= get_type_name($row["Type"]) ?></font></td>
					<td><a href="?view=<?= $row["ID"] ?>"><font color="#FFCC00"><i class="far fa-clock"></i></font> <font color="#FFFFFF"><?= $row["Date"]; ?> at <?= $row["Time"]; ?></font></td>
					<td><?= $row["Log"]; ?></td>
					
				</tr>
			<?php
			} 
			?>
			</table>
			<br>
			<?= $output ?>
			<br>
			<?php
		}
		else if($type == 'search')
		{
		    if(isset($_POST['_clicked']))
		    {
	            $whatsearch = $_POST['_what'];
		        ?>
				<?php DisplayHeader($userplayer, $whatsearch);?>
    		    <hr>
    		    <div class="blue-box"><center>Pe aceasta pagina sunt afisate cele mai recente 100 de log-uri pe baza cautarii tale!</center></div>
    		    <hr>
		        <th>Type</th>
		        <th>Date</th>
		        <th>Log</th>
		        <?php
		        $Query = mysql_query("SELECT * FROM `Logs` WHERE Log LIKE '%$whatsearch%' ORDER BY `ID` DESC LIMIT 100"); 
				//------------------------------------------------------------------------
				if(mysql_num_rows($Query) != 0)
				{
					while($row = mysql_fetch_array($Query)) 
					{
					    ?>
					    <tr>
            				<td><a href="?type=<?= $typ ?>&page=1"><font color="#FF0000"><i class="fa fa-edit"></i></font> <font color="#FFFFFF"><?= get_type_name($row["Type"]) ?></font></td>
            				<td><a href="?view=<?= $row["ID"] ?>"><font color="#FFCC00"><i class="far fa-clock"></i></font> <font color="#FFFFFF"><?= $row["Date"]; ?> at <?= $row["Time"]; ?></font></td>
            				<td><?= $row["Log"]; ?></td>
            				
            			</tr>
            			<?php
					}
				}
				else if(mysql_num_rows($Query) == 0)
				{
				    ?>
				    <tr>
				        <td>No existing logs.</td>
				        <td></td>
				        <td></td>
			        </tr>
			        <?php
				}
		    }
		    else
		    {
    		    ?>
    		    <?php DisplayHeader($userplayer, "Cautare");?>
    		    <hr>
    		    <div class="blue-box"><center>Pe aceasta pagina vor fi afisate cele mai recente 100 de log-uri pe baza cautarii tale!</center></div>
    		    <hr>
    		    <form action="" method="POST"><center>
    			    <center>
    			    <strong>Ce anume vrei sa cauti ?</strong><br>
    			    <input type="text" STYLE="background-color: #252525;" value="" name="_what" class="form_field"><br>
    			    <input type="submit" value="Cauta" name="_clicked" class="button">
                    </center>
                </center></form>
    		    <?php
		    }
		}
		else if($type >= 1)
		{
		    require_once("includes/pagination.php"); 
		    ?>
		    <th>Date</th>
	        <th>Log</th>
	        <?php
			$Query = mysql_query("SELECT * FROM `Logs` WHERE `Type` = '$type' ORDER BY `ID` DESC LIMIT $limit, 20");
			while($row = mysql_fetch_array($Query))
			{
			?>
				<tr>
					<td><font color="#FFCC00"><i class="far fa-clock"></i></font> <font color="#FFFFFF"><?= $row["Date"]; ?> at <?= $row["Time"]; ?></font></td>
					<td><?= $row["Log"]; ?></td>
					
				</tr>
			<?php
			} 
			?>
			</table>
			<br>
			<?= $output ?>
			<br>
			<?php
		}
	}
	else if($view >= 1)
	{
		$Query = mysql_query("SELECT * FROM `Logs` WHERE `ID` = '$view'");
		while($row = mysql_fetch_array($Query))
		{
		?>
			<hr>
			<tr>
				<td><a href="?type=<?= $typ ?>&page=1"><font color="#FF0000"><i class="fa fa-edit"></i></font> <font color="#FFFFFF"><?= get_type_name($row["Type"]) ?></font></td>
				<td><font color="#FFCC00"><i class="far fa-clock"></i></font> <font color="#FFFFFF"><?= $row["Date"]; ?> at <?= $row["Time"]; ?></font></td>
				<td><?= $row["Log"]; ?></td>
				
			</tr>
			</table>
			<hr>
		<?php
		}
	}
	?>
	</table>
</div>
</div>
<?php 
require_once("a_Footer.php"); 
?>