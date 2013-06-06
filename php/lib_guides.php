   <div id="libGuideWidget"></div>
   <div id='api_search_guides_iid692' style="font-family: Tahoma,Verdana,Arial,sans-serif;"></div>
                    	  </div>
                    	    <script>
                    	    var searchterm = '<?php echo $_GET['search_string'] ?>';
                    	    var headID = document.getElementById("libGuideWidget");         
                    	    var newScript = document.createElement('script');
                    	    newScript.type = 'text/javascript';
                    	    newScript.src = 'http://api.libguides.com/api_search.php?iid=692&type=guides&search=' + searchterm + '&limit=3&desc=on&sortby=relevance&context=object&format=js';
                    	    headID.appendChild(newScript);
                    	    </script>