<?php
//get variables
$URL = $_POST['encodedURL'];
$data_type = $_POST['data_type'];
$searchTerm = $_POST['searchTerm'];
// $number = "?scope=2";

// $URL = 'http://elibrary.wayne.edu/xmlopac/X';
// $data_type = 'xml2json';
// $searchTerm = 'teenage mutant ninja turtles';

//take value and add to query
$my_query = $URL . $searchTerm;

//Test

//Get xml
if ($data_type == "xml2json"){
$xml = simplexml_load_file($my_query);

// run z3950
$count = 0;
foreach($xml->Heading->Title as $singleObj) {
	$add_holding_status = array ("holdings_info" =>Z3950($singleObj));
	$new_xml['Heading']['Title'][$count] = array_merge((array)$singleObj, $add_holding_status);
	$count++;
}

//convert and encode in json
$json_response = json_encode($new_xml);
echo $json_response;    

}

else {
    $xml = simplexml_load_string("Internal Server Error");
    echo $json_response;
}



// BASIC Z3950 YAZ SETUP with syntax set to OPAC to return holdings info
	function Z3950($singleObj) {
		$query = $singleObj->RecordId->RecordKey;
	    $search = "@attr 1=12 $query";
	    $session = yaz_connect("elibrary.wayne.edu:210/innopac");

    if (yaz_error($session) != ""){
        die("Error: " . yaz_error($session));
    }

    // SPECIFY and RUN specific type of Z3950 query
    // specify the number of results to fetch
    yaz_range($session, 1, yaz_hits($session));
    yaz_syntax($session, "opac");
    yaz_search($session, "rpn", $search);
    // wait blocks until the query is done
    yaz_wait();

    // yaz_hits returns the amount of found records
    if (yaz_hits($session) > 0){

        for ($p = 1; $p <= yaz_hits($session); $p++) {
        $result = yaz_record($session, $p, "xml");
        // print_r($result);
        // Process all of your MARC Records
        $result = utf8_encode($result);
        $xml = simplexml_load_string($result);

        if ($xml->holdings == true) {
        	return $xml->holdings;
        }
        else {
        	$xml = '';
        	return $xml = array (
            "holding" => array
                (
                    0 => array
                        (
                            "status" => "no holdings records",
                        	"publicNote" =>  "")
                        ));
        }

    	}

    }

    else {
        return "no results";
    	} 
	yaz_close($session);
		}

?>