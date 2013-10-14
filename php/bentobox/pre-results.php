<?php
include('app/app.php');
include('rest/EBSCOAPI.php');

$api = new EBSCOAPI();
$searchTerm = str_replace('"','',$_REQUEST['query']);
$fieldCode = $fieldCode = $_REQUEST['fieldcode']? $_REQUEST['fieldcode'] :'';
$info = $api->getInfo();

$xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);
          $commonp = $dom->getElementsByTagName('CommonSearchParametersForEachBentoBox');
     foreach ($commonp as $p) {      
        $expander = isset($_REQUEST['expander'])?$_REQUEST['expander']:$p ->getElementsByTagName('Expander')->Item(0)->nodeValue;
     }

if(isset($_REQUEST['back'])&&isset($_SESSION['pre-results'])){
    $results = $_SESSION['pre-results'];
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
            'sort'           => 'relevance',
            // Specifies the search mode. Valid options are:
            // bool, any, all, smart
            'searchmode'     => 'all',
            // Specifies the amount of data to return with the response. Valid options are:
            // Title: title only
            // Brief: Title + Source, Subjects
            // Detailed: Brief + full abstract
            'view'           => 'Detailed',
            // Specifies whether or not to include facets
            'includefacets'  => 'y',
            'resultsperpage' => '3',
            'pagenumber'     => '1',
            // Specifies whether or not to include highlighting in the search results
            'highlight'      => 'y',
            'expander'       => 'fulltext'
        );
        $params = array_merge($params, $query);
        $params = http_build_query($params);

$results = $api->apiSearch($params);
$_SESSION['pre-results'] = $results;
}
// Error
if (isset($results['error'])) {
    $error = $results['error'];
    $results =  array();
} else {
    $error = null;
}

$varables = array(
    'results'=> $results,
    'query'=>$searchTerm,
    'fieldCode'=>$fieldCode,
    'expander'=>$expander,
    'Info'    => $info
);
render('bento-box.html','blank.html',$varables);
?>