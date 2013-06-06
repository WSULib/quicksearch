<?php
//script to return results from A-Z database for Bento Box interface
$search_string = $_GET['search_string'];
$json = file_get_contents("http://www.lib.wayne.edu/tmp/BB_graham_testing/rest/resource_database.php?q=$search_string");
echo $json;
?>