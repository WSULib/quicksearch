<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>BentoBox Demo</title>
        <link rel="stylesheet" href="web/styles.css" type="text/css" media="screen" />
        <link rel="shortcut icon" href="web/favicon.ico" />
        <script type="text/javascript" src="jquery.js" ></script>       
    </head>
   <?php       
      $xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);
      
      $version = $dom->getElementsByTagName('Version')->item(0)->nodeValue;
      $expander = $dom->getElementsByTagName('Expander')->Item(0)->nodeValue;//Duplicated
      $boxes = $dom->getElementsByTagName('BentoBox');
      
      foreach($boxes as $box){ 
          $Name[] = $box ->getElementsByTagName('Label')->item(0)->nodeValue; 
          $searchActions = $box -> getElementsByTagName('Action');        
          $act = array();
          $flag = false;
          $i = 1;
          foreach($searchActions as $sat){             
              $sc = $sat->nodeValue;  
              
              foreach($results['facets'] as $facet){
                  if($facet['Label']=='Source Type'){
                      
                      foreach($facet['Values'] as $value){                          
                          if($value['Action']==$sc){
                               
                              $flag = true;
                              $act["action[$i]"]= $sc;
                              $i++;
                              break;
                          }
                      }
                      break;
                  }
              }
              
              foreach( $Info['limiters'] as $limiter){
                  if(str_replace("value","y",$limiter['Action'])==$sc){
                      $flag=true;
                      $act["action[$i]"]= $sc;
                      $i++;
                      break;
                  }
              }
              
              if(strstr($sc, "addlimiter(DT1:")){
                  $flag=true;
                      $act["action[$i]"]= $sc;
                      $i++;
                      break;
              } 
          }  
          if($flag == false) $act["action[1]"] = "unavailable";
          $Action[]=$act;
          $Timeout[] = $box -> getElementsByTagName('Timeout')->item(0)->nodeValue;
          $Description[] = $box -> getElementsByTagName('Description')->item(0)->nodeValue;   
          $Sort[] = $box -> getElementsByTagName('sortBy')->item(0)->nodeValue;
          $Status[] = $box -> getElementsByTagName('Status')->item(0)->nodeValue;
      } 
      $widegets = $dom->getElementsByTagName('Widget');
     
     foreach($widegets as $wideget){
         $id = $wideget->getElementsByTagName('ID')->Item(0)->nodeValue;
         $Widget[$id] = $wideget->getElementsByTagName('Title')->Item(0)->nodeValue;
         $key[$id] = $wideget->getElementsByTagName('Key')->Item(0)->nodeValue;
     }
     
     $back = '';
     if(isset($_REQUEST['back'])){
         $back = '&back=y';
     }
   ?>
    
    <body name="body" >
        <div class="container" >
          <div class="header">
            <div><a id="logo" href="index.php"></a></div>
            <?php if(!(isset($_COOKIE['login'])||isset($login))){ 
                $params = array(
                    'path'=>'box',
                    'query'=>$query,
                    'fieldcode'=>$fieldCode,
                    'expander'=>$expander,
                    
                );
                $params = http_build_query($params);
                ?>
            <div class="guestbox"><div>Hello, Guest.   
                   <a href="login.php?<?php echo $params?>">Login</a>                         
                    for full access.</div></div>
             <?php } ?>
            <?php if(isset($_COOKIE['login'])||isset($login)){ ?>                     
                    <div class="login"><a href="logout.php">Logout</a></div>                             
                   <?php } else { 
                       $params = array(
                    'path'=>'box',
                    'query'=>$query,
                    'fieldcode'=>$fieldCode,
                    'expander'=>$expander,
                    
                );
                $params = http_build_query($params);
                       ?>                  
                    <div class="login"><a href="login.php?<?php echo $params?>">Login</a></div>     
                    <?php }?>                              
        </div> 

        <div class="content">

<script type="text/javascript">
$(document).ready(function(){
    $("body").click(function(){
      $("#popupBox0").hide();
  });
});
 
</script>
<div id="toptabcontent" class="clearfix" >
    <div class="topSeachBox">
    <form action="pre-results.php">
    <p>
        <input type="text" name="query" style="width: 350px;" id="lookfor" value="<?php echo $query ?>"/>  
        <input type="hidden" name="expander" value="<?php echo $expander; ?>" />    
        <?php 
        $selected1 = '';
        $selected2 = '';
        $selected3 = '';
        if($fieldCode == 'keyword'){
            $selected1 = "selected = 'selected'";
        } 
        if($fieldCode == 'AU'){
            $selected2 = "selected = 'selected'";
        }
        if($fieldCode == 'TI'){
            $selected3 = "selected = 'selected'";
        } ?>
        <select name="fieldcode">
        <option id="type-keyword" name="fieldcode" value="keyword" <?php echo $selected1 ?> >Keyword</option>
        <?php if(!empty($Info['search'])){ ?>
        <?php foreach($Info['search'] as $searchField){
              if($searchField['Label']=='Author'){
                  $fieldc= $searchField['Code']; ?>
                  <option id="type-author" name="fieldcode" value="<?php echo $fieldc; ?>"<?php echo $selected2; ?> >Author</option>
        <?php }
              if($searchField['Label']=='Title'){
                  $fieldc = $searchField['Code']; ?>
                  <option id="type-title" name="fieldcode" value="<?php echo $fieldc; ?>"<?php echo $selected3 ?> >Title</option>     
        <?php      }
              } ?>
        <?php } ?>     
        </select>
        <input type="submit" value="Search" />
        
    </p>
    </form>
    </div>
    <div class="top-bar">
        <div class="floatleft"><strong>Bento Box results for:</strong>  <b><?php echo $query; ?></b></div>
        <div class="floatright">
            <?php 
            $params = array(
                'query'=>$query,
                'fieldcode'=>$fieldCode,
                'expander'=>$expander
            );
            $params = http_build_query($params);
            ?>
            <a href="results.php?<?php echo $params ?>" ><b>View All <?php echo number_format($results['recordCount']) ?> Results >></b></a>
        </div>
    </div>
    <div id="boxcontainer" class="boxcontainer clearfix">
        <!--<div id="popupBox0"  onclick="hidden()">
            <div style="text-align: right" id="popupBox1"><img src="web/close.png"/></div>
            <div id="popupBox2"></div>
        </div>-->
    
     <?php   
           
      $i = 0;
      
      foreach($Name as $name){                 
          $action = $Action[$i];
          $timeout = $Timeout[$i];
          $sortBy = $Sort[$i];
          $status = $Status[$i];
          
          if($i%3==0){
              echo '<div style="float: left;">';
              
          }
          
          $params = array(
              'query'=>$query,
              'fieldcode'=>$fieldCode,
              'expander'=>$expander,
              'bn'=>$name,
              'i'=>$i,
              'to'=>$timeout,
              'sortBy'=>$sortBy,
          );
          $params = array_merge($params,$action);
          $params = http_build_query($params);
       ?> 
        
        <?php if($status == 'regular'){ ?>
        <div class="frameWrapper" id="wrapper<?php echo $i ?>" name="wrapper">           
        <iframe id="fa<?php echo $i ?>" name="fa" src="box.php?<?php echo $params; ?><?php echo $back ?>" width="280px" scrolling="no"   ></iframe>     
        </div>
        <?php } else{ ?>
         <div class="frameWrapper" id="wrapper<?php echo $i ?>" name="wrapper">           
        <iframe id="fa<?php echo $i ?>" name="fa" src="individulbox.php?<?php echo $params; ?><?php echo $back ?>" width="280px" scrolling="no"   ></iframe>     
        </div>
        <?php } ?>
        
        
  <?php $i++;
      if($i%3==0&&$i>0){
          echo '</div>';
      }else if ($i == count($Name)){
           echo '</div>';
      }
       
  }
        
  $params = http_build_query(array('q'=>$query));
     ?> 
    <!--<div class="widgetsContainer">
<div class="widgets" id="Twitter">
<div style="margin-left: 5px;margin-right: 5px;background-color: lightgrey"><a target="_blank" href="https://twitter.com/#!/search/<?php echo $query ?>"><h4 style="margin-bottom: 0;" title="<?php echo  $Widget['1'] ?>"><?php echo  $Widget['1'] ?></h4></a></div>
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '<?php echo $query ?>',
  interval: 30000,
  title: 'Twitter Search: <?php echo $query ?>',
  subject: '',
  width: 'auto',
  height: 210,
  theme: {
    shell: {
      background: '#8ec1da',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#444444',
      links: '#1985b5'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    toptweets: true,
    behavior: 'all'
  }
}).render().start();
</script>
        </div>
            <div class="widgets" >
                <div style="margin-left: 5px;margin-right: 5px;background-color: lightgrey"><a target="_blank" href="http://www.flickr.com/search/?<?php echo $params ?>"><h4 title="<?php echo  $Widget['2'] ?>"><?php echo  $Widget['2'] ?></h4></a></div>
            <div><a href='http://www.flikr.com'><img src='web/flickr.png' /></a></div><br>
<script type="text/javascript">
var searchterm = '<?php echo $query ?>';
function jsonFlickrFeed(feed){
z='';
document.write('<br/>');
if(feed.items.length>0){
for (x=0; x<6; x++) {
tmp=feed.items[x].media.m;
tmp=tmp.replace(/_m.jpg/g,'_s.jpg');
z+='<a href="'+feed.items[x].link+'" target="_new"><img src="'+feed.items[x].media.m+'" alt="some img" width="85px" height="85px" style="margin: 3px;"></a>';
}
} else {
z+='<br/>No <a href="http://www.flickr.com">Flickr</a> images were found for <i>'+searchterm+'</i>.';
}
document.getElementById('flickrpics').style.display='block';
document.getElementById('flickrpics').innerHTML=z;
z='<a style="font-family: Verdana, Arial, Sans-Serif; font-size: .7em" href="http://www.flickr.com/search/?q='+searchterm+'" target="_blank">Find More @ Flickr</a>';
document.getElementById('flickrlink').style.display='block';
document.getElementById('flickrlink').innerHTML=z;
}
function searchFlickr() {
var headID = document.getElementsByTagName("head")[0];
var newScript = document.createElement('script');
newScript.type = 'text/javascript';
newScript.src = 'http://api.flickr.com/services/feeds/photos_public.gne?tags='+searchterm+'&format=json';
headID.appendChild(newScript);
return false;
}
searchFlickr();
</script>
<div style='border: 0;  display: none; text-align: center;' id='flickrpics'></div>
<div style="margin-top:9px" id='flickrlink'></div>
        </div>
            <div class="widgets" >
    <div style="margin-left: 5px;margin-right: 5px;background-color: lightgrey"><a target="_blank" href="http://www.worldcat.org/search?<?php echo $params ?> " ><h4 title="<?php echo  $Widget['3'] ?>"><?php echo  $Widget['3'] ?></h4></a></div>
<style type="text/css" media="all">
.rss_box {
  width: 185px;
  font-size: 8pt;
}
.rss_title, rss_title a {
}
.rss-items {
  list-style:none;
  margin:0;
  padding:0;
}
.rss-item {
  font-family: inherit;
  font-size: small;
  margin-bottom: 1em;
  
}
.rss_item a:link, .rss_item a:visited, .rss_item a:active {
  font-family: verdana, arial, sans-serif;
  font-size: 1.0em;
}
.rss_item a:hover {
}
.rss_date {
}
</style>

<script type="text/javascript">
var wsKey = '<?php echo $key['3'] ?>'; //This wsKey can be found in Config.xml with No.3 Widget.

var EP_SearchTerm = '<?php echo $query ?>';
EP_SearchTerm = EP_SearchTerm.replace( / /g, '%2B' );

var EP_WorldCat = 'http://feed2js.org//feed2js.php?src=http%3A%2F%2Fwww.worldcat.'
  + 'org%2Fwebservices%2Fcatalog%2Fsearch%2Fopensearch%3Fq%3D'
  + EP_SearchTerm + '%26format%3Drss%26cformat%3Dmla%26wskey%3D'
  + wsKey + '&num=10&targ=y&html=a';
if(wsKey==''){
    document.write( 'Error : The <b>wsKey</b> is Missing' );
}else{
document.write( '<script type="text/javascript" language="Javascript" src="'
  + EP_WorldCat + '"><' + '/script>' );
}
</script>
</div>  -->
        </div>
    </div>
</div>
</div>
            <div class="footer">        
            <div class="span-5">
               <table cellspacing="20px">               
              <tr>
              <td>
              <strong>Need Help?</strong>         
              </td>
              <td>
              <a href="#">Search Tips</a>
              </td>
              <td>
              <a href="#">Ask a Librarian</a>
              </td>
              <td>
              <a href="#">FAQs</a>
              </td>      
              </tr>
                </table>
           </div>
                <div class="version"><?php echo $version ?></div>
        </div>
        </div>
    </body>
    </html>