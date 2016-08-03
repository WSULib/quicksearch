<?php




require_once 'summon/CURL.php';
require_once '../api/QueryParser.php';
require_once("../api/functions.php");

//SerialsSolutions_Summon_Query::$dateFrom = '2012';

$terms = $_POST['search_string'];

// For some reason trying to pass the $filters variable to the SerialSolutions class 
// does not work I added the array to the Query.php file. - Elliot
// $filters = array('s.fvf' => 'ContentType,Newspaper Article,true');
// Create Summon Connector
$summon = new SerialsSolutions_Summon_CURL('wayne', 'F83344m8ifV91jjnYifVLr0BQyA4v2y8');











// $queryParser = new QueryParser( $terms );

// $querySummonOptions = array(
// 	//'query' => $queryParser->queryNormalizedWhitespace,
// 	'title' => $queryParser->citationParser->title,
// 	'date' => $queryParser->citationParser->date,
// );

// // Setup Query
// $query = new SerialsSolutions_Summon_Query($queryParser->queryNormalizedWhitespace, $querySummonOptions);

// // Execute Query
// $result = $summon->query($query);


$queryParser = new QueryParser( $terms );


// Setup Query
$query = new SerialsSolutions_Summon_Query($terms);

// Execute Query
$result = $summon->query($query);












// function relpaceWithBold($terms, $target) {
// 	// remove stopwords
// 	//$stopwords = array('and', 'of', 'is');
// 	//$stopwords = array('and', 'of', 'is', 'the');
// 	$stopwords = array('and', 'of', 'is', 'the', 'in', 'on', 'to', 'from', 'by', 'with');
// 	foreach ($stopwords as $stopword) {
// 		if(($key = array_search($stopword, $terms)) !== false) {
// 			unset($terms[$key]);
// 		}
// 	}
// 	// replace with same word, but bold
// 	foreach ($terms as $term) {
// 		$target = preg_replace('/\b(' . preg_quote($term) . ')\b/i', "<b>$1</b>", $target);
// 	}
// 	return $target;
// }
//$termsArr = array_unique( explode(" ", $terms ) );// we only want to replace each term once
// $termsArr = array_unique( explode(" ", preg_replace("/[^A-Za-z0-9 ]/", "", $queryParser->queryNormalizedWhitespace) ) );// we only want to replace each term once
foreach ($result['documents'] as $ind => $document) {
	$result['documents'][$ind]['Title'][0] = replaceWithBold( $queryParser->queryKeywords, $result['documents'][$ind]['Title'][0] );
	//$result['documents'][$ind]['PublicationDate'][0] = date("d-m-Y", strtotime($result['documents'][$ind]['PublicationDate'][0]));
	$result['documents'][$ind]['PublicationDate'][0] = date("n/j/Y", strtotime($result['documents'][$ind]['PublicationDate'][0]));
}






echo json_encode($result);
//echo '<script>alert("'.$query.'");</script>';

?>