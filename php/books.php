<?php
//get variables
$URL = $_POST['encodedURL'];
$data_type = $_POST['data_type'];
$searchTerm = $_POST['searchTerm'];
$number = "?scope=2";

// $URL = 'http://elibrary.wayne.edu/xmlopac/X';
// $data_type = 'xml2json';
// $searchTerm = 'JAMA';
//take value and add to query
$my_query = $URL . $searchTerm;

//Test
//echo $my_query;
//Get xml
if ($data_type == "xml2json"){
$xml = simplexml_load_file($my_query);

// //convert and encode in json
$json_response = json_encode($xml);
echo $json_response;    
}

else {
    $xml = simplexml_load_string("Internal Server Error");
    echo $json_response;
}

?>