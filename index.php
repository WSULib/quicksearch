<?php

header('Content-type: text/html; charset=utf-8');


?>
<!doctype html>
<html lang="en">
<head>  
  <?php $_SERVER['DOCUMENT_ROOT'] .= '/'; include_once($_SERVER['DOCUMENT_ROOT'].'inc/varset.php'); ?>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
  <meta name="keywords" content="Wayne State University, WSU, Library System, Libraries" />
  <meta name="description" content="The online resources and services of the Wayne State University Libraries" />
  <meta name="author" content="libwebmaster@wayne.edu" />
  <meta name="Copyright" content="Copyright (c) <?php echo(date('Y')); ?> Wayne State University" />

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="/inc/img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/ico/style.css">
  <link href="//library.wayne.edu/inc/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/pattern-lib/css/style.css?date=<?php echo date('m/d/Y') ?>">

<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans|Noto+Sans|Gentium+Basic|Quattrocento" type="text/css">
<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:800,700,600,500,400,300' rel='stylesheet' type='text/css'>
 -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:600,400,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Noto+Sans:700,400,300' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <style>
        i {
        display:none;
        }
        input[class=input-large] {
        line-height: 1em;
        }

      </style>
      <script src="inc/bootstrap/js/html5shiv.js"></script>
      <script src="inc/bootstrap/js/respond.min.js"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> 

    <!--icon hash table -->
    <script type="text/javascript" src="js/icon_hash_table.js"></script>

    <!--load search query JS files-->
    <!--THESE CAN BE COMBINED LATER, EASIER TO WORK ON THIS WAY-->
    <script type="text/javascript" src="js/lib_hours.js"></script>
    <script type="text/javascript" src="js/books.js"></script>
    <script type="text/javascript" src="js/journals.js"></script>
    <script type="text/javascript" src="js/databases.js"></script>
    <script type="text/javascript" src="js/lib_guides.js"></script>
    <script type="text/javascript" src="js/site_search.js"></script>
    <script type="text/javascript" src="js/summonjs.js"></script>
    <script type="text/javascript" src="js/digi_collections.js"></script>
    <script type="text/javascript" src="js/digi_commons.js"></script>    

    <!--jquery cookie-->
    <script src="js/jquery.cookie.js"></script>


    <!--load bootstrap js   
    <script src="..inc/bootstrap/js/bootstrap.js"></script>-->
    <script src="inc/bootstrap/js/html5shiv.js"></script>
    <script src="inc/bootstrap/js/respond.min.js"></script> 

    <script src="/pattern-lib/js/enquire.min.js"></script>

  <script type='text/javascript'>
  $(window).load(function(){
  $(function(){   
          
      $("#submit").click(function(){
          $('#search-results').show();
      });  
      
      //alert(123);

  });
  });
  </script>

  <title>Wayne State University Libraries</title>

  <style>
  article.search-results {
    background:transparent;
    border:none;
  }
  </style>
</head>
<body ontouchstart="">  





<!-- 

<div id="mobile-menu">
  <div id="mobile-menu-nest">
    dfgad<br>
    dfgahfghdfgghd<br>
    dfgad<br>
    dfgad<br>
     dfgad<br>
    dfgghsghad<br>
    dfggfhdghgad<br>
    dfgad<br>
     dfgad<br>
    dfgadgfhgfgfhfgdh<br>
    dfgad<br>
    dfgad<br>
     dfgfhdghgad<br>
    dfgfghad<br>
    dfgfghdfghdad<br>
    dfgad<br>
     dfgfhdfggad<br>
    dffghfghhgfhfgad<br>
    dfghdfgad<br>
    dfhdfghgad<br>
     dfgvdgad<br>
    dfgfhdhgfgad<br>
    dfgad<br>
    dgfgfhhfgad<br>
     dfgad<br>
    dfggfhdfgad<br>
    dfgad<br>
    dfgad<br>
     dgfhdfgfhgfhgad<br>
    dfhdfggad<br>
    dfgad<br>
    dfgggad<br>
  </div>
</div> -->












  <div class="page" id="wrap">
      <?php 
        include($_SERVER['DOCUMENT_ROOT'].'inc/header.php'); 
      ?>
    <div id="main" class="container">
      <article class="search-results">
        <div id="search-spellcheck">
          
        </div>
        <div id="search-bestbet">
          <div>BEST RESULT</div>
          <div id="search-bestbet-answer"></div>
        </div>
        <div id="search-results" style="display:none;">

          <!--column1-->
          <div id="boxes_left" class="col-md-6 col-lg-4" style="padding-left:0;">           
            <div id="bestanswer" class="row-fluid pin">
              <h4><i class="icon-vcard"></i> Best Match<!-- <div id="bestmatch-why-button" style="display: inline-block;float: right;font-size: 16px;line-height: 21px;color: #666;cursor: pointer;">Why?</div>--></h4>
              <div class="box_loading_animation"></div>
              <div id="bestmatch-why-content"></div>
              <div class="box_results">
              </div>
            </div> 
            <div id="summonjs" class="row-fluid pin">
              <h4><i class="icon-articles"></i> Articles</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results">
              </div>
            </div> 
            <div id="databases" class="row-fluid pin">
              <h4><i class="icon-database"></i> Databases</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div>
            <div id="digi_commons" class="row-fluid pin">
              <h4><i class="icon-book"></i> DigitalCommons@WayneState</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div> 
          </div>

          <!--column2-->
          <div id="boxes_middle" class="col-md-6 col-lg-4">
            <div id="books" class="row-fluid pin">
              <h4><i class="icon-books"></i> Books and Media</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div>
            <div id="journals" class="row-fluid pin">
              <h4><i class="icon-journals"></i> Journals</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div>                                
            <div id="digi_collections" class="row-fluid pin">
              <h4><i class="icon-box"></i> Digital Collections</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div>     
          </div>

          <!--column3-->
          <div id="boxes_right" class="col-md-67 col-lg-4" style="padding-right:0;">
            <div id="lib_hours" class="row-fluid pin">
              <h4><i class="icon-clock"></i> Today's Hours</h4>
              <div id="hours" class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div>     
            <div id="reference" class="row-fluid pin">
              <h4><i class="icon-info"></i> General Information</h4>
              <div class="box_loading_animation"></div>
              <div id="ref_res" class="box_results"></div>
            </div>
            <div id="site_search" class="row-fluid pin">
              <h4><i class="icon-site"></i> WSU Site Search</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div> 
            <div id="lib_guides" class="row-fluid pin">
              <h4><i class="icon-guide"></i> Research Guides</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div>  
<!--             <div id="related-searches" class="row-fluid pin">
              <h4><i class="icon-forward"></i> Related Searches</h4>
              <div class="box_loading_animation"></div>
              <div class="box_results"></div>
            </div> -->
          </div>

         </div> <!-- closes search-results -->                     
      </article>
    </div> <!-- closes id main -->

  </div> <!-- closes id page wrap -->

  <?php include($_SERVER['DOCUMENT_ROOT'].'inc/footer.php'); ?>
  <script src="/pattern-lib/js/jquery.min.js"></script>
  <!-- <script src="/pattern-lib/js/jquery.history.js"></script>-->
  <script src="/pattern-lib/js/bootstrap.min.js"></script>
  <script src="/pattern-lib/js/main.js?date=<?php echo date('m/d/Y') ?>"></script> 

    <script type="text/javascript">

    enquire.register("screen and (min-width:1168px)", {
            match : function() {
              // left
              $("#bestbet").appendTo("#boxes_left");
              $("#summonjs").appendTo("#boxes_left");
              
              $("#databases").appendTo("#boxes_left");
              $("#digi_commons").appendTo("#boxes_left");

              // middle
              $("#books").appendTo("#boxes_middle");
              $("#journals").appendTo("#boxes_middle");
              //$("#lib_guides").appendTo("#boxes_middle");
              $("#digi_collections").appendTo("#boxes_middle");

              // right
              $("#lib_hours").appendTo("#boxes_right");
              $("#reference").appendTo("#boxes_right");
              $("#site_search").appendTo("#boxes_right");
              //$("#digi_collections").appendTo("#boxes_right");
              $("#lib_guides").appendTo("#boxes_right");
              //$("#related-searches").appendTo("#boxes_right");
            },
            unmatch : function() {

            }
        });

    enquire.register("(min-width:896px) and (max-width:1167px)", {
            match : function() { 
              // left              
              $("#bestbet").appendTo("#boxes_left");
              $("#summonjs").appendTo("#boxes_left");
              $("#databases").appendTo("#boxes_left");
              $("#journals").appendTo("#boxes_left");
              $("#lib_guides").appendTo("#boxes_left");
              $("#site_search").appendTo("#boxes_left");

              // middle
              $("#lib_hours").appendTo("#boxes_middle");
              $("#reference").appendTo("#boxes_middle");
              $("#books").appendTo("#boxes_middle");
              $("#digi_collections").appendTo("#boxes_middle");              
              $("#digi_commons").appendTo("#boxes_middle");

              //$("#related-searches").appendTo("#boxes_middle");
            },
            unmatch : function() {
              
            }
        });

    enquire.register("screen and (max-width:895px)", {
            match : function() { 
              // left              
              $("#bestbet").appendTo("#boxes_left");
              $("#lib_hours").appendTo("#boxes_left");
              $("#reference").appendTo("#boxes_left");
              $("#summonjs").appendTo("#boxes_left");
              $("#books").appendTo("#boxes_left");
              $("#databases").appendTo("#boxes_left");
              $("#journals").appendTo("#boxes_left");
              $("#lib_guides").appendTo("#boxes_left");
              $("#digi_collections").appendTo("#boxes_left");
              $("#digi_commons").appendTo("#boxes_left");              
              $("#site_search").appendTo("#boxes_left");

              //$("#related-searches").appendTo("#boxes_left");
            },
            unmatch : function() {
              
            }
        });

    </script>
   
</body>
<!--load main JS at bottom, overrides load from /inc/header.php for dev-->
<!-- Piwik -->  
  <script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(["trackPageView"]);
    _paq.push(["enableLinkTracking"]);

    (function() {
      var u=(("https:" == document.location.protocol) ? "https" : "http") + "://cgi.lib.wayne.edu/stats/piwik/";
      _paq.push(["setTrackerUrl", u+"piwik.php"]);
      _paq.push(["setSiteId", "16"]);
      var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
      g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <!-- End Piwik Code -->
<script type="text/javascript" src="js/bento_queries.js"></script>
<script type="text/javascript">
    updatePage("local");
  </script>
</html>
