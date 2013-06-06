<?php
//include('app/app.php');
include('rest/EBSCOAPI.php');

$api = new EBSCOAPI();
$look = str_replace('"','',$_REQUEST['lookfor']);
// Build  the arguments for the Search API method
$search = array(
    'lookfor' => $look,//replace('','"',$_REQUEST['lookfor']),
    'type'    => $_REQUEST['type']
);

$filters = isset($_REQUEST['filter']) ? $_REQUEST['filter']: array();

    /*session_start();*/
    $start = '1';
    $limit = '3';
    $sortBy = 'relevance';
    $amount ='detailed';
    $mode = 'all';
    $highlight = 'n';
    $inclf = 'n';
    $expander = 'fulltext';
// Global. variables
$path = "results.php";
$results = $api->apiSearch($search, $filters, $start, $limit, $sortBy, $amount, $mode,$highlight,$inclf,$expander);
//render('bento-box.html', 'layout.html');
$varable['results'] = $results;
//print_r($results);
?>                

</head>


      <?php 
        if (count($results['records']) >= 5) {
        $n = 5;
        } else {
        $n = count($results['records']);
        } 
      ?>
      <dl>
      <?php for ($z = 0; $z < $n; $z++) { ?>
          <?php $result = $results['records'][$z]; ?>

          <dt style="margin-top: 10px; font-weight: normal;">
            <a target="_blank" id="trig<?php echo $z ?>" href="<?php echo 'http://proxy.lib.wayne.edu/login?url=' . $result['PLink'] . '&scope=site' ?>">
              <?php
                if (!empty($result['Items']['Title'])) {
                  $t = substr($result['Items']['Title']['Data'], 0, 80);
                  echo $t;
                  if (strlen($result['Items']['Title']['Data']) > 80){
                  echo '...';
                  }                                        
                } else {
                  echo "Click for Title";
                  }
              ?>
            </a>
          </dt>  
          <?php if (!empty($result['Items']['Authors'])) { ?>
            <dd>            
              Authors: 
                <?php
                  $i=0;
                  while($i<=40)
                  {
                  echo $result['Items']['Authors']['Data'][$i];
                  $i++;
                  }
                  if (strlen($result['Items']['Authors']['Data']) > 40) {
                  echo '...';
                  }                         
                  ?>
            </dd>
          <?php } ?>

            <dd><?php if (!empty($result['Items']['Source'])) { ?>
              <div class="publication">
                Published: <?php echo $result['Items']['Source']['Data']; ?>
              </div>                      
                <?php } ?>
            </dd>                                
            <dd><?php if(!empty($result['PDF'])){?><img width="20" src="http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/PDF/content" alt=""/>PDF Fulltext<?php } ?></dd>
                <?php } ?>
      </dl> 
      <?php if(count($results['records']) >= 3){ ?>
        <div style="margin-top: 10px;">
          <a target="_blank" href="http://search.ebscohost.com/login.aspx?direct=true&scope=site&site=eds-live&authtype=ip,guest&custid=s8440836&groupid=main&profile=eds&bquery=<?php echo $_REQUEST['lookfor'] ?>&clv0=Y&cli0=RV"><div><em title="Peer Reviewed Articles" style="margin-bottom: 10px;"> View more results...(<?php echo number_format($results['recordCount'])  ?>)</em></div></a>                                
          <!--//&cli0=RV  stick in when working-->
        </div>
      <?php }
      // print_r($results);
?>