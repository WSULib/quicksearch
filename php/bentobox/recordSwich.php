<?php
session_start();
include('rest/EBSCOAPI.php');

$api = new EBSCOAPI();

$resultId = $_REQUEST['resultId'];
$query = $_REQUEST['query'];
$fieldCode = $_REQUEST['fieldcode'];
$start = isset($_REQUEST['pagenumber']) ? $_REQUEST['pagenumber'] : 1;
$limit = isset($_REQUEST['resultsperpage'])?$_REQUEST['resultsperpage']:20;
$f = $_REQUEST['f'];
$name=$_REQUEST['bn'];

if($f=='box') $results = $_SESSION[$name];
if($f=='results') $results = $_SESSION['current-results'];

$queryStringUrl = $results['queryString'];

if($resultId>$start*$limit){
    $start = $start+1;
    $url = $queryStringUrl."&pagenumber=$start";
    $results = $api->apiSearch($url);   
    if($f=='box')$_SESSION[$name]=$results;
    if($f=='results')$_SESSION['current-results'] = $results;
   
} else if($resultId<(($start-1)*$limit)+1){
    $start = $start-1;
    $url = $queryStringUrl."&pagenumber=$start";
    $results = $api->apiSearch($url);   
    if($f=='box')$_SESSION[$name]=$results;
    if($f=='results')$_SESSION['current-results'] = $results;
   
} else if(isset($_SESSION['current-results'])){
    
    if($f=='box') $results = $_SESSION[$name];
    if($f=='results') $results = $_SESSION['current-results'];
    
} else {
    $results = $api->apiSearch($queryStringUrl);    
    if($f=='box')$_SESSION[$name]=$results;
    if($f=='results')$_SESSION['current-results'] = $results;
   
}


$recordCount = $results['recordCount'];

foreach($results['records'] as $record){
    if($record['ResultId']==$resultId){
        $db = $record['DbId'];
        $an = $record['An'];
        $rId = $record['ResultId'];
        $params = array(
            'db'=>$db,
            'an'=>$an,
            'highlight'=>$query,
            'resultId'=>$rId,
            'recordCount'=>$recordCount,
            'query'=>$query,
            'fieldcode'=>$fieldCode,
            'f'=>$f,
            'bn'=>$name
        );
        $params = http_build_query($params);
        header("location:record.php?$params");
        break;
    }
}


?>

