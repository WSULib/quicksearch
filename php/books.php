<?php
//Get Variables
$URL = $_POST['encodedURL'];
$data_type = $_POST['data_type'];
$searchTerm = $_POST['searchTerm'];
$search = $_POST['searchTerm']."?noexclude=WXROOT.Heading.Title.IIIRECORD";
// $number = "?scope=2";

// **********TESTING VARIABLES****************************
// $URL = 'http://elibrary.wayne.edu/xmlopac/X';
// $data_type = 'xml2json';
// $searchTerm = 'detroit';
// $search = 'house'.'?noexclude=WXROOT.Heading.Title.IIIRECORD';
// **********TESTING VARIABLES****************************
$my_query = $URL . $search;
// Set Arrays
$books = array();
$previousBooks = array();

//Get xml
if ($data_type == "xml2json"){
	$use_errors = libxml_use_internal_errors(true);
	$xml = simplexml_load_file($my_query);

	// if finding the IIIRecord borks, then fall back to a simpler search and ignore the LC call number and any stackview/view on shelf
	if (!$xml){
		$my_query = $URL . $searchTerm;
		$xml = simplexml_load_file($my_query);

		$resultCount = $xml->xpath('/WXROOT/PAGEINFO/ENTRYCOUNT');
		if ($resultCount[0][0] >= 3) { $bookTotal = 3;} else {$bookTotal = $resultCount[0];}
		$booksObj = $xml->xpath('/WXROOT/Heading/Title[position() <='.$bookTotal.']');

		for ($i = 0; $i<=$bookTotal-1; $i++) {
			$title = $booksObj[$i]->xpath('TitleField/VARFLDPRIMARYALTERNATEPAIR/VARFLDPRIMARY/VARFLD/DisplayForm');
			$lc = null;
			$bibNum = $booksObj[$i]->xpath('RecordId/RecordKey');
			$MatType = $booksObj[$i]->xpath('IIIRECORD/TYPEINFO/BIBLIOGRAPHIC/FIXFLD/FIXNUMBER[text() = "30"]/../FIXLONGVALUE');

			if (isset($title[0]) === FALSE) { $title[0] = "eResource - Click For Title";};
			if (isset($bibNum[0]) === FALSE) { $bibNum[0] = null;};
			if (isset($MatType[0]) === FALSE) { $MatType[0] = null;};

			$books = array( 
				"title" => $title[0],
				"lc" => null,
				"bibNum" => $bibNum[0],
				"MatType" => $MatType[0]
				);
			$mergedBooks = array_merge_recursive($previousBooks, $books);
			$previousBooks = $mergedBooks;
			}

			$books = $previousBooks;
			$books["bookTotal"] = (int)$bookTotal;
			$books["bookTotalComplete"] = (int)$resultCount[0][0];

			// ****************Run z3950*************************
			$count = 0;
			foreach((array)$books["bibNum"] as $singleObj) {
				$books["holdings_info"][$count] = json_decode(json_encode((array)Z3950($singleObj)), TRUE);
				$count++;
			}
			// ****************End z3950*************************

			// temporary fix -- remove Juvenile Fiction and Ramsey collection from showing a stackview link in Quicksearch
			for ($i = 0; $i<$books["bookTotal"]; $i++) {
				$hasMultipleHoldings = isset($books["holdings_info"][$i]["holding"][0]["localLocation"]) ? true : false;
				if ($hasMultipleHoldings === true) {

					if ($books["holdings_info"][$i]["holding"][0]["localLocation"] == "Purdy-Kresge Library Juvenile Fiction" || $books["holdings_info"][$i]["holding"][0]["localLocation"] == "Purdy-Kresge Library Ramsey Collection" || $books["holdings_info"][$i]["holding"][0]["localLocation"] == "Purdy-Kresge Library Juvenile Biography" || $books["holdings_info"][$i]["holding"][0]["localLocation"] == "Law Library CIS Microform Collection") {
						$books["lc"][$i] = null;
						}
					else {
						continue;
						}
				}
				else {
					if ($books["holdings_info"][$i]["holding"]["localLocation"] == "Purdy-Kresge Library Juvenile Fiction" || $books["holdings_info"][$i]["holding"]["localLocation"] == "Purdy-Kresge Library Ramsey Collection" || $books["holdings_info"][$i]["holding"]["localLocation"] == "Purdy-Kresge Library Juvenile Biography" || $books["holdings_info"][$i]["holding"]["localLocation"] == "Law Library CIS Microform Collection") {
							$books["lc"][$i] = null;
						}
					else {
							continue;
						}
				}
		}
		// *******************end temporary fix*************************

		//convert and encode in json
		$json_response = json_encode($books);



	}

	else {

		$resultCount = $xml->xpath('/WXROOT/PAGEINFO/ENTRYCOUNT');
		if ($resultCount[0][0] >= 3) { $bookTotal = 3;} else {$bookTotal = $resultCount[0];}
		$booksObj = $xml->xpath('/WXROOT/Heading/Title[position() <='.$bookTotal.']');

		for ($i = 0; $i<=$bookTotal-1; $i++) {
			$title = $booksObj[$i]->xpath('TitleField/VARFLDPRIMARYALTERNATEPAIR/VARFLDPRIMARY/VARFLD/DisplayForm');
			$lc = $booksObj[$i]->xpath('IIIRECORD/VARFLDPRIMARYALTERNATEPAIR/VARFLDPRIMARY/VARFLD/MARCINFO/MARCTAG[text() = "090"]/../../DisplayForm');
			$bibNum = $booksObj[$i]->xpath('RecordId/RecordKey');
			$MatType = $booksObj[$i]->xpath('IIIRECORD/TYPEINFO/BIBLIOGRAPHIC/FIXFLD/FIXNUMBER[text() = "30"]/../FIXLONGVALUE');

			if(isset($lc[0]) === FALSE) { $lc = $booksObj[$i]->xpath('IIIRECORD/VARFLDPRIMARYALTERNATEPAIR/VARFLDPRIMARY/VARFLD/MARCINFO/MARCTAG[text() = "050"]/../../DisplayForm'); }
			if (isset($title[0]) === FALSE) { $title[0] = "eResource - Click For Title";};
			if (isset($lc[0]) === FALSE) { $lc[0] = null;};
			if (isset($bibNum[0]) === FALSE) { $bibNum[0] = null;};
			if (isset($MatType[0]) === FALSE) { $MatType[0] = null;};

			$books = array( 
				"title" => $title[0],
				"lc" => $lc[0],
				"bibNum" => $bibNum[0],
				"MatType" => $MatType[0]
				);
			$mergedBooks = array_merge_recursive($previousBooks, $books);
			$previousBooks = $mergedBooks;
			}

			$books = $previousBooks;
			$books["bookTotal"] = (int)$bookTotal;
			$books["bookTotalComplete"] = (int)$resultCount[0][0];

			// ****************Run z3950*************************
			$count = 0;
			foreach((array)$books["bibNum"] as $singleObj) {
				$books["holdings_info"][$count] = json_decode(json_encode((array)Z3950($singleObj)), TRUE);
				$count++;
			}
			// ****************End z3950*************************

			// temporary fix -- remove Juvenile Fiction and Ramsey collection from showing a stackview link in Quicksearch
			for ($i = 0; $i<$books["bookTotal"]; $i++) {
				$hasMultipleHoldings = isset($books["holdings_info"][$i]["holding"][0]["localLocation"]) ? true : false;
				if ($hasMultipleHoldings === true) {

					if ($books["holdings_info"][$i]["holding"][0]["localLocation"] == "Purdy-Kresge Library Juvenile Fiction" || $books["holdings_info"][$i]["holding"][0]["localLocation"] == "Purdy-Kresge Library Ramsey Collection" || $books["holdings_info"][$i]["holding"][0]["localLocation"] == "Purdy-Kresge Library Juvenile Biography" || $books["holdings_info"][$i]["holding"][0]["localLocation"] == "Law Library CIS Microform Collection") {
						$books["lc"][$i] = null;
						}
					else {
						continue;
						}
				}
				else {
					if ($books["holdings_info"][$i]["holding"]["localLocation"] == "Purdy-Kresge Library Juvenile Fiction" || $books["holdings_info"][$i]["holding"]["localLocation"] == "Purdy-Kresge Library Ramsey Collection" || $books["holdings_info"][$i]["holding"]["localLocation"] == "Purdy-Kresge Library Juvenile Biography" || $books["holdings_info"][$i]["holding"]["localLocation"] == "Law Library CIS Microform Collection") {
							$books["lc"][$i] = null;
						}
					else {
							continue;
						}
				}
		}
		// *******************end temporary fix*************************

		//convert and encode in json
		$json_response = json_encode($books);
	}
}

else {
    $xml = simplexml_load_string("Internal Server Error");
	$json_response = json_encode($xml);
}

// Return response to books.js
    echo $json_response;










// BASIC Z3950 YAZ SETUP with syntax set to OPAC to return holdings info
	function Z3950($query) {
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

        if ($xml->holdings->holding == true) {
        	if (count($xml->holdings->holding) == 1) {
        		// return count($xml->holdings->holding);
        		return array(
        			"holding" => array
        			(
        				$xml->holdings->holding));
        	}
        	else {
	        	return $xml->holdings;
        	}
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
	yaz_close($session);
		}









?>