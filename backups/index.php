<?php


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>WSU Bento Boxes</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    <!--load search query JS files-->
    <!--THESE CAN BE COMBINED LATER, EASIER TO WORK ON THIS WAY-->
    <script type="text/javascript" src="js/articles.js"></script>
    <script type="text/javascript" src="js/books.js"></script>
    <script type="text/javascript" src="js/journals.js"></script>
    <script type="text/javascript" src="js/databases.js"></script>
    <script type="text/javascript" src="js/lib_guides.js"></script>
    <script type="text/javascript" src="js/site_search.js"></script>
    <script type="text/javascript" src="js/digi_collections.js"></script>

    <!--load main JS -->
    <script type="text/javascript" src="js/bento_queries.js"></script>

    <!--Local Overrides to Bootstrap defaults-->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>

    <!--Load Bootstrap-->
    <link href="inc/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="inc/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!--jquery cookie-->
    <script src="js/jquery.cookie.js"></script>
  
  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar">

    <!--load bootstrap js-->    
    <script src="inc/bootstrap/js/bootstrap.js"></script>

    <!--topbar-->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>          
          <a class="brand" href="./">WSU Lib Bento Boxes</a>          
          
          <div class="nav-collapse collapse">
            <ul class="nav pull-right">              
              <li style="color:white; padding-right:10px;"><a target="_blank" href="https://docs.google.com/drawings/d/1Fvn_NSKLA0dVv4DCd7MtaEWr6ErpyNas5U2aBSoxIPY/edit?usp=sharing">model</a></li>
            </ul>
          </div> --><!--/.nav-collapse-->

        </div>
      </div>
    </div>

    <div class="container-fluid">      
      <div class="row-fluid">

        <!--side column *****************************************************************************************************************-->
        <div class="span3" id="side_nav">
          
          <!--sidebar-->
          <!-- <div class="row-fluid">            
            <div class="well sidebar-nav">
              <ul class="nav nav-list">
                <li class=""><a href="/linkPad/">All</a></li>
              </ul>
            </div>
          </div>  -->          

        </div><!--/side column span -->

        <!--content span ****************************************************************************************************************-->
        <div id="mainContent" class="span12">        
        
          <div id="search_row" class="row-fluid">

            <div id="searchForm" class="span5">
              <form class="form-search" onsubmit="search(); return false;">
                <input id="search_string" type="text" class="input-medium" value="biology">
                <button type="submit" class="btn">Search</button>
              </form>                        
            </div>

          </div> <!--closes search row -->

          <div id="boxes_rows" class="row-fluid">

            <div id="boxes_container" class="span12">

              <div id="boxes_left" class="span5">              
                <div class="row-fluid">
                  <div id="articles" class="well">
                    <h4>Peer Reviewed Articles</h4>
                    <div class="box_results"></div>
                  </div>
                </div>                
                <div class="row-fluid">
                  <div id="journals" class="well">
                    <h4>Journals</h4>
                    <div class="box_results"></div>
                  </div>
                </div>
                <div class="row-fluid">
                  <div id="databases" class="well">
                    <h4>Databases</h4>
                    <div class="box_results"></div>
                  </div>
                </div>
              </div>

              <div id="boxes_right" class="span5">
                <div class="row-fluid">
                  <div id="books" class="well">
                    <h4>Books and Media</h4>
                    <div class="box_results"></div>
                  </div>
                </div>  
                <div class="row-fluid">
                  <div id="lib_guides" class="well">
                    <h4>Research Guides</h4>
                    <div class="box_results"></div>
                  </div>
                </div>
                <div class="row-fluid">
                  <div id="site_search" class="well">
                    <h4>Site Search</h4>
                    <div class="box_results"></div>
                  </div>
                </div>                
                <div class="row-fluid">
                  <div id="digi_collections" class="well">
                    <h4>Digital Collections</h4>
                    <div class="box_results"></div>
                  </div>                
                </div>
              </div>

             </div> <!--closes boxes_container-->
           </div> <!--closes boxes_row-->                                       
        
        </div><!--content span12-->

      </div> <!--all encompassing row -->

    </div><!--/.fluid-container-->   
    
  </body>
  
</html>
