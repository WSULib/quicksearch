<?php

include('app/app.php');
include('rest/EBSCOAPI.php');

$api = new EBSCOAPI();
$searchTerm = str_replace('"','',$_REQUEST['query']);
$fieldCode = isset($_REQUEST['fieldcode'])?$_REQUEST['fieldcode']:'';
$debug = isset($_REQUEST['debug'])? $_REQUEST['debug']:'';
$actions = isset($_REQUEST['action'])?$_REQUEST['action']:'';
$action = array();
if(!empty($actions)){
$i = 1;
foreach($actions as $act){
    $action["action-$i"]= $act;
    $i++;
}}
$Info = $api->getInfo();
/*
 * Load Config.xml file 
 */
$xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);
      $version = $dom->getElementsByTagName('Version')->item(0)->nodeValue;
      $length = $dom ->getElementsByTagName('AbstractLength')->item(0)->nodeValue; 
      //$boxes = $dom->getElementsByTagName('BentoBox');
      
      $commonp = $dom->getElementsByTagName('CommonSearchParametersForEachBentoBox');
     foreach ($commonp as $p) {
        $start = isset($_REQUEST['pagenumber'])?$_REQUEST['pagenumber']:$p ->getElementsByTagName('PageNumber')->Item(0)->nodeValue;
        $limit = isset($_REQUEST['resultsperpage'])?$_REQUEST['resultsperpage']:$p ->getElementsByTagName('ResultsPerPage')->Item(0)->nodeValue; 
        $mode = $p ->getElementsByTagName('SearchMode')->Item(0)->nodeValue;
        $expander = isset($_REQUEST['expander'])?$_REQUEST['expander']:$p ->getElementsByTagName('Expander')->Item(0)->nodeValue;
        $sortBy = isset($_REQUEST['sort'])?$_REQUEST['sort']:$p ->getElementsByTagName('Sort')->Item(0)->nodeValue;
}
        $fullp = $dom->getElementsByTagName('FullResultsSearchParameters');
     foreach ($fullp as $fp){
         $highlight = $fp ->getElementsByTagName('Highlight')->Item(0)->nodeValue;
         $inclf = $fp ->getElementsByTagName('IncludeFacets')->Item(0)->nodeValue;
         $amount =isset($_REQUEST['view'])?$_REQUEST['view']:$fp ->getElementsByTagName('View')->Item(0)->nodeValue;
     }

if(isset($_REQUEST['back'])&&isset($_SESSION['current-results'])){
    $results = $_SESSION['current-results'];
}else if(isset($_REQUEST['option'])){
    // All page options will be handled here 
// New Search or refined search will call the API
    
    $queryStringUrl = $_SESSION['current-results']['queryString'];
    
    if(!empty($actions)){
    foreach($actions as $act){
        if(strstr($act, 'setsort(')){
           $sortBy = str_replace(array('setsort(',')'),array('',''), $act);
           $start = 1;
       }
       if(strstr($act, 'setResultsperpage(')){
           $limit = str_replace(array('setResultsperpage(',')'),array('',''), $act);
       }
       if(strstr($act, 'GoToPage(')){
          $start = str_replace(array('GoToPage(',')'),array('',''), $act);
       }
    }}
 
    $view = isset($_REQUEST['view'])? array('view'=>$_REQUEST['view']):array();   
    $url = $queryStringUrl."&".http_build_query($action)."&".http_build_query($view);
    $results = $api->apiSearch($url);    
    // Will save the result into the session with the new SessionToken as index    
    $_SESSION['current-results'] = $results;
    
}else if(isset($_GET['login'])||isset($_REQUEST['refine'])){
    $queryStringUrl = $_SESSION['current-results']['queryString'];
    $params = $queryStringUrl.'&'.http_build_query($action);
    $results = $api->apiSearch($params);
    $_SESSION['current-results'] = $results;
    if(isset($_REQUEST['refine'])) $start = 1;
}else{
 $query = array();

        // Basic search
        if(!empty($searchTerm)) {
            $term = urldecode($searchTerm);
            $term = str_replace('"', '', $term); // Temporary
            $term = str_replace(',',"\,",$term);
            $term = str_replace(':', '\:', $term);
            $term = str_replace('(', '\(', $term);
            $term = str_replace(')', '\)', $term);
            
            if($fieldCode!='keyword'){
            $query_str = implode(":", array($fieldCode, $term));
            }else{
            $query_str = $term;
            }
            $query["query"] = $query_str;

        // No search term, return an empty array
        } else {
            $results = array();            
        }
        
        // Add the HTTP query params
        $params = array(
            // Specifies the sort. Valid options are:
            // relevance, date, date2
            // date = Date descending
            // date2 = Date descending
            'sort'           => $sortBy,
            // Specifies the search mode. Valid options are:
            // bool, any, all, smart
            'searchmode'     => $mode,
            // Specifies the amount of data to return with the response. Valid options are:
            // Title: title only
            // Brief: Title + Source, Subjects
            // Detailed: Brief + full abstract
            'view'           => $amount,
            // Specifies whether or not to include facets
            'includefacets'  => $inclf,
            'resultsperpage' => $limit,
            'pagenumber'     => $start,
            // Specifies whether or not to include highlighting in the search results
            'highlight'      => $highlight,
            'expander'       => $expander
        );
        $params = array_merge($params, $query);
        $params = array_merge($params, $action);
        $params = http_build_query($params);

$results = $api->apiSearch($params);
    
$_SESSION['current-results'] = $results;
}
// Error
if (isset($results['error'])) {
    $error = $results['error'];
    $results =  array();
} else {
    $error = null;
}

// URL used by facets links
$refineSearchParams = array(
    'refine'=>'y',
    'query'=>$searchTerm,
    'fieldcode'=>$fieldCode
);
$refineSearchUrl = "results.php?".http_build_query($refineSearchParams);

//save debug into session
if($debug == 'y'||$debug == 'n'){
    $_SESSION['debug'] = $debug;
}

// Variables used in view
$variables = array(
    'searchTerm'     => $searchTerm,
    'fieldCode'      => $fieldCode,
    'results'        => $results,
    'error'          => $error,
    'start'          => $start,
    'limit'          => $limit,   
    'refineSearchUrl' => $refineSearchUrl,
    'expander'       => $expander,
    'sortBy'         => $sortBy,
    'amount'         => $amount,
    'version'        => $version,
    'Info'           => $Info,
    'length'         => $length,
    'debug'          => isset($_SESSION['debug'])? $_SESSION['debug']:'',
    'login'          => isset($_GET['login'])?$_GET['login']:''
);

render('results.html', 'blank.html', $variables);

?>