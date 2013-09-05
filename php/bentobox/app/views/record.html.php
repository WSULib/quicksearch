<?php
if($_REQUEST['f']=='box')$results = $_SESSION[$bn];
if($_REQUEST['f']=='results')$results = $_SESSION['current-results'];
$queryStringUrl = $results['queryString'];
$params = array(
    'db'=>$_REQUEST['db'],
    'an'=>$_REQUEST['an'],
    'highlight'=>$_REQUEST['highlight'],
    'resultId'=>$_REQUEST['resultId'],
    'recordCount'=>$_REQUEST['recordCount'],
    'f'=>$_REQUEST['f'],
    'query'=>$_REQUEST['query'],
    'fieldcode'=>$_REQUEST['fieldcode'],
    'bn'=>$bn
);
$paramsUrl = http_build_query($params);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>BentoBox Demo</title>
        <link rel="stylesheet" href="web/styles.css" type="text/css" media="screen" />
        <link rel="shortcut icon" href="web/favicon.ico" />
        <script type="text/javascript" src="jquery.js" ></script>       
    </head>

    <body name="body" onclick="hide()" >
        <div class="container">
        <div class="header">
             <div><a id="logo" href="index.php"></a></div>
            <?php if(!(isset($_COOKIE['login'])||isset($login))){ ?>
            <div class="guestbox">
                   <div>Hello, Guest.                             
                    <a href="login.php?path=record&<?php echo $paramsUrl ?>">Login</a>        
                    for full access.</div>
            </div>
             <?php } ?>
            <?php if(isset($_COOKIE['login'])||isset($login)){ ?>                     
                    <div class="login"><a href="logout.php">Logout</a></div>                             
                   <?php } else { ?>
                     <div class="login">
                        <a href="login.php?path=record&<?php echo $paramsUrl ?>">Login</a>
                     </div>                             
               <?php } ?>            
        </div>

        <div class="content">
<div id="toptabcontent">
    <div class ="topbar">   
        <?php $basicParams = array(
            'query'=>$_REQUEST['query'],
            'fieldcode'=>$_REQUEST['fieldcode']
        );
        $basicParams = http_build_query($basicParams);
        ?>
       <?php if($_REQUEST['f']=='results'){?><div style="padding-top: 6px; float: left" ><a style="color: #ffffff;margin-left: 15px;" href="results.php?<?php echo $basicParams?>&<?php echo $queryStringUrl?>&back=y"> << Back to Results</a></div><?php } ?>
       <?php if($_REQUEST['f']=="box"){ ?> <div style="padding-top: 6px; float: left" ><a style="color: #ffffff;margin-left: 15px;" href="pre-results.php?<?php echo $basicParams?>&back=y"> << Back to Bento Box</a></div> <?php } ?>
       <div style="float: right;margin: 7px 20px 0 0;color: white">        
           <?php if($_REQUEST['resultId']>1){  ?>
           <a href="recordSwich.php?<?php echo $basicParams?>&resultId=<?php echo ($_REQUEST['resultId']-1)?>&<?php echo $queryStringUrl; ?>&f=<?php echo $_REQUEST['f']?>&bn=<?php echo $bn?> "><span class="results-paging-previous">&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
            <?php }
            echo $_REQUEST['resultId'].' of '.$_REQUEST['recordCount'];
           if($_REQUEST['resultId']<$_REQUEST['recordCount']){  ?>
           <a href="recordSwich.php?<?php echo $basicParams?>&resultId=<?php echo ($_REQUEST['resultId']+1)?>&<?php echo $queryStringUrl; ?>&f=<?php echo $_REQUEST['f']?>&bn=<?php echo $bn?>"><span class="results-paging-next">&nbsp;&nbsp;&nbsp;&nbsp;</span></a>
           <?php   } ?>           
      </div>
    </div>
     <div class="record table" >
<?php if($debug=='y'){?>
    <div style="float:right; padding-bottom: 10px"><a target="_blank" href="debug.php?record=y">Retrieve response XML</a></div>
<?php } ?>
<?php if ($error) { ?>
    <div class="error">
        <?php echo $error; ?>
    </div>
<?php } ?>
<?php if((!isset($_COOKIE['login']))&&$result['AccessLevel']==1){ ?>
         <p>This record from <b>[<?php echo $result['DbLabel']; ?>]</b> cannot be displayed to guests.<br><a href="login.php?path=record&<?php echo $paramsUrl ?>">Login</a> for full access.</p>
<?php }else{ ?> 
    <h1>
      <?php if (!empty($result['Items'])) { 
        echo $result['Items'][0]['Data'];
       } ?>
    </h1>
    <div>
             <div class="table-cell floatleft">                 
                     <?php if(!empty($result['PLink'])){?>
                      <ul class="table-cell-box">
                      <li>
                          <a href="<?php echo $result['PLink'] ?>">
                        View in EDS
                        </a>
                      </li>
                      </ul>
                      <?php } ?>      
                   
                    <?php if(!empty($result['PDF'])||$result['HTML']==1){?>
                    <ul class="table-cell-box">
                    <label>Full Text:</label><hr/>
                    
                     <?php if(!empty($result['PDF'])){?>
                      <li>
                          <a target="_blank" class="icon pdf fulltext" href="PDF.php?an=<?php echo $result['An']?>&db=<?php echo $result['DbId']?>">
                        PDF full text
                        </a>
                      </li>
                      <?php } ?>
                      <?php if($result['HTML']==1){ ?>
                      <?php if(isset($_COOKIE['login'])){ ?> 
                      <li>
                          <a class="icon html fulltext" href="#html">
                        HTML full text
                        </a>
                      </li>
                          <?php } else{?>
                      <li>
                         <a target="_blank" class="icon html fulltext" href="login.php?path=HTML&<?php echo $paramsUrl?>">HTML Full Text</a>
                      </li>                      
                         <?php } ?>  
                      <?php } ?>
                      </ul>
                      <?php } ?>     
                 
                 <?php if (!empty($result['CustomLinks'])) { ?>                     
                      <ul class="table-cell-box">
                          <label>Custom Links:</label><hr/>
                            <?php foreach ($result['CustomLinks'] as $customLink) { ?>
                                <li>
                                    <a href="<?php echo $customLink['Url']; ?>" title="<?php echo $customLink['MouseOverText']; ?>"><img src="<?php echo $customLink['Icon']?>" /> <?php echo $customLink['Text']; ?></a>
                                </li>
                            <?php } ?>
                       </ul>
                      <?php } ?>
                      <?php if (!empty($result['FullTextCustomLinks'])) { ?>                     
                      <ul class="table-cell-box">
                          <label>Custom Links:</label><hr/>
                            <?php foreach ($result['FullTextCustomLinks'] as $customLink) { ?>
                                <li>
                                    <a href="<?php echo $customLink['Url']; ?>" title="<?php echo $customLink['MouseOverText']; ?>"><img src="<?php echo $customLink['Icon']?>" /> <?php echo $customLink['Text']; ?></a>
                                </li>
                            <?php } ?>
                       </ul>
                      <?php } ?>                 
             </div>
             <div style="margin-left: 20px" class="table-cell span-15">
              <table style="font-size: 95%">  
       <?php if (!empty($result['Items'])) { ?>
                                         
                     <?php for($i=1;$i<count($result['Items']);$i++) { ?>
                     <tr>
                         <td style="width: 150px; vertical-align: top"><strong>
                     <?php echo $result['Items'][$i]['Label']; ?>:
                       </strong></td>
                       <td>
                     <?php if($result['Items'][$i]['Label']=='URL'){ ?> 
                           <?php echo $result['Items'][$i]['Data'] ?>
                     <?php }else{ ?>   
                     <?php echo $result['Items'][$i]['Data']; ?>
                       </td>
                       <?php } ?>
                     </tr> 
                     <?php } ?>                                              
        <?php } ?>
        <?php if (!empty($result['PubType'])) { ?>
            <tr>
                <td><strong>
                    PubType:
            </strong></td>
                <td>
                    <?php echo $result['PubType']; ?>
                </td>
            </tr>
        <?php } ?>   
        <?php if (!empty($result['DbLabel'])) { ?>
            <tr>
                <td><strong>
                    Database:
            </strong></td>
                <td>
                    <?php echo $result['DbLabel']; ?>
                </td>
            </tr>
        <?php } ?>  
        <?php if((!isset($_COOKIE['login']))&&$result['AccessLevel']==2){ ?>
            <tr>
                <td><br></td>
                <td><br></td>
            </tr>
             <tr>
                 <td colspan="2">This record from <b>[<?php echo $result['DbLabel']; ?>]</b> cannot be displayed to guests.<br><a href="login.php?path=record&<?php echo $paramsUrl?>">Login</a> for full access.</td>
             </tr>
            <?php } ?>
        </table> 
         <?php if(!empty($result['htmllink'])){?>
         <div id="html" style="margin-top:30px">
             <?php echo $result['htmllink'] ?>
         </div>
         <?php } ?>
         </div>
             <div class="jacket floatright">
                <?php if(!empty($result['ImageInfo'])) { ?>              
                 <img width="150px" height="200px" src="<?php echo $result['ImageInfo']['medium']; ?>" />             
        <?php } ?>
             </div>
        </div>
<?php }?>         
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