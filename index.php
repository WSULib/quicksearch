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
    <!--[if lt IE 9]>
      <script src="inc/bootstrap/js/html5shiv.js"></script>
      <script src="inc/bootstrap/js/respond.min.js"></script>
    <![endif]-->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    <!--icon hash table -->
    <script type="text/javascript" src="js/icon_hash_table.js"></script>

    <!--load search query JS files-->
    <!--THESE CAN BE COMBINED LATER, EASIER TO WORK ON THIS WAY-->
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
    $(".books").click(function() {
        $("#search_string").val('borrow books');
    });
    $(".gender").click(function() {
        $("#search_string").val('gender studies');
    });
    $(".journal").click(function() {
        $("#search_string").val('Journal of the Royal Society of Arts');
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
                <input id="search_string" type="text" class="input-large" placeholder="Find books, articles, journals, and more">
                <button id="submit" type="submit" class="btn">Find</button>
              </form>  

              <div class="examples">
                <p>Examples:
                <a href="#" class="books">borrow books</a>,
                <a href="#" class="gender">gender studies</a>,
                <a href="#" class="journal">Journal of the Royal Society of Arts</a></p>
              </div>

            </div>

          </div> <!--closes search row -->

          <div id="boxes_rows" class="row-fluid">

            <div id="search-results" style="display:none;" class="col-lg-12">

              <!--column1-->
              <div id="boxes_left" class="col-md-6 col-lg-4">           
                <div id ="articles" class="row-fluid pin">
                  <h4>Peer Reviewed Articles</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>                
                <div id="databases" class="row-fluid pin">
                  <h4>Databases</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>       
              </div>

              <!--column2-->
              <div id="boxes_middle" class="col-md-6 col-lg-4">
                <div id="books" class="row-fluid pin">
                  <h4>Books and Media</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>
                <div id="journals" class="row-fluid pin">
                  <h4>Journals</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>                                
                <div id="lib_guides" class="row-fluid pin">
                  <h4>Research Guides</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>               
              </div>

              <div id="boxes_right" class="col-md-6 col-lg-4">               
                <div id="site_search" class="row-fluid pin">
                  <h4>Site Search</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>  

                <div id="digi_commons" class="row-fluid pin">
                  <h4>DigitalCommons@WayneState</h4>
                  <div class="box_loading_animation"></div>
                  <div class="box_results"></div>
                </div>

               <!-- <div class="row-fluid">
                  <div id="digi_collections">
                    <h4>Digital Collections</h4>
                    <div class="box_loading_animation"></div>
                    <div class="box_results"></div>
                  </div>                
                </div>-->
              </div>

              <!--column3-->

             </div> <!--closes boxes_container-->
           </div> <!--closes boxes_row-->     
        
        </div><!--content col-lg-12-->

      </div> <!--all encompassing row -->

    </div><!--/.fluid-container-->   
   
  </body>

  <!--run query if included as GET parameter-->
  <?php
  $q = $_GET['q'];
  if ( isset($q) ){
    echo "<script type='text/javascript'>
      $(document).ready(function(){ 
        $('#search_string').val('$q');
        search(); 
      });
    </script>";
  }
  ?>
  
</html>
