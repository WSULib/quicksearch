<?php

//set baseURL
$baseURL = $_POST['baseURL'];

// pop from POST parameters
unset($_POST['baseURL']);

// turn into GET parameters
$GETparams = http_build_query($_POST);

//assemble URL
$URL = $baseURL.$GETparams."&functions[]=".$_POST['function'];

// retrieve JSON
$datastream = file_get_contents($URL);	
echo $datastream;

?>