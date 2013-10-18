<?php
//get variables
$URL = $_POST['encodedURL'];
$data_type = $_POST['data_type'];
$searchTerm = $_POST['searchTerm'];

// $URL = "elibrary.wayne.edu:210/innopac";
// $data_type = "xml2json";
// $searchTerm = "detroit";

// XML to JSON
if ($data_type === 'xml2json'){

//keyword search
    // for ($i = 0; $i < 2; $i++) {
$keywordSearch = "@attr 1=1016 $searchTerm";
    $id = yaz_connect($URL);
        yaz_syntax($id, "xml");
        yaz_range($id, 1, 1);
        yaz_search($id, "rpn", $keywordSearch);
    yaz_wait();

for ($p = 1; $p <= 1; $p++) {
$xml_string = yaz_record($id, $p, "xml");

//destroy New Lines
$destroy_newLines = str_replace("\n", '', $xml_string);
//get rid of Ctr
$remove_controlCharacters = preg_replace('/[\x00-\x1F\x7F]/', '', $destroy_newLines);

//remove !DOCTYPE
$remove_extraElement = preg_replace('#!DOCTYPE #', '', $remove_controlCharacters);
//encode ampersand
$encode_amp=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $remove_extraElement);
//take xml string and make it into xml object and then encode into json
$xml_object = simplexml_load_string($encode_amp);

$json_object = json_encode($xml_object);
echo $json_object;
// return;
}

        // }

}

else {
	echo "Apologies. Something went wrong.";
	return;
}
?>