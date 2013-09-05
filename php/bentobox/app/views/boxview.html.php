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
            
            function mousePosition(e){
                e = e || window.event;
                if(e.pageX||e.pageY){
                    return{x:e.pageX,y:e.pageY};
                }
                return{
                    x:e.pageX + document.body.scrollLeft - document.body.clientLeft,
                    y:e.pageY + document.body.scrollTop - document.body.clientTop
                };
            }
           
            function show_hover(aObj,popId,top,left){       
                var reps = document.getElementById(popId).innerHTML;
                parent.document.getElementById("popupBox0").style.top = top;
                parent.document.getElementById("popupBox0").style.left = left;
                parent.document.getElementById("popupBox2").innerHTML = reps;             
               
            }
                  
</script>
<script type="text/javascript">
  
(function($){
    $.fn.hoverDelay = function(options){
        var defaults = {
                hoverDuring: 200,
                outDuring: 200,
                hoverEvent: function(){
                    $.nope();
                },
                outEvent: function(){
                    $.noop();
                }
        };
        var sets = $.extend(defaults,options || {});
        var hoverTimer, outTimer, that = this;
        return $(this).each(function(){
            $(this).hover(function(){
                clearTimeout(outTimer);
                hoverTimer = setTimeout(function(){sets.hoverEvent.apply(that)},sets.hoverDuring);
            },function(){
                clearTimeout(hoverTimer);
                outTimer = setTimeout(function(){sets.outEvent.apply(that)},sets.outDuring);
            });
        });
    }
})(jQuery);

$(document).ready(function(){
    $("body").click(function(){
      $("#popupBox0",window.parent.document).hide();
  });
});
</script>
 
    </head>
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
    <body  onload="autoIframe('boxcontainer','fa<?php echo $i ?>','out<?php echo $i ?>')" style="background: white">
         <?php if (empty($results['records'])) { ?>
        <div id="out<?php echo $i ?>" style="margin: 10px; height: 170px">
                <div><h4 title="<?php echo $description[$i] ?>" style="margin-bottom: 10px; background-color: lightgrey"><?php echo $_REQUEST['bn'] ?></h4></div>         

                <div><center> <h5>No Results Found</h5></center></div>
        </div>
    <?php } else {   ?> 
            <div id="out<?php echo $i ?>" style="margin: 10px;">
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
                <a target="_parent" href="results.php?<?php echo $params ?>"><div><h4 title="<?php echo $description[$i] ?>" style="margin-bottom: 10px;background-color: lightgrey"><?php echo $_REQUEST['bn'] ?> (<?php echo number_format($results['recordCount'])  ?>)</h4></div></a>         
                <div id="title_1" class="title" style="display: block;">

                    <table id="table" style =" font-size: 100%">
                        <?php
                        if (count($results['records']) >= 5) {
                            $n = 5;
                        } else {
                            $n = count($results['records']);
                        }
                        if($i%3==0){
                          $left = '1px';
                          $top = (250 + $i/3*200) . 'px'; 
                        }
                        if(($i-1)%3==0){
                            $left = '280px';
                            $top = (250 + ($i-1)/3*200).'px';
                        }
                        if(($i+1)%3==0){
                            $left = '570px';
                            $top = (250 + ($i+1)/3*200-200).'px';
                        }
                        ?>
                        <?php for ($z = 0; $z < $n; $z++) { ?>
                            <tr>
<script type="text/javascript">

    $("#trig<?php echo $z ?>").ready(function(){
    var that = $(this);
        $("#trig<?php echo $z ?>").hoverDelay({
            hoverDuring: 1000,
            outDuring: 2000,
            hoverEvent: function(){              
                $("#popupBox0",window.parent.document).show();
            },
            outEvent: function(){
              //  $("#popupBox0",window.parent.document).hide();
            }
        });
    
    
});

</script>
                                     
                         <td>
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
                            <li>
                            <?php if(!isset($_COOKIE['login'])&&$result['AccessLevel']=='1'){ ?> 
                                <div id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')">Record from <b>[<?php echo $result['DbLabel']?>]</b></div>
                            <?php }else{                                                                                                                                                             
                                        if (!empty($result['RecordInfo']['BibEntity']['Titles'])){ ?>
                                    <?php foreach($result['RecordInfo']['BibEntity']['Titles'] as $Ti){ 
                                          $t = substr($Ti['TitleFull'], 0, 26) . '...';                                    
                                    ?>
                                       <a target="_parent" id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')" href="record.php?<?php echo $params ?>"><?php echo  $t; ?></a>
                                  <?php }}
                                  else {  ?>  
                                      <a target="_parent" id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')" href="record.php?<?php echo $params ?>"><?php echo "Title is not Aavailable"; ?></a>                                                         
                                 <?php } ?> 
                            <?php }?>                                                   
                            </li> 
                            <div id="hover<?php echo $z ?>"  style="display: none">
                                <div style="margin: 20px;">
                                <table class="hover">                                                                            
                                    <?php if(!isset($_COOKIE['login'])&&$result['AccessLevel']=='1'){ ?> 
                                     <div>This record from <b>[<?php echo $result['DbLabel']?>]</b> cannot be displayed to guests.<a target="_parent" id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')" href="login.php?path=record&<?php echo $params ?>">Login</a>for full access.</div>
                                    <?php }else{  
                                         if (!empty($result['Items'])){ 
                                             //Display Hover Elements
                                             foreach ($item as $hover) {  
                                              if (!empty($result['Items'][$hover])) { 
                                                   foreach($result['Items'][$hover] as $h){?>
                                            <tr>
                                                <td><strong><?php echo $h['Label'] ?>: </strong></td>
                                                <?php if($hover == 'Ab'){ ?>
                                                <td><?php echo substr($h['Data'], 0, $length).'...'   ?></td>
                                                <?php } else { ?>
                                                <td><?php echo $h['Data'] ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } }?>
                                    <?php } 
                                    
                                        foreach ($header as $hover) { ?> 
                                        <tr>
                                            <?php
                                            if ($hover == 'DbLabel') {
                                                $ch = 'Database';
                                            } else {
                                                $ch = $hover;
                                            }
                                            ?>
                                            <td><strong><?php echo $ch ?>: </strong></td>
                                            <td><?php echo $result[$hover] ?></td>
                                        </tr>
                                    <?php }                         
                                          } else { ?>
                                        <h5>Record Items are not available</h5>                
                                         <?php } ?>
                                    <?php } ?>                                                                                     
                                </table>
                           <?php if (!isset($_COOKIE['login'])&&$result['AccessLevel']=='1'){  
                                 // No display
                               }else {   ?>     
                                <div class="lastrow"><a  class="record-link"  target="_parent" href="record.php?<?php echo $params ?>"><strong>Detailed Record</strong></a></div>                                
                           <?php } ?>   
                               </div>
                            </div>
                            </td>
                            </tr>   
                        <?php } ?>
                    </table> 
                    <?php if(count($results['records']) > 5){ ?>
                    <div style="margin-top: 10px;">                   
                        <a id="expand"  href="#" onclick="return chg('title_1','title_2')"><img width="20px" height="20px" src="web/down-arrow.jpg"/></a>                   
                    </div>
                    <?php } ?>
                </div> 

                <div id="title_2" class="title" style="display: none">           
                    <table id="" style =" font-size: 100%;">
                        <?php
                        if (count($results['records']) >= 20) {
                            $n = 20;
                        } else {
                            $n = count($results['records']);
                        }
                        
                    
                        if($i%3==0){
                          $left = '1px';
                          $top = (250 + $i/3*200) . 'px'; 
                        }
                        if(($i-1)%3==0){
                            $left = '300px';
                            $top = (250 + ($i-1)/3*200).'px';
                        }
                        if(($i+1)%3==0){
                            $left = '570px';
                            $top = (250 + ($i+1)/3*200-200).'px';
                        }
                        ?>
                        <?php for ($z = 0; $z < $n; $z++) { ?>
                            <tr>
<script type="text/javascript">

    $("#trig<?php echo $z ?>").ready(function(){
    var that = $(this);
        $("#trig<?php echo $z ?>").hoverDelay({
            hoverDuring: 1000,
            outDuring: 2000,
            hoverEvent: function(){              
                $("#popupBox0",window.parent.document).show();
            },
            outEvent: function(){
               // $("#popupBox0",window.parent.document).hide();
            }
        });
    
    
});

</script>
                                <td>
                                    <?php $result = $results['records'][$z]; ?>
                            <li>
                            <?php if(!isset($_COOKIE['login'])&&$result['AccessLevel']=='1'){ ?> 
                                <div id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')">Record from <b>[<?php echo $result['DbLabel']?>]</b></div>
                            <?php }else{ ?> 
                                  <?php if (!empty($result['RecordInfo']['BibEntity']['Titles'])){ ?>
                                    <?php foreach($result['RecordInfo']['BibEntity']['Titles'] as $Ti){ 
                                          $t = substr($Ti['TitleFull'], 0, 26) . '...';                                    
                                    ?>
                                       <a target="_parent" id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')" href="record.php?<?php echo $params ?>"><?php echo  $t; ?></a>
                                  <?php }}
                                  else {   ?> 
                                      <a target="_parent" id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')" href="record.php?<?php echo $params ?>"><?php echo "Title is not Aavailable"; ?></a>
                                <?php   } ?> 
                            <?php }?>                                                   
                            </li>
                            <div id="hover<?php echo $z ?>"  style="display: none">
                                <div style="margin: 20px;">
                                <table class="hover">
                                    <?php if(!isset($_COOKIE['login'])&&$result['AccessLevel']=='1'){ ?> 
                                     <div>This record from <b>[<?php echo $result['DbLabel']?>]</b> cannot be displayed to guests.<a target="_parent" id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')" href="login.php?path=record&<?php echo $params ?>">Login</a>for full access.
                                    <?php }else{  
                                         if (!empty($result['Items'])){ 
                                             //Display Hover Elements
                                             foreach ($item as $hover) {  
                                              if (!empty($result['Items'][$hover])) { 
                                                   foreach($result['Items'][$hover] as $h){?>
                                            <tr>
                                                <td><strong><?php echo $h['Label'] ?>: </strong></td>
                                                <?php if($hover == 'Ab'){ ?>
                                                <td><?php echo substr($h['Data'], 0, $length).'...'   ?></td>
                                                <?php } else { ?>
                                                <td><?php echo $h['Data'] ?></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } }?>
                                    <?php } 
                                    
                                        foreach ($header as $hover) { ?> 
                                        <tr>
                                            <?php
                                            if ($hover == 'DbLabel') {
                                                $ch = 'Database';
                                            } else {
                                                $ch = $hover;
                                            }
                                            ?>
                                            <td><strong><?php echo $ch ?>: </strong></td>
                                            <td><?php echo $result[$hover] ?></td>
                                        </tr>
                                    <?php }                         
                                          } else { ?>
                                        <h5>Record Items are not available</h5>                
                                         <?php } ?>
                                    <?php } ?>                                                                                     
                                </table>
                           <?php if (!isset($_COOKIE['login'])&&$result['AccessLevel']=='1'){  
                                 // No display
                               }else {   ?>     
                                <div class="lastrow"><a  class="record-link"  target="_parent" href="record.php?<?php echo $params ?>"><strong>Detailed Record</strong></a></div>                                
                           <?php } ?>   
                               </div>
                            </div>
                            </td>
                            </tr> 
                        <?php } ?>
                    </table>            
                    <div style="margin-top: 10px;">                   
                        <a id="fold" onclick="chg('title_1','title_2')"  href="#"><img width="20px" height="20px" src="web/up-arrow.jpg"/></a>                   
                    </div>                
                </div> 
            </div>
        <?php } ?>
    </body>
</html>