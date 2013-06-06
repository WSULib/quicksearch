<?php 

// Display the Basic Search by default
include('basic_search.php');
if(isset($_SESSION)){
    session_destroy();
}
session_start();
$_SESSION = array();
?>
