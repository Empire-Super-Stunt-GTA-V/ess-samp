<?php
    $output = "";	
	$limit = 20;
	//++++++++++++++++++++++++++++++++++++++++++++++++++++
    $query = "SELECT COUNT(*) as num FROM $tablename";
    $total_pages = mysql_fetch_array(mysql_query($query));
    $total_pages = $total_pages['num'];
	//++++++++++++++++++++++++++++++++++++++++++++++++++++
    $stages = 3;
    if (!isset($_GET['page'])) { $_GET['page'] = 0;} else {$page = $_GET['page'];}
    $page = mysql_real_escape_string($_GET['page']);
    if($page) { $start = ($page - 1) * $limit; }
	else { $start = 0; }
	//++++++++++++++++++++++++++++++++++++++++++++++++++++
	if (!isset($_GET['type'])) { $_GET['type'] = 0;} else {$type = $_GET['type'];}
	$type = mysql_real_escape_string($_GET['type']);
	//++++++++++++++++++++++++++++++++++++++++++++++++++++
	$view = $_GET['view']; 
	//++++++++++++++++++++++++++++++++++++++++++++++++++++
    // Initial page num setup
    if ($page == 0){$page = 1;}
	$prev = $page-1;
	$next = $page+1;
    $lastpage = ceil($total_pages/$limit);
    $LastPagem1 = $lastpage - 1;        
    $paginate = '';
	//++++++++++++++++++++++++++++++++++++++++++++++++++++
    $limited = $page+4;
	//++++++++++++++++++++++++++++++++++++++++++++++++++++
	if($view == 0)
	{
		if($type == 0)
		{
			for ($counter = $page; $counter <= $limited; $counter++)
			{
				if($page >= 2) $string1 = "<a href='$targetpage?page=$prev'> <span class='button'>Previous</span></a>";
				if($page < $lastpage) $string2 = "<a href='$targetpage?page=$next'> <span class='button'>Next</span></a>";
				//++++++++++++++++++++++++++++++++++++++++++++++++
				if($counter == $page) { if($page < $lastpage) $paginate.= "<a href='$targetpage?page=$counter'> <span class='button'><font color='#33AA33'>$counter</font></span></a>"; }
				else 
				{ 
					if($page < $lastpage) $paginate.= "<a href='$targetpage?page=$counter'> <span class='button'>$counter</span></a>"; 
					else $page = $lastpage;
				}
			}
		}
		else if($type >= 1)
		{
			for ($counter = $page; $counter <= $limited; $counter++)
			{
				if($page >= 2) $string1 = "<a href='$targetpage?type=$type&page=$prev'> <span class='button'>Previous</span></a>";
				if($page < $lastpage) $string2 = "<a href='$targetpage?type=$type&page=$next'> <span class='button'>Next</span></a>";
				//++++++++++++++++++++++++++++++++++++++++++++++++
				if($counter == $page) { if($page < $lastpage) $paginate.= "<a href='$targetpage?type=$type&page=$counter'> <span class='button'><font color='#33AA33'>$counter</span></a>"; }
				else 
				{ 
					if($page < $lastpage) $paginate.= "<a href='$targetpage?type=$type&page=$counter'> <span class='button'>$counter</span></a>"; 
					else $page = $lastpage;
				}
			}
		}
		$output = "<center>$string1 $paginate $string2
			<br><br>
			<a href='$targetpage?type=1&page=1' class='button'>Change Name log</a>
			<a href='$targetpage?type=2&page=1' class='button'>Trade log</a>
			<a href='$targetpage?type=3&page=1' class='button'>Warn log</a>
			<a href='$targetpage?type=4&page=1' class='button'>Buy VIP log</a>
			<a href='$targetpage?type=5&page=1' class='button'>Ban log</a>
			<a href='$targetpage?type=6&page=1' class='button'>Kick log</a>
		   </center>";
	}
?>