<?php
//get variables
$URL = $_POST['encodedURL'];
$data_type = $_POST['data_type'];
$searchTerm = $_POST['searchTerm'];
$number = "/1/1/1/30";

// $URL = 'http://elibrary.wayne.edu/xmlopac/X';
// $data_type = 'xml2json';
// $searchTerm = 'JAMA';
//take value and add to query
$my_query = $URL . $searchTerm . $number;

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