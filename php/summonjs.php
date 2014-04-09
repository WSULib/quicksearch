<?php
require_once 'summon/CURL.php';

$terms = $_POST['search_string'];

// For some reason trying to pass the $filters variable to the SerialSolutions class 
// does not work I added the array to the Query.php file. - Elliot
// $filters = array('s.fvf' => 'ContentType,Newspaper Article,true');
// Create Summon Connector
$summon = new SerialsSolutions_Summon_CURL('wayne', 'F83344m8ifV91jjnYifVLr0BQyA4v2y8');

// Setup Query
$query = new SerialsSolutions_Summon_Query($terms);

// Execute Query
$result = $summon->query($query);

echo json_encode($result);

?>