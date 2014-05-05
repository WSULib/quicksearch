<?php

//get variables create URL
$baseURL = "http://silo.lib.wayne.edu/solr4/DCOAI/select?";
$data_type = $_POST['data_type'];

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
$URL = $baseURL.urldecode($GETparams); // decoding for Solr
// echo $URL;

$datastream_bits = file_get_contents($URL);	
echo $datastream_bits;

?>