<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Search</title>
        <link rel="stylesheet" href="web/styles.css" type="text/css" media="screen" />
        <link rel="shortcut icon" href="web/favicon.ico" />
        <script type="text/javascript" src="jquery.js" ></script>     
        <script type="text/javascript">
            
            function chg(id_num_1,id_num_2){
                var oa = document.getElementById(id_num_1);
                var ob = document.getElementById(id_num_2);
           
                if(oa.style.display == "block"){
                    oa.style.display = "none";
                    ob.style.display = "block";
                    autoIframe("boxcontainer","fa<?php echo $i ?>","out<?php echo $i ?>");
                }else {
                    oa.style.display = "block";
                    ob.style.display = "none";
                    autoIframe("boxcontainer","fa<?php echo $i ?>","out<?php echo $i ?>");
                }
                return false;
            }
               
            function autoIframe(divId,iframeId,childDiv){
                divObj = parent.document.getElementById(divId);
                childdivObj = document.getElementById(childDiv);
                iframeObj = parent.document.getElementById(iframeId);
                iframeObj.height = childdivObj.offsetHeight+30;
                divObj.style.height = childdivObj.offsetHeigh+50;
            } 
            
             function expand(popId){          
                var reps = document.getElementById(popId).innerHTML;     
                parent.document.getElementById("expand").style.visibility = "visible";
                parent.document.getElementById("expand").innerHTML = reps;                   
            }
                        
</script>

    </head>
    <?php
    $xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);

      $boxes = $dom->getElementsByTagName('BentoBox');
      foreach($boxes as $box){ 
          $description[] = $box -> getElementsByTagName('Description')->item(0)->nodeValue;
      } 
      $blacklist= $dom->getElementsByTagName('Blacklist')->item(0)->nodeValue;
     
    $i = $_REQUEST['i'];
    ?>   
    <?php //session_start();  ?>
    <body  onload="autoIframe('boxcontainer','fa<?php echo $i ?>','out<?php echo $i ?>')" style="background: white">
         <?php if (empty($results['facets'])) { ?>
        <div id="out<?php echo $i ?>" style="margin: 10px; height: 170px">
                <div><h4 title="<?php echo $description[$i] ?>" style="margin-bottom: 10px; background-color: lightgrey"><?php echo $_REQUEST['bn'] ?></h4></div>         

                <div><center> <h5>No Results Found</h5></center></div>

    <?php } else {
        
            foreach($results['facets'] as $facet){
                if(!empty($facet['Label'])&&$facet['Label']==$facetName){ ?>
                   <div id="out<?php echo $i ?>" style="margin: 10px;">
               <div><h4 title="<?php echo $description[$i] ?>" style="margin-bottom: 10px;background-color: lightgrey"><?php echo $_REQUEST['bn'] ?></h4></div>        
                <div id="title_1" class="title" style="display: block;">
<?php if($_REQUEST['bn']=='Subject Terms'){ 
                         $list = array();
                         foreach($facet['Values']as $facetV){
                             if(strstr($blacklist,$facetV['Value'])){
                                 
                             }else {
                                 $list[] = $facetV;
                             }
                         }          
                   ?>
                     <table id="table" style =" font-size: 100%">
                        <?php
                        if (count($facet['Values']) >= 5) {
                            $n = 5;
                        } else {
                            $n = count($facet['Values']);
                        }                   
                        ?>
                        <?php for ($z = 0; $z < $n; $z++) { ?>
                            <tr>
                                <td>
                                    <?php $facetValue = $list[$z]; ?>
                                    <?php 
                                    $params = array(
                                        'query'=>$searchTerm,
                                        'fieldcode'=>$fieldCode,
                                        'action[]'=>$facetValue['Action'],
                                        'sortby'=>$sortBy,
                                        'expander'=>$expander
                                    );
                                    $params = http_build_query($params);
                                    ?>
                            <li><a target="_parent" id="trig"  href="results.php?<?php echo $params ?>">
                                    <?php
                                    if (!empty($facetValue['Value'])) {
                                        $t = substr($facetValue['Value'], 0, 26) . '...';
                                        echo $t;
                                    } else {
                                        echo "Facets's name is not Aavailable";
                                    }
                                    ?>
                                </a></li>                       
                            </td>
                            </tr>   
                        <?php } ?>
                    </table>                      
                <?php  } else { ?> 
                    <table id="table" style =" font-size: 100%">
                        <?php
                        if (count($facet['Values']) >= 5) {
                            $n = 5;
                        } else {
                            $n = count($facet['Values']);
                        }                   
                        ?>
                        <?php for ($z = 0; $z < $n; $z++) { ?>
                            <tr>
                                <td>
                                    <?php $facetValue = $facet['Values'][$z]; ?>
                                    <?php 
                                    $params = array(
                                        'query'=>$searchTerm,
                                        'fieldcode'=>$fieldCode,
                                        'action[]'=>$facetValue['Action'],
                                        'sortby'=>$sortBy,
                                        'expander'=>$expander
                                    );
                                    $params = http_build_query($params);
                                    ?>
                            <li><a target="_parent" id="trig"  href="results.php?<?php echo $params ?>">
                                    <?php
                                    if (!empty($facetValue['Value'])) {
                                        $t = substr($facetValue['Value'], 0, 26) . '...';
                                        echo $t;
                                    } else {
                                        echo "Facets's name is not Aavailable";
                                    }
                                    ?>
                                </a></li>                       
                            </td>
                            </tr>   
                        <?php } ?>
                    </table> 
                    <?php } ?>
                    <?php if(count($facet['Values']) >= 5){ ?>
                    <div style="margin-top: 10px;">                   
                        <a id="expand"  href="#" onclick="return chg('title_1','title_2')"><img width="20px" height="20px" src="web/down-arrow.jpg"/></a>                   
                    </div>
                    <?php } ?>
                </div> 

                <div id="title_2" class="title" style="display: none">     
                    <?php if($_REQUEST['bn']=='Subject Terms'){ 
                         $list = array();
                         foreach($facet['Values']as $facetV){
                             if(strstr($blacklist,$facetV['Value'])){
                                 
                             }else {
                                 $list[] = $facetV;
                             }
                         }          
                   ?>
                     <table id="" style =" font-size: 100%;">
                        <?php
                        if (count($facet['Values']) >= 20) {
                            $n = 20;
                        } else {
                            $n = count($facet['Values']);
                        }
                   
                        ?>
                        <?php for ($z = 0; $z < $n; $z++) { ?>
                            <tr>
                                <td>
                                    <?php $facetValue = $list[$z]; ?>
                                    <?php 
                                    $params = array(
                                        'query'=>$searchTerm,
                                        'fieldcode'=>$fieldCode,
                                        'action[]'=>$facetValue['Action'],
                                        'sortby'=>$sortBy,
                                        'expander'=>$expander
                                    );
                                    $params = http_build_query($params);
                                    ?>
                            <li><a target="_parent"  href="results.php?<?php echo $params ?>">
                                    <?php
                                    if (!empty($facetValue['Value'])) {
                                        $t = substr($facetValue['Value'], 0, 26) . '...';
                                        echo $t;
                                    } else {
                                        echo "Facet's name is not Available";
                                    }
                                    ?>
                                </a></li>                           
                            </td>
                            </tr> 
                        <?php } ?>
                    </table>                      
                <?php  } else { ?> 
                    <table id="" style =" font-size: 100%;">
                        <?php
                        if (count($facet['Values']) >= 20) {
                            $n = 20;
                        } else {
                            $n = count($facet['Values']);
                        }
                   
                        ?>
                        <?php for ($z = 0; $z < $n; $z++) { ?>
                            <tr>
                                <td>
                                    <?php $facetValue = $facet['Values'][$z]; ?>
                                    <?php 
                                    $params = array(
                                        'query'=>$searchTerm,
                                        'fieldcode'=>$fieldCode,
                                        'action[]'=>$facetValue['Action'],
                                        'sortby'=>$sortBy,
                                        'expander'=>$expander
                                    );
                                    $params = http_build_query($params);
                                    ?>
                            <li><a target="_parent"  href="results.php?<?php echo $params ?>">
                                    <?php
                                    if (!empty($facetValue['Value'])) {
                                        $t = substr($facetValue['Value'], 0, 26) . '...';
                                        echo $t;
                                    } else {
                                        echo "Facet's name is not Available";
                                    }
                                    ?>
                                </a></li>                           
                            </td>
                            </tr> 
                        <?php } ?>
                    </table> 
                    <?php } ?>
                    <div style="margin-top: 10px;">                   
                        <a id="fold" onclick="chg('title_1','title_2')"  href="#"><img width="20px" height="20px" src="web/up-arrow.jpg"/></a>                   
                    </div>                
                </div> 
            </div>
                        
      <?php         }   
                      
                }
            }      ?> 
            
        
    </body>
</html>

