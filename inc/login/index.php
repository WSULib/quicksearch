<?php include("password_protect.php"); ?>

<?php
INCLUDE "meta.php"; 
?>

<?php //grunt work, can be before rendering...
	//conntection to database
	$hostname = "mysqlphp.grahamhukill.com";   // eg. mysql.yourdomain.com (unique)
	$username = "ghukill";   // the username specified when setting-up the database
	$password = "Tomar8662";   // the specified when setting-up the database
	$database = "mysqlphp";   // the database name chosen when setting-up the database (unique)


	$link = mysql_connect($hostname,$username,$password);
	mysql_select_db($database) or die("Unable to select database");

	//gets and sets page number
	if (isset($_GET['pageno'])) {
	   $pageno = $_GET['pageno'];
		if ($pageno < 1){
			$pageno = 1;
			}
	} else {
	   $pageno = 1;
	}

	//gets number of rows
	$query = "SELECT count(*) FROM notepad";
	$result = mysql_query($query) or trigger_error("SQL", E_USER_ERROR);
	$query_data = mysql_fetch_row($result);
	$numrows = $query_data[0];
	
	//sets number of rows and LIMIT SQL clause
	$rows_per_page = 10;
	//$lastpage = ceil($numrows/$rows_per_page);
	$limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;

	//defines function
	function mysql_evaluate_array($query) {
		$result = mysql_query($query);
		$values = array();
		for ($i=0; $i<mysql_num_rows($result); ++$i)
		    array_push($values, mysql_result($result,$i));
		return $values;
		}

	//function usage
	$post_titles = mysql_evaluate_array("SELECT post_title FROM notepad ORDER BY timestamp DESC $limit");
	$notes = mysql_evaluate_array("SELECT note FROM notepad ORDER BY timestamp DESC $limit");
	$timestamps = mysql_evaluate_array("SELECT timestamp FROM notepad ORDER BY timestamp DESC $limit");
	$post_ids = mysql_evaluate_array("SELECT post_id FROM notepad ORDER BY timestamp DESC $limit");
	mysql_close($link);

	?>

<body>

<div id="body_bright">

<div id="container">
<?php
INCLUDE "banner.php"; 
?>

<div class="nav" id="top_nav">
<ul>
	<?php
	//navigation links
	$prevpage = $pageno-1;
   	echo "<li><a href='{$_SERVER['PHP_SELF']}?pageno=$prevpage'>previous</a></li> ";
	$nextpage = $pageno+1;
   	echo "<li><a href='{$_SERVER['PHP_SELF']}?pageno=$nextpage'>next</a></li>";
	?>
	</ul>	
</div>

<div id="main">
	<div id="notes">	
	
		<?php //actual rendering php code
	
		if ($numrows < 1){
			echo "<div class='each_note'>";
			echo 'Nothing to report....</br><-------- Try typing or entering something over there.';
			echo "</div>";
		}

		else {
			$count = 0; //use this count to iterate through other ones...
			foreach ($notes as $note){
				echo "<div class='each_note'>";
				echo "<h1 class='post_title'>$post_titles[$count]</h1>";
				echo "$note\n";
				echo "</div>";
				//echo "<div id='edit_post'><a href='edit.php?post_id=$post_ids[$count]'><img height = 15 src='images/tools.png'/></a></div>";
				echo "<div class='small_text' id='edit_post'>		
						$timestamps[$count] / <a href='edit.php?post_id=$post_ids[$count]'>edit</a></div>";
				echo "</br></br>"; //spacing
				echo "<div class='transp'></div>";
				$count = $count + 1;
				}
		}
		?>
	</div> <!--Closes notes -->
</div> <!--Closes main -->



<div id="sidebar">
<?php
INCLUDE "sidebar.php";
?>
</div>


<div class="nav" id="bottom_nav">
<ul>
	<?php
	//navigation links
	$prevpage = $pageno-1;
   	echo "<li><a 
href='{$_SERVER['PHP_SELF']}?pageno=$prevpage'>previous</a></li> ";
	$nextpage = $pageno+1;
   	echo "<li><a 
href='{$_SERVER['PHP_SELF']}?pageno=$nextpage'>next</a></li>";
	?>
	</ul>
</div>

</div><!--Closes container -->

</div><!--Closes body_bright -->
</body>
</html>
