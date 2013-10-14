<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<link rel="shortcut icon" href="../../assets/ico/favicon.png">-->

    <title>WSU Library Bento Boxes</title>

    <!-- Bootstrap core CSS -->
    <link href="inc/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="inc/ico/style.css" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if IE]>
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
    <script type="text/javascript" src="js/icon_hash_table.js"></script>

    <!--load search query JS files-->
    <!--THESE CAN BE COMBINED LATER, EASIER TO WORK ON THIS WAY-->
    <script type="text/javascript" src="js/lib_hours.js"></script>
    <script type="text/javascript" src="js/articles.js"></script>
    <script type="text/javascript" src="js/books.js"></script>
    <script type="text/javascript" src="js/journals.js"></script>
    <script type="text/javascript" src="js/databases.js"></script>
    <script type="text/javascript" src="js/lib_guides.js"></script>
    <script type="text/javascript" src="js/site_search.js"></script>
    <script type="text/javascript" src="js/digi_collections.js"></script>
    <script type="text/javascript" src="js/digi_commons.js"></script>       

    <!--load main JS -->
    <script type="text/javascript" src="js/bento_queries.js"></script>

    <!--jquery cookie-->
    <script src="js/jquery.cookie.js"></script>


    <!--load bootstrap js-->    
    <script src="inc/bootstrap/js/bootstrap.js"></script>
    <script src="inc/bootstrap/js/html5shiv.js"></script>
    <script src="inc/bootstrap/js/respond.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> 
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300' rel='stylesheet' type='text/css'>

</head>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$(function(){   
        
    $("#submit").click(function(){
        $('#search-results').show();
    });  
    
});
});//]]>  

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


  <body>

    <header>
      <img src="img/warrior_logo1.png" alt="Wayne State University"/>
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
                </div>               
              <!-- </div> -->

    <script type="text/javascript">
// $('div.lib_hours:empty').hide()
 </script>

              <!--column1-->
              <div class="col-sm-6 col-md-4 col-lg-4">           
                <div id="articles" class="row-fluid pin">
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
              <div class="col-sm-6 col-md-4 col-lg-4">
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
              
              <!--column3-->
              <div class="col-sm-6 col-md-4 col-lg-4">               
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

             </div> <!--closes boxes_container-->
           </div> <!--closes boxes_row-->     
        
        </div><!--content col-lg-12-->

      </div> <!--all encompassing row -->

    </div><!--/.fluid-container-->   
   
  </body>

  <script type="text/javascript">
    updatePage();
  </script>
  
</html>


















