<?php

set_time_limit($_REQUEST['to']);

include('app/app.php');
include('rest/EBSCOAPI.php');

$api = new EBSCOAPI();
$searchTerm = str_replace('"','',$_REQUEST['query']);
$fieldCode = $_REQUEST['fieldcode']? $_REQUEST['fieldcode'] :'';
$i = $_REQUEST['i'];
$name = $_REQUEST['bn'];
$actions = isset($_REQUEST['action']) ? $_REQUEST['action']: array();

if($actions[1] == "unavailable"){
    $action = array();
    $results = array();
}else{
$action = array();
if(!empty($actions)){
  $n=1;
  foreach($actions as $a){
        $action["action-$n"]=$a;
        $n++;
    }
}

$xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);
      //$boxes = $dom->getElementsByTagName('BentoBox');
       
      $commonp = $dom->getElementsByTagName('CommonSearchParametersForEachBentoBox');
     foreach ($commonp as $p) {
    $start = $p ->getElementsByTagName('PageNumber')->Item(0)->nodeValue;
    $limit = $p ->getElementsByTagName('ResultsPerPage')->Item(0)->nodeValue;
    $sortBy = isset($_REQUEST['sortBy'])?$_REQUEST['sortBy']:$p ->getElementsByTagName('Sort')->Item(0)->nodeValue;    
    $mode = $p ->getElementsByTagName('SearchMode')->Item(0)->nodeValue;
    $highlight = $p ->getElementsByTagName('Highlight')->Item(0)->nodeValue;
    $inclf = $p ->getElementsByTagName('IncludeFacets')->Item(0)->nodeValue;
    $amount =$p ->getElementsByTagName('View')->Item(0)->nodeValue;
    $expander = isset($_REQUEST['expander'])?$_REQUEST['expander']:$p ->getElementsByTagName('Expander')->Item(0)->nodeValue;
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
            'searchmode'     => 'all',
            // Specifies the amount of data to return with the response. Valid options are:
            // Title: title only
            // Brief: Title + Source, Subjects
            // Detailed: Brief + full abstract
            'view'           => 'detailed',
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
}
// Error
if (isset($results['error'])) {
    $error = $results['error'];
    $results =  array();
} else {
    $error = null;
}

//include 'app/views/boxview.html.php';

//print_r($results);

print_r($sessionToken);

?>

<?php
if (isset($_REQUEST['action'])) { 
$actions = $_REQUEST['action'];      
}

$i = $_REQUEST['i'];
  
  $xml ="Config.xml";
  $dom = new DOMDocument();
  $dom->load($xml);

  $boxes = $dom->getElementsByTagName('BentoBox');     
  foreach($boxes as $box){ 
      $description[] = $box -> getElementsByTagName('Description')->item(0)->nodeValue;
  } 
  
  $Items = $dom->getElementsByTagName('Item');
  foreach ($Items as $Item){
  $item[] = $Item->nodeValue;
  }
  $Headers = $dom->getElementsByTagName('Header');
  foreach($Headers as $Header){
  $header[] = $Header->nodeValue;
}    
  $length=$dom->getElementsByTagName('ItemLength')->item(0)->nodeValue;

?>

<?php if (empty($results['records'])) { ?>

<div id="out<?php echo $i ?>" style="margin: 10px; height: 170px">
  <div>
    <h4 title="<?php echo $description[$i] ?>" style="margin-bottom: 10px; background-color: lightgrey"><?php echo $_REQUEST['bn'] ?></h4>
  </div>         
  <div>
    <p>No articles results were found.  Please try another search in <a target="_blank" href="http://search.ebscohost.com/login.aspx?type=1&authtype=ip,guest&profile=eds&custid=s8440836&groupid=main">Research Warrior</a></p>
  </div>
</div>

<?php } else {   ?> 

  <?php $params = array(
      'query'=>$searchTerm,
      'fieldcode'=>$fieldCode,
      'expander'=>$_REQUEST['expander'],
      'sort'=>$sortBy,
      'c'=>$_REQUEST['bn'],
      'action'=>$actions
      ); 
  $params = http_build_query($params);
  ?>

    <?php
    if (count($results['records']) >= 3) {
        $n = 3;
    } else {
        $n = count($results['records']);
    }

    ?>
    <?php for ($z = 0; $z < $n; $z++) { ?>
                           
    <div class="indiv-result">

      <?php $result = $results['records'][$z]; ?>
      <?php 
       $params = array(
                               'query'=>$searchTerm,
                               'fieldcode'=>$fieldCode,
                               'highlight'=>$searchTerm,
                               'db'=>$result['DbId'],
                               'an'=>$result['An'],
                               'f'=>'box',
                               'bn'=>$name,
                               'resultId'=>$result['ResultId'],
                               'recordCount'=>$results['recordCount']                                                             
                               ); 
        $params = http_build_query($params);  
       ?>
          
      <p class="title">

      <?php if(!isset($_COOKIE['login'])&&$result['AccessLevel']=='1'){ ?> 
        
        <div id="trig<?php echo $z ?>" >Record from <b>[<?php echo $result['DbLabel']?>]</b>
        </div>
  
          <?php }else{                                               
              if (!empty($result['RecordInfo']['BibEntity']['Titles'])){ ?>
              <?php foreach($result['RecordInfo']['BibEntity']['Titles'] as $Ti){ 
                    $t = substr($Ti['TitleFull'], 0, 80) . '...';                                    
              ?>

             <a target="_blank" id="trig<?php echo $z ?>" href="<?php echo 'http://proxy.lib.wayne.edu/login?url=' . $result['PLink'] . '&scope=site' ?>"><?php echo  $t; ?></a>                                       
            <?php }}
            else {  ?>  
         
          <a target="_parent" id="trig<?php echo $z ?>"  href="<?php echo 'http://proxy.lib.wayne.edu/login?url=' . $result['PLink'] . '&scope=site' ?>"><?php echo "Title is not Available"; ?></a>

          <?php } ?> 
        <?php }?>                                                   
      </p> 

      <?php if (!empty($result['RecordInfo']['BibRelationships']['HasContributorRelationships'])) { ?>
  
      <div class="result-details">
        <p>            
          Authors: 
          
          <?php      
            echo $result['RecordInfo']['BibRelationships']['HasContributorRelationships'][0]['NameFull']; 
            echo "\n" . $result['RecordInfo']['BibRelationships']['HasContributorRelationships'][1]['NameFull'];                              
             if (!empty($result['RecordInfo']['BibRelationships']['HasContributorRelationships'][2])) {
               echo ", " . 'et al.'; 
           }
          ?>
        </p>

          <?php } ?>
          <?php if (!empty($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['date'])) { ?>
      
        <p>            
          Date: 

          <?php      
            echo $result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['date'][0]['D'] . '/'; 
            echo $result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['date'][0]['M'] . '/'; 
            echo $result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['date'][0]['Y']; 

          ?>
      
        </p>

          <?php } ?>     
          <?php if (!empty($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['Titles'][0]['TitleFull'])) { ?>
      
        <p>            
          Journal: 

          <?php      
            echo $result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['Titles'][0]['TitleFull']; 
          ?>
      
        </p>

          <?php } ?>
       
        <p>           
          <?php if (!empty($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['Titles'])) { 
                foreach($result['RecordInfo']['BibRelationships']['IsPartOfRelationships']['numbering'] as $numbering) {
                echo $numbering['Type'] . ': ' . $numbering['Value'] . ' ';



                }?>
        </p>
      </div>            
           
      <?php } ?>                                                                             
    </div>

    <?php } ?>
    
    <div>
      <em> 
        <a target="_blank" href="http://search.ebscohost.com/login.aspx?direct=true&scope=site&site=eds-live&authtype=ip,guest&custid=s8440836&groupid=main&profile=eds&bquery=<?php echo $searchTerm ?>&clv0=Y&cli0=RV">View more results...(<?php echo number_format($results['recordCount'])  ?>)</a>
      </em>
    </div>
</div>
<?php } ?>