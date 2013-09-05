<?php

//get variables create URL
$baseURL = $_POST['baseURL'];
$data_type = $_POST['data_type'];
$request_type = $_POST['request_type'];
$facetFields = $_POST['facetFields'];


// REQUEST TYPE CONDITIONALS /////////////////////////////////////////////////////////////////////////////////////////////////////
//GET
if ($request_type === "GET"){

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

	//append facet fields, required to do so here, because cannot pass
	foreach ($facetFields as $field) {
		$URL = $URL."&facet.field=$field";
	}
}

//POST
if ($request_type === "POST"){
	echo "Not yet developed.";
}

// DATA TYPE CONDITIONALS /////////////////////////////////////////////////////////////////////////////////////////////////////
// Unfiltered - stream data as-is.  This is good for HTML, or specific services where the request can drive the output (e.g. Solr sending JSON)
if ($data_type === "unfiltered") {	
	$datastream_bits = file_get_contents($URL);	
	echo $datastream_bits;	
}


?>