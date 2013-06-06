<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bento Boxes</title>
        <link rel="stylesheet" href="web/styles.css" type="text/css" media="screen" />
        <link rel="shortcut icon" href="web/favicon.ico" />
        <script type="text/javascript" src="jquery.js" ></script>       
    </head>
   
    <body name="body" >
        <div class="container" >
          <div class="header">
            <a id="logo" href="basic_search.php"></a>
          </div>

        <div class="content">

       <?php /* print_r($results); */ ?>
        
        
<div id="toptabcontent" class="clearfix" >
    <div class="topSeachBox">
    <form action="ep-results.php">
    <p>
        <input type="text" name="lookfor" style="width: 350px;" id="lookfor" value="<?php echo $lookfor ?>"/>              
        <input type="submit" value="Go!" />
        
    </p>
    </form>
    </div>
        <div class="EDS-Box" style="width: 300px">
        
        <div><h4 title="Everything (Research Warrior)" style="margin-bottom: 10px; background-color: lightgrey; width: 280px">Everything (Research Warrior)</h4></div> 

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

                                <td>
                                    <?php $result = $results['records'][$z]; ?>
                                    
                            <div class="bookImage" style="margin: 10px; float: right; text-align: center;">
			   
                                 <?php $result = $results['records'][$z]; ?>
                            	 <?php if(!empty($result['ImageInfo'])) { ?> 
                            	 
                            	 <a target="_parent" id="trig<?php echo $z ?>" href="<?php echo $result['PLink']?>">
                            	 
				 <img src="<?php echo $result['ImageInfo']['thumb']; ?>" />             
				 <?php } ?>        
                            </div>
                                    
                            <dl>
                            <dt style="font-weight: normal;">
                            	<a target="_parent" id="trig<?php echo $z ?>" onmouseover="show_hover(this,'hover<?php echo $z ?>','<?php echo $top ?>','<?php echo $left ?>')" href="<?php echo 'http://proxy.lib.wayne.edu/login?url=' . $result['PLink'] ?>">
                                    <?php
                                    if (!empty($result['Items']['Title'])) {
                                        $t = substr($result['Items']['Title']['Data'], 0, 80);
                                        echo $t;
                                        if (strlen($result['Items']['Title']['Data']) > 80){
                                        echo '...';
					}                                        
                                    } else {
                                        echo "Title is not Aavailable";
                                    }
                                    ?>
                                </a>
                             </dt>
                                <?php if (!empty($result['Items']['Authors'])) { ?>
                                <dd>     		
                                          Authors: 
                                          <?php
                                          $i=0;
                                          while($i<=40)
                                           {
                                            echo $result['Items']['Authors']['Data'][$i];
                                            $i++;
                                           }
                                           if (strlen($result['Items']['Authors']['Data']) > 40) {
                                           	   echo '...';
                                           }
                                          
                                          ?>
                                  </dd>
                                   <?php } ?>
                               
                             	
                             	
                                
                               <dd><?php if (!empty($result['Items']['Source'])) { ?>
                                      <div class="publication">
                                          Published: <?php echo $result['Items']['Source']['Data']; ?>
                                      </div>                      
                                   <?php } ?>
                               </dd>                                
                                
                               <dd><?php if(!empty($result['PDF'])){?><img class="icon pdf fulltext" alt=""/>PDF Fulltext<?php } ?></dd>

                                
                            </dl> 

                            </td>
                            </tr>   
                        <?php } ?>
                    </table> 
                   <?php if(count($results['records']) >= 3){ ?>
                    <div style="margin-top: 10px;">
                       <a target="_parent" href="http://search.ebscohost.com/login.aspx?direct=true&scope=site&site=eds-live&authtype=ip,guest&custid=s8440836&groupid=main&profile=eds&bquery=<?php echo $_REQUEST['lookfor'] ?>"><div><h4 title="Everything (Research Warrior)" style="margin-bottom: 10px;"> >> View All Everything (Research Warrior) (<?php echo number_format($results['recordCount'])  ?>)</h4></div></a>                             	
                    </div>
                   <?php } ?>
	</div>

	                      <div id="half" style="width: 460px">    
                      <div id="quarter" style="background-color: #ffffff; width:220px; float:left;">  
                    	    <h4 style="margin-top: 25px; background-color: lightgrey">Research Guides</h4>
                    	    <div id="libGuideWidget"></div>
                    	    <div id='api_search_guides_iid692' style="font-family: Tahoma,Verdana,Arial,sans-serif;"></div>
                    	  </div>
                    	    <script>
                    	    var searchterm = '<?php echo $_REQUEST['lookfor'] ?>';
                    	    var headID = document.getElementById("libGuideWidget");         
                    	    var newScript = document.createElement('script');
                    	    newScript.type = 'text/javascript';
                    	    newScript.src = 'http://api.libguides.com/api_search.php?iid=692&type=guides&search=' + searchterm + '&limit=3&desc=on&sortby=relevance&context=object&format=js';
                    	    headID.appendChild(newScript);
                    	    </script> 
			  
                    	 <!--   <div id="quarter" style="background-color: #ffffff; width:220px; float:right;">  
                    	     <h4 style="margin-top: 25px; background-color: lightgrey">Liaison Librarians</h4>

                    	  <?php /*
                    	  	
                    	  	$lookfor = $_REQUEST['lookfor'];
				$guideTerm = str_replace(' ', '+', $lookfor);
				
				
				$searchGuides = curl_init();
				curl_setopt_array(
					$searchGuides,
					array(
						CURLOPT_URL => "http://api.libguides.com/api_search.php?iid=692&type=guides&limit=3&desc=on&sortby=relevance&search=" . $guideTerm,
						CURLOPT_POST => true,
						CURLOPT_RETURNTRANSFER =>true
					)
				);
				
				$response = curl_exec($searchGuides);
				curl_close($searchGuides);
				//echo $guideTerm;
				
				$links = explode("<BR>", $response);
				
				
				
				$allGuides = curl_init();
				curl_setopt_array(
					$allGuides,
					array(
						CURLOPT_URL => 'http://api.libguides.com/api_box.php?iid=692&bid=11005261',
						CURLOPT_POST => true,
						CURLOPT_RETURNTRANSFER =>true
						)
					);
				$allGuidesResponse = curl_exec($allGuides);
				curl_close($allGuides);
				
				
				$newlines = array("\t","\n","\r","\x20\x20","\0","\x0B");
				$content = str_replace($newlines, "", html_entity_decode($allGuidesResponse));
				
				$linkTrim = preg_replace('/<a href="([^\"]*)" target="([^\"]*)">([^\"]*)<\/a>([^\"]*)/', '$3', $links[0]);
				$linkTrim = ltrim($linkTrim);
				$linkTrim = str_replace('/', '\/', $linkTrim);
				
				$needle = '/<div class="pdisplay_div"><a class="pdisplay_name" href="([^\"]*)"title="View this Guide" >' . $linkTrim . '<\/a><BR><span class="pdisplay_light"><span class="pdisplay_author">by <a href="([^\"]*)" title="View Profile" >([^\"]*)<\/a>/';
				
				preg_match($needle, $content, $matches);
				
				$profileMatch = trim($matches[2], "\/");
				//echo '<br>';
				//echo $links[0];
				
				
				$profileGuide = curl_init();
				curl_setopt_array(
					$profileGuide,
					array(
						CURLOPT_URL => 'http://api.libguides.com/api_' . $profileMatch . '&iid=692',
						CURLOPT_POST => true,
						CURLOPT_RETURNTRANSFER =>true
						)
					);
				$responseGuide = curl_exec($profileGuide);
				curl_close($profileGuide);
				echo $_REQUEST['lookfor'];
				echo $responseGuide;
				*/?>
                    	  
                    	  </div> -->
                    	  <br>
         <!--<div style="width: 300px">    
                    	  <div id="quarter" style="background-color: #ffffff; width:220px; float:left;"><h4 style="margin-top: 25px; background-color: lightgrey">Digital Collections</h4>
                    	     <dl>  
                    	   
                    
                    	    <?php /*

                   	    
                   	    $searchURL = 'http://dlxs.lib.wayne.edu/cgi/i/image/image-idx?debug=xml;q1=' . $_REQUEST['lookfor'] . ';rgn1=ic_all;op2=And;rgn2=ic_all;op3=And;rgn3=ic_all;op4=And;rgn4=ic_all;xc=1;med=1;c=cfai;c=dhhcc;c=djg;c=hcc;c=heartic;c=hfhcc;c=hmcc;c=map;c=mbd;c=motic;c=ntgl;c=rcn;c=vmc;c=wpaic;size=20;start=1;type=boolean;view=thumbfull';

				$dlxsXML = simplexml_load_file($searchURL);		
				  
				 
				  $thumbLink = $dlxsXML->xpath("//Results[@name='full']/Result/Url[@name='ThumbLink']");
				  $entryLink = $dlxsXML->xpath("//Results[@name='full']/Result/Url[@name='EntryLink']");
				  $collection = $dlxsXML->xpath("//Results[@name='full']/Result/CollName/Full");
				  $testTitle = $dlxsXML->xpath("//Results[@name='full']/Result/ItemDescription");
				  $date = $dlxsXML->xpath("//Results[@name='full']/Result/Record/Section/Field[Label = 'Date']/Values/Value");
				  
				
				  
				$recs = count($entryLink) - 1;
				
				
				if($recs == 0){
					echo 'No results found matching \'' . $_REQUEST['lookfor'] . '\'';
				}
				
				elseif($recs > 3){
					// echo 'more than one';
					 $recs = 3;
					 $i = 0;
					 while ($i <= $recs) {
					   
					   $title = str_replace('|', ' ', $testTitle[$i]);					   
					   $title = substr($title, 0, 50);
					   
					   print '<dt><br><a href="' . str_replace('debug=xml', '', $entryLink[$i]) . '" target="_blank">' . $title . '</dt></a>';    
					   print '<dd><img src="' . $thumbLink[$i] . '"/></dd>';   
					   print '<dd>' . $date[$i] . '</dd>';
					   print '<dd>' . $collection[$i] . '</dd>';
					   $i++;
					   
				 } 
				} else {
					echo 'less than 3 greater than 1';
					 $i = 0;
					 while ($i <= $recs) {
					   print '<dl><dt><br><a href="' . str_replace('debug=xml', '', $entryLink[$i]) . '" target="_blank">' . str_replace('|', ' ', $testTitle[$i]) . '</dt></a>';    
					   print '<dd><img src="' . $thumbLink[$i] . '"/></dd>';   
					   print '<dd>' . $date[$i] . '</dd>';
					   print '<dd>' . $collection[$i] . '</dd></dl>';
					   $i++;
					   
				 }		
				}
				*/?>
			     </dl>	
			   <br>	
                    	   <a href="<?php echo str_replace('debug=xml', '', $searchURL) ?>" target="_blank"><h4>View More Digital Collections</h4></a>
                    	   </div>-->

                    	   
                    	   
                    	  </div>  


    </div>
</div>
</div>

        </div>
    </body>
    </html>
