<?php
include('app/app.php');
include('rest/EBSCOAPI.php');
$api = new EBSCOAPI();
$timeout = $_REQUEST['to'];
set_time_limit($timeout);

$searchTerm = str_replace('"','',$_REQUEST['query']);
$fieldCode = $_REQUEST['fieldcode'];
$i = $_REQUEST['i'];
$sortBy = isset($_REQUEST['sortBy'])?$_REQUEST['sortBy']:'';
$name = $_REQUEST['bn'];

if($name == 'Publications'){
    $facetName = 'Publication';
}
if($name == 'Subject Terms'){
    $facetName = 'Subject';
}

$actions = isset($_REQUEST['action']) ? $_REQUEST['action']: array();
if($actions[1]=="unavailable")$actions=array();
$action = array();
if(!empty($actions)){
    $n =1;
  foreach($actions as $a){
        $action["action-$n"]= $a;
    }
}

$xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);
      $boxes = $dom->getElementsByTagName('BentoBox');
      
      $commonp = $dom->getElementsByTagName('CommonSearchParametersForEachBentoBox');
      foreach ($commonp as $p) {
      $start = $p ->getElementsByTagName('PageNumber')->Item(0)->nodeValue;
      $limit = $p ->getElementsByTagName('ResultsPerPage')->Item(0)->nodeValue;
    
      $mode = $p ->getElementsByTagName('SearchMode')->Item(0)->nodeValue;
      $highlight = $p ->getElementsByTagName('Highlight')->Item(0)->nodeValue;
      $expander = isset($_REQUEST['expander'])?$_REQUEST['expander']:$p ->getElementsByTagName('Expander')->Item(0)->nodeValue;
   
}
      $fullp = $dom->getElementsByTagName('FullResultsSearchParameters');
      foreach ($fullp as $fp){
         $inclf = $fp ->getElementsByTagName('IncludeFacets')->Item(0)->nodeValue;
         $amount =$fp ->getElementsByTagName('View')->Item(0)->nodeValue;
     }

if(isset($_REQUEST['back'])&&isset($_SESSION[$name])){
        $results = $_SESSION[$name];
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
            $query_str = implode(" ", array($fieldCode, $term));
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
        $params = array_merge($params,$action);
        $params = http_build_query($params);
        
    $results = $api->apiSearch($params);
    $_SESSION[$name] = $results;
    }
// Error
if (isset($results['error'])) {
    $error = $results['error'];
    $results =  array();
} else {
    $error = null;
}

include 'app/views/individulbox.html.php';

?>
