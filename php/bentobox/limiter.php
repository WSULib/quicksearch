<?php
session_start();
include "rest/EBSCOAPI.php";

$api =  new EBSCOAPI();
$Info = $api->getInfo();
$results = $_SESSION['current-results'];
$queryStringUrl = $results['queryString'];

$addLimiterActions = array();
$removeLimiterAction = array();

/*
 * Check which expander check boxes are checked, which are not checked
 * if is checked add the action to addExpanderActions
 * if is not checked, add remove action to removeExpanderActions when the expander is found in applied expanders
 * or do nothing when not found in applied expanders.
 */
$i = 1;
foreach($Info['limiters'] as $limiter){
    if(isset($_REQUEST[$limiter['Id']])){
        $addLimiterActions["action[$i]"]= str_replace('value', 'y', $limiter['Action']);
        $i++;
    }else{
        foreach($results['appliedLimiters'] as $filter){
            if($filter['Id']==$limiter['Id']){
                $removeLimiterAction["action[$i]"]= str_replace('value', 'y', $filter['removeAction']);
                $i++;
            }
        }
    }
}

$searchTerm = $_REQUEST['query'];
$fieldCode = $_REQUEST['fieldcode'];
$params = array(
    'refine'=>'y',
    'query'=>$searchTerm,
    'fieldcode'=>$fieldCode,
);
$params = array_merge($params,$addLimiterActions);
$params = array_merge($params,$removeLimiterAction);
$params = http_build_query($params);
$url = "results.php?".$queryStringUrl."&".$params;

header("location: {$url}");    
?>
