<?php
require_once 'summon/CURL.php';

$json = $_POST['myJson'];
$json_decoded = json_decode($json, true);

$terms = $json_decoded['terms'];
$options = array('holdings' => $json_decoded['holdings']);

// For some reason trying to pass the $filters variable to the SerialSolutions class 
// does not work I added the array to the Query.php file. - Elliot
// $filters = array('s.fvf' => 'ContentType,Newspaper Article,true');
// Create Summon Connector
$summon = new SerialsSolutions_Summon_CURL('wayne', 'F83344m8ifV91jjnYifVLr0BQyA4v2y8');

// Setup Query
$query = new SerialsSolutions_Summon_Query($terms, $options);

// Execute Query
$result = $summon->query($query);

//print_r($json_decoded);
echo json_encode($result);

?>