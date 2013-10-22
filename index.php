<!DOCTYPE html>
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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="../../assets/ico/favicon.png">-->

    <title>Wayne State University Libraries Quicksearch</title>

    <!-- Bootstrap core CSS -->
    <link href="../resources/quicksearch/inc/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="../resources/quicksearch/inc/ico/style.css" />

    <!-- Custom styles for this template -->
    <link href="../resources/quicksearch/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <style>
        i {
        display:none;
        }
        input[class=input-large] {
        line-height: 18px;
        padding: 10px 15px;
        }

      </style>
      <script src="inc/bootstrap/js/html5shiv.js"></script>
      <script src="inc/bootstrap/js/respond.min.js"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    <!--icon hash table -->
    <script type="text/javascript" src="../resources/quicksearch/js/icon_hash_table.js"></script>

    <!--load search query JS files-->
    <!--THESE CAN BE COMBINED LATER, EASIER TO WORK ON THIS WAY-->
    <script type="text/javascript" src="../resources/quicksearch/js/lib_hours.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/articles.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/books.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/journals.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/databases.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/lib_guides.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/site_search.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/digi_collections.js"></script>
    <script type="text/javascript" src="../resources/quicksearch/js/digi_commons.js"></script>       

    <!--load main JS -->
    <script type="text/javascript" src="../resources/quicksearch/js/bento_queries.js"></script>

    <!--jquery cookie-->
    <script src="../resources/quicksearch/js/jquery.cookie.js"></script>


    <!--load bootstrap js-->    
    <script src="../resources/quicksearch/inc/bootstrap/js/bootstrap.js"></script>
    <script src="../resources/quicksearch/inc/bootstrap/js/html5shiv.js"></script>
    <script src="../resources/quicksearch/inc/bootstrap/js/respond.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

<script type='text/javascript'>
$(window).load(function(){
$(function(){   
        
    $("#submit").click(function(){
        $('#search-results').show();
    });  
    
});
});

$().ready(function() {
    $(".hours").click(function() {
        $("#search_string").val('ugl hours').trigger("submit");
        $("#search-results").show();

    });
    $(".gender").click(function() {
        $("#search_string").val('gender studies').trigger("submit");
        $("#search-results").show();
    });
    $(".journal").click(function() {
        $("#search_string").val('Journal of the Royal Society of Arts').trigger("submit");
        $("#search-results").show();
    });

    $(".clear-search").on("click", function() {
        $("#search_string").val("")
    });
});


</script>


</head>




  <body>

    <header>
      <img src="../resources/quicksearch/img/warrior_logo1.png" alt="Wayne State University"/>
    </header>
    <div class="container">      
      <div class="row-fluid">   
        
          <div id="search_row" class="row-fluid">

            <div id="searchForm" class="col-lg-12">
              <form id="search" class="form-wrapper" onsubmit="searchCall(); return false;">
                <input id="search_string" type="text" class="input-large" placeholder="Find articles, books, journals and more">
                <span class="clear-search">X</span>
                <button id="submit" type="submit" class="btn">Find</button>
              </form>  
                

              <div class="examples">
                <p>Examples:
                <a href="#" class="hours">ugl hours</a>,
                <a href="#" class="gender">gender studies</a>,
                <a href="#" class="journal">Journal of the Royal Society of Arts</a></p>
              </div>

            </div>

          </div> <!--closes search row -->

          <div id="boxes_rows" class="row-fluid">            
            <div id="search-results" style="display:none;" class="col-lg-12">

              <!-- <div id="boxes_middle" class="col-md-6 col-lg-4">
                <div id="lib_hours" class="row-fluid pin-hours">
                  <div id="hours" class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>  -->             
              <!-- </div> -->

    <script type="text/javascript">
// $('div.lib_hours:empty').hide()
 </script>

              <!--column1-->
              <div id="boxes_left" class="col-md-6 col-lg-4">           
                <div id ="articles" class="row-fluid pin">
                  <h4><i class="icon-article"></i> Peer Reviewed Articles</h4>
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
                  <h4><i class="icon-book"></i> Books and Media</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>
                <div id="journals" class="row-fluid pin">
                  <h4><i class="icon-notebook"></i> Journals</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>                                
                <div id="lib_guides" class="row-fluid pin">
                  <h4><i class="icon-map"></i> Research Guides</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>               
              </div>

              <div id="boxes_right" class="col-md-6 col-lg-4">               
                <div id="site_search" class="row-fluid pin">
                  <h4><i class="icon-globe"></i> WSU Site Search</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>  
                <div id="databases" class="row-fluid pin">
                  <h4><i class="icon-server"></i> Databases</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>                
              </div>

              <!--column3-->

             </div> <!--closes boxes_container-->
           </div> <!--closes boxes_row-->     
        
        </div><!--content col-lg-12-->

      </div> <!--all encompassing row -->

    <!--</div>/.fluid-container-->   
   
  </body>

 <script type="text/javascript">
    updatePage();
  </script>
  
</html>


















