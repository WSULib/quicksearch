<?php

// Server URL with port and database descriptor
// $server = $_POST['encodedURL'];
// $syntax = "usmarc";
$bib = $_GET['bib'];

$server = "elibrary.wayne.edu:210/innopac";
$syntax = "usmarc";
// $bib = "b1000001X";

//if a space is found in the search terms aka, user has done a multiple word search, put it quotes
if (strpos($bib, ' ') !== false)
{
    $bib = '"'. $bib .'"';
}
$keywordSearch = "@attr 1=12 $bib";
$session = yaz_connect($server);
// check whether an error occurred
if (yaz_error($session) != ""){
    die("Error: " . yaz_error($session));
}
// configure desired result syntax (must be specified in Target Profile)
yaz_syntax($session, $syntax);
    // specify the number of results to fetch
    yaz_range($session, 1, 1);
    // do the actual query
    yaz_search($session, "rpn", $keywordSearch);
    // wait blocks until the query is done
    yaz_wait();

    // yaz_hits returns the amount of found records
    if (yaz_hits($session) > 0){
        // echo "Found some hits:<br>";
        // yaz_record fetches a record from the current result set,
        // so far I've only seen server supporting string format
        for ($p = 1; $p <= 1; $p++) {
        $result = yaz_record($session, $p, "string");
        // print($result);

        $parsedResult = parse_usmarc_string($result);
    }
    } 
    // else
    //     echo "No records found.";

// prepare associative array
$arr = $parsedResult;
// print XML
// print array2xml($arr);

$xml_string = array2xml($arr);

// associate array, value = xml string, encode string in json
$xml_string_to_json = array (metaXMLChunk => $xml_string);
$json_object = json_encode($xml_string_to_json);
echo "metaPayload(" . $json_object . ");";

// print_r($xml_string);
// $xml_object = simplexml_load_string($xml_string);
// // print_r($xml_object);
// $json_object = json_encode($xml_object);
// echo $json_object;
// echo htmlentities(array2xml($arr));

//array2xml function and call copied and modified from Darko Bunic at http://www.redips.net/
//please find his complete code at http://www.redips.net/php/convert-array-to-xml/

/**
 * Function returns XML string for input associative array.
 * @param Array $array Input associative array
 * @param String $wrap Wrapping tag
 * @param Boolean $upper To set tags in uppercase
 */
function array2xml($array, $upper=true) {
    // set initial value for XML string
    $xml = '';
    // $wrap = "xml";
    // wrap XML with $wrap TAG
    if ($wrap != null) {
        $xml .= "<$wrap>\n";
    }

    //make it well formed
    // $xml .= "<xml>";   

    // declare a schema
    $xml .= "<link rel='schema.dcterms'" . ' href="http://purl.org/dc/elements/1.1/"' . "/>";

    // main loop
    foreach ($array as $key=>$value) {
        // set tags in uppercase if needed
        if ($upper == false) {
            $key = strtoupper($key);
        }
        // append to XML string

        if ($key == "dcterms.description") {
        $xml .= "<meta name='$key'" . " xml:lang='en' " . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
    }
        elseif ($key == "dcterms.subtitle") {
        $xml .= "<meta name='dcterms.title'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
    }
        elseif ($key == "dcterms.source.ISBN") {
        $xml .= "<meta name='dcterms.source'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
    }
        elseif ($key == "dcterms.source.ISSN") {
        $xml .= "<meta name='dcterms.source'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
    }
        elseif ($key == "dcterms.source.callnumber") {
        $xml .= "<meta name='dcterms.source'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
    }

        elseif ($key == "dcterms.subject.personalname") {
        $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
            foreach ($value as $SubjectTerm) {
                if (strlen($SubjectTerm) > 0) {
           $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($SubjectTerm)) . '"' . "/>";               
                }
    }
    }
        elseif ($key == "dcterms.subject.corporatename") {
        $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
            foreach ($value as $SubjectTerm) {
                if (strlen($SubjectTerm) > 0) {
           $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($SubjectTerm)) . '"' . "/>";               
                }
    }
    }  

        elseif ($key == "dcterms.subject.meetingname") {
        $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
            foreach ($value as $SubjectTerm) {
                if (strlen($SubjectTerm) > 0) {
           $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($SubjectTerm)) . '"' . "/>";               
                }
    }
    }

        elseif ($key == "dcterms.subject.chronologicalterm") {
        $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";
    }
        elseif ($key == "dcterms.subject.topicalterm") {
            foreach ($value as $SubjectTerm) {
                if (strlen($SubjectTerm) > 0) {
           $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($SubjectTerm)) . '"' . "/>";               
                }
    }
    }
        elseif ($key == "dcterms.subject.geographicname") {
            foreach ($value as $SubjectTerm) {
                if (strlen($SubjectTerm) > 0) {
           $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($SubjectTerm)) . '"' . "/>";               
                }
    }
    }

        elseif ($key == "dcterms.subject.facetedtopicalterms") {
            foreach ($value as $SubjectTerm) {
                if (strlen($SubjectTerm) > 0) {
           $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($SubjectTerm)) . '"' . "/>";               
                }
    }
    }

        elseif ($key == "dcterms.subject.hierarchicalplacename") {
            foreach ($value as $SubjectTerm) {
                if (strlen($SubjectTerm) > 0) {
           $xml .= "<meta name='dcterms.subject'" . " content=" . '"' . htmlspecialchars(trim($SubjectTerm)) . '"' . "/>";               
                }
    }
    }

        else {
        $xml .= "<meta name='$key'" . " content=" . '"' . htmlspecialchars(trim($value)) . '"' . "/>";  
        }
}
    // close wrap TAG if needed
    if ($wrap != null) {
        $xml .= "\n</$wrap>\n";
    }
    // return prepared XML string
    return $xml;
}

    // print_r($parsedResult);

    // $json_object = json_encode($parsedResult);
    //  echo $json_object;

//parse_usmarc_string, get_subfield_value, and custom_trim functions borrowed and modified from Jonas at http://blog.peschla.net/
//His full code is found at http://blog.peschla.net/2011/12/bibliographic-data-via-z3950-and-phpyaz/
function parse_usmarc_string($record){
    $ret = array();
    // $ret["dcterms.subject.topicalterm"] = array();
    // there was a case where angle brackets interfered
    $record = str_replace(array("<", ">"), array("",""), $record);
    $record = utf8_decode($record);
    // echo $record;
    // split the returned fields at their separation character (newline)
    $record = explode("\n",$record);
    // print_r($record);
    //examine each line for wanted information (see USMARC spec for details)
    foreach($record as $category){
        // echo $category;
        // subfield indicators are preceded by a $ sign
        $parts = explode("$", $category);
        // print_r($parts);
        // remove leading and trailing spaces
        array_walk($parts, "custom_trim");
        // the first value holds the field id,
        // depending on the desired info a certain subfield value is retrieved
                    foreach (range("a", "z") as $i) {
        switch(substr($parts[0],0,3)){
            // case "001" : $ret['oclc'] = substr($parts[0],4); break;
            case "008" : $ret["dcterms.language"] = substr($parts[0],39,3); break;
            case "020" : $ret["dcterms.source.ISBN"] = get_subfield_value($parts,"a"); break;
            case "022" : $ret["dcterms.source.ISSN"] = get_subfield_value($parts,"a"); break;
            case "050" : $ret["dcterms.source.callnumber"] = get_subfield_value($parts,"a"); break;
            case "100" : $ret["dcterms.creator"] = get_subfield_value($parts,"a"); break;
            case "245" : $ret["dcterms.title"] = get_subfield_value($parts,"a");
                         $ret["dcterms.subtitle"] = get_subfield_value($parts,"b"); break;
            case "250" : $ret["dcterms.relation"] = get_subfield_value($parts,"a"); break;
            case "260" : $ret["dcterms.date"] = get_subfield_value($parts,"c");
                         // $ret["pub_place"] = get_subfield_value($parts,"a");
                         $ret["dcterms.publisher"] = get_subfield_value($parts,"b"); break;
            // case "300" : $ret["extent"] = get_subfield_value($parts,"a");
                         // $ext_b = get_subfield_value($parts,"b");
                         // $ret["extent"] .= ($ext_b != "") ? (" : " . $ext_b) : "";
                         // break;
            // case "490" : $ret["series"] = get_subfield_value($parts,"a"); break;
            // case "505" : $ret["contents"] = get_subfield_value($parts,"a"); break;            
            case "520" : $ret["dcterms.description"] = get_subfield_value($parts,"a"); break;

            //then capture all of the possible subjects
            case "600" : $ret["dcterms.subject.personalname"][] = get_subfield_value($parts,$i); break;
            case "610" : $ret["dcterms.subject.corporatename"][] = get_subfield_value($parts,$i); break;            
            case "611" : $ret["dcterms.subject.meetingname"][] = get_subfield_value($parts,$i); break;
            case "630" : $ret["dcterms.subject.uniformtitle"][] = get_subfield_value($parts,$i); break;
            case "648" : $ret["dcterms.subject.chronologicalterm"][] = get_subfield_value($parts,$i); break;                        
            // case "650" : $ret["dcterms.subject.topicalterm" . $i] = get_subfield_value($parts,$i); break;
            // case "650" : array_push($ret["dcterms.subject.topicalterm"], get_subfield_value($parts,$i)); break;
            case "650" : $ret["dcterms.subject.topicalterm"][] = get_subfield_value($parts,$i); break;

            case "651" : $ret["dcterms.subject.geographicname"][] = get_subfield_value($parts,$i); break;
            case "654" : $ret["dcterms.subject.facetedtopicalterms"][] = get_subfield_value($parts,$i); break;
            case "662" : $ret["dcterms.subject.hierarchicalplacename"][] = get_subfield_value($parts,$i); break;                        
            // case "502" : $ret["diss_note"] = get_subfield_value($parts,"a"); break;
            // case "700" : $ret["editor"] = get_subfield_value($parts,"a"); break;
            case "856" : $ret["dcterms.identifier"] = get_subfield_value($parts,"u"); break;
        }
    }
    }
    // print_r($ret);
    return $ret;
}
 
// fetches the value of a certain subfield given its label
function get_subfield_value($parts, $subfield_label){
    $ret = "";
    foreach ($parts as $subfield)
        if(substr($subfield,0,1) == $subfield_label)
            $ret = substr($subfield,2);
    return $ret;
}
 
// wrapper function for trim to pass it to array_walk
function custom_trim(& $value, & $key){
    $value = trim($value);
}


?>
