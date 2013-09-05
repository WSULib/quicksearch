<?php

// Server URL with port and database descriptor
$server = $_POST['encodedURL'];
$syntax = "usmarc";
$searchTerm = $_POST['searchTerm'];

// $server = "elibrary.wayne.edu:210/innopac";
// $syntax = "usmarc";
// $searchTerm = "biology";

//if a space is found in the search terms aka, user has done a multiple word search, put it quotes
if (strpos($searchTerm, ' ') !== false)
{
    $searchTerm = '"'. $searchTerm .'"';
}
$keywordSearch = "@attr 1=1035 $searchTerm";
$session = yaz_connect($server);
// check whether an error occurred
if (yaz_error($session) != ""){
    die("Error: " . yaz_error($session));
}
// configure desired result syntax (must be specified in Target Profile)
yaz_syntax($session, $syntax);
    // specify the number of results to fetch
    yaz_range($session, 1, 90);
    // do the actual query
    yaz_search($session, "rpn", $keywordSearch);
    // wait blocks until the query is done
    yaz_wait();

    // yaz_hits returns the amount of found records
    if (yaz_hits($session) > 0){
        // echo "Found some hits:<br>";
        // yaz_record fetches a record from the current result set,
        // so far I've only seen server supporting string format
        for ($p = 1; $p <= 90; $p++) {
        $result = yaz_record($session, $p, "string");
        // print($result);

        $parsedResult[] = parse_usmarc_string($result);
    }
    } else
        echo "No records found.";

    // print_r($parsedResult);
    $json_object = json_encode($parsedResult);
     echo $json_object;

function parse_usmarc_string($record){
    $ret = array();
    // there was a case where angle brackets interfered
    $record = str_replace(array("<", ">"), array("",""), $record);
    $record = utf8_decode($record);
    // split the returned fields at their separation character (newline)
    $record = explode("\n",$record);
    //examine each line for wanted information (see USMARC spec for details)
    foreach($record as $category){
        // subfield indicators are preceded by a $ sign
        $parts = explode("$", $category);
        // print_r($parts);
        // remove leading and trailing spaces
        array_walk($parts, "custom_trim");
        // the first value holds the field id,
        // depending on the desired info a certain subfield value is retrieved
        switch(substr($parts[0],0,3)){
            case "001" : $ret['oclc'] = substr($parts[0],4); break;
            case "008" : $ret["language"] = substr($parts[0],39,3); break;
            case "020" : $ret["isbn"] = get_subfield_value($parts,"a"); break;
            case "022" : $ret["issn"] = get_subfield_value($parts,"a"); break;
            case "100" : $ret["author"] = get_subfield_value($parts,"a"); break;
            case "245" : $ret["title"] = get_subfield_value($parts,"a");
                         $ret["subtitle"] = get_subfield_value($parts,"b"); break;
            case "250" : $ret["edition"] = get_subfield_value($parts,"a"); break;
            case "260" : $ret["pub_date"] = get_subfield_value($parts,"c");
                         $ret["pub_place"] = get_subfield_value($parts,"a");
                         $ret["publisher"] = get_subfield_value($parts,"b"); break;
            case "300" : $ret["extent"] = get_subfield_value($parts,"a");
                         $ext_b = get_subfield_value($parts,"b");
                         $ret["extent"] .= ($ext_b != "") ? (" : " . $ext_b) : "";
                         break;
            case "490" : $ret["series"] = get_subfield_value($parts,"a"); break;
            case "505" : $ret["contents"] = get_subfield_value($parts,"a"); break;            
            case "520" : $ret["description"] = get_subfield_value($parts,"a"); break;
            case "502" : $ret["diss_note"] = get_subfield_value($parts,"a"); break;
            case "700" : $ret["editor"] = get_subfield_value($parts,"a"); break;
            case "856" : $ret["url"] = get_subfield_value($parts,"u"); break;
        }
    }
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
