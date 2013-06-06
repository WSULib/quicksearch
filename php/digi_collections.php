<?php

//get variables create URL
$baseURL = $_POST['baseURL'];
$data_type = $_POST['data_type'];
// $facetFields = $_POST['facetFields'];

//assemble GETparams into URL encoded form
$data = $_POST['GETparams'];
//iterate through and remove empties
foreach ($data as $param => $value) {
    if ($value === ""){
    	unset($data[$param]);
    }
}
$GETparams = http_build_query($data);

//assemble GET URL
$URL = $baseURL.$GETparams;

$datastream_bits = file_get_contents($URL);	
echo $datastream_bits;

?>