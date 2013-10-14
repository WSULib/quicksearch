<?php
//script to return results from A-Z database for Bento Box interface
$search_string = $_GET['search_string'];
$json = file_get_contents("http://www.lib.wayne.edu/inc/dbs/resource_database_v2.php?q=$search_string");
echo $json;
?>