<?php

//header("Access-Control-Allow-Origin: http://library.wayne.edu");
header("Access-Control-Allow-Origin: http://library2.wayne.edu");

// $GLOBALS['spelledWrong'] = false;

// function spellcheckSingle($word) {
// 	$fgc1 = file_get_contents("http://silo.lib.wayne.edu/solr4/DCArchive/spell?rows=0&spellcheck=false&spellcheck.collate=true&wt=json&q=" . $word);
// 	$json1 = json_decode($fgc1, true);
// 	if ($json1['response']['numFound'] > 0) {
// 		// is a word
// 		return $word;
// 	} else {
// 		// not a word
// 		$GLOBALS['spelledWrong'] = true;
// 		$fgc = file_get_contents("http://silo.lib.wayne.edu/solr4/DCArchive/spell?rows=0&spellcheck=true&spellcheck.collate=true&wt=json&q=" . $word);
// 		$json = json_decode($fgc, true);
// 		return '<b>' . $json['spellcheck']['suggestions'][1]['suggestion'][0] . '</b>';
// 	}
	
// }

// function spellcheck($str) {
// 	$words = preg_split('/\s+/', $str);
// 	foreach ($words as $key => $word) {
// 		$didyoumean[] = spellcheckSingle($word);
// 	}
// 	return implode(' ', $didyoumean);
// }



// $query = $_GET['query'];
// $spellchecked = array(
// 	'corrected' => spellcheck($query),
// 	'spelledWrong' => $GLOBALS['spelledWrong']
// );

// echo json_encode($spellchecked);



require_once("QueryParser.php");

$query = $_GET['query'];
$spellcheck = new SpellChecker($query);
//print_r($spellcheck);

$spellchecked = array(
	'corrected' => $spellcheck->correction,
	'spelledWrong' => $spellcheck->correction ? true : false
);
echo json_encode($spellchecked);



?>