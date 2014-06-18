<!doctype html>
<html lang="en">
<head>
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
  <?php include_once($_SERVER['DOCUMENT_ROOT'].'inc/varset.php'); ?>
  <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Wayne State University, WSU, Library System, Libraries" />
  <meta name="description" content="The online resources and services of the Wayne State University Libraries" />
  <meta name="author" content="libwebmaster@wayne.edu" />
  <meta name="Copyright" content="Copyright (c) <?php echo(date('Y')); ?> Wayne State University" />

  <link rel="icon" href="/inc/img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/ico/style.css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/pattern-lib/css/style.css">


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
    <script src="js/jquery.ba-replacetext.min.js"></script>


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
<body>  
  <div class="page" id="wrap">
      <?php 
        include($_SERVER['DOCUMENT_ROOT'].'inc/header.php'); 
      ?>
    <div id="main" class="container">     
      <article class="search-results">        

            <div id="search-results" style="display:none;">

              <!--column1-->
              <div id="boxes_left" class="col-md-6 col-lg-4" style="padding-left:0;">           
                <div id="summonjs" class="row-fluid pin">
                  <h4><i class="icon-articles"></i>Articles</h4>
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
                  <h4>DigitalCommons@WayneState</h4>
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
                <div id="lib_guides" class="row-fluid pin">
                  <h4><i class="icon-guide"></i> Research Guides</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>               
              </div>

              <!--column3-->
              <div id="boxes_right" class="col-md-6 col-lg-4" style="padding-right:0;">
                <div id="lib_hours" class="row-fluid pin">
                  <h4><i class="icon-clock"></i>Today's Hours</h4>
                  <div id="hours" class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>     
                <div id="reference" class="row-fluid pin">
                  <h4><i class="icon-info"></i>General Information</h4>
                  <div class="box_loading_animation"></div>
                  <div id="ref_res" class="box_results"></div>
                </div>
                <div id="site_search" class="row-fluid pin">
                  <h4><i class="icon-site"></i> WSU Site Search</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div> 
                <div id="digi_collections" class="row-fluid pin">
                  <h4><i class="icon-box"></i> Digital Collections</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>   
              </div>

             </div> <!--closes boxes_container-->
           </div> <!--closes search-results-->     
          
      </article>
    </div>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'inc/footer.php'); ?>
  <script src="/pattern-lib/js/jquery.min.js"></script>
  <script src="/pattern-lib/js/bootstrap.min.js"></script>
  <script src="/pattern-lib/js/main.js"></script>

  <script type="text/javascript">

  enquire.register("screen and (min-width:1168px)", {
            match : function() { 
                    
            },
            unmatch : function() {
                    
            }
        });

    enquire.register("(min-width:896px) and (max-width:1167px)", {
            match : function() { 
                    $('#reference').insertBefore('#books');
                    $('#lib_hours').insertBefore('#reference');
                    $('#journals').insertAfter('#databases');
                    $('#lib_guides').insertAfter('#journals');
                    $('#site_search').insertAfter('#lib_guides');
                    $('#digi_collections').insertAfter('#books');
                    $('#digi_commons').insertAfter('#digi_collections');
            },
            unmatch : function() {
                    $('#reference').insertAfter('#lib_hours');
                    $('#journals').insertBefore('#lib_guides');
                    $('#digi_commons').insertAfter('#site_search');
                    $('#site_search').insertAfter('#reference');
                    $('#lib_hours').insertBefore('#reference');
            }
        });

    enquire.register("screen and (max-width:895px)", {
            match : function() { 
                    $('#reference').insertBefore('#summonjs');
                    $('#lib_hours').insertBefore('#reference');
                    $('#books').insertAfter('#summonjs');
                    $('#journals').insertAfter('#databases');
                    $('#lib_guides').insertAfter('#journals');
                    $('#digi_commons').insertAfter('#digi_collections');
                    $('#site_search').insertAfter('#digi_commons');
            },
            unmatch : function() {
                    $('#reference').insertAfter('#lib_hours');
                    $('#journals').insertBefore('#lib_guides');
                    $('#digi_commons').insertAfter('#site_search');
                    $('#site_search').insertAfter('#reference');
                    $('#lib_hours').insertBefore('#reference');
            }
        });

    </script>
   
</body>
<!--load main JS at bottom, overrides load from /inc/header.php for dev-->
<script type="text/javascript" src="js/bento_queries.js"></script>
<script type="text/javascript">
    updatePage("local");
  </script>
</html>