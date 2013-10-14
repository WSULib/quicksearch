<?php

// retrieve search_string
$search_string = $_POST['search_string'];

//with callback
// $baseURL = "http://www.google.com/uds/GwebSearch?callback=google.search.WebSearch.RawCompletion&rsz=large&hl=en&source=gsc&gss=.com&sig=dafe20cc2afc0dcfa10b802f251c72d0&cx=008693872176005135416:mcgpkfekrf0&gl=www.google.com&qid=13e7052fa8d369068&context=1&key=notsupplied&v=1.0&nocache=1367680573915&q=site:lib.wayne.edu%20-site:guides.lib.wayne.edu%20";

//without callback
//with domain specific
// $baseURL = "http://www.google.com/uds/GwebSearch?rsz=large&hl=en&source=gsc&gss=.com&sig=dafe20cc2afc0dcfa10b802f251c72d0&cx=008693872176005135416:mcgpkfekrf0&gl=www.google.com&qid=13e7052fa8d369068&context=1&key=notsupplied&v=1.0&nocache=1367680573915&q=site:lib.wayne.edu%20OR%20site:otl.lib.wayne.edu%20-site:guides.lib.wayne.edu";

//university wide
$baseURL = "http://www.google.com/uds/GwebSearch?rsz=large&hl=en&source=gsc&gss=.com&sig=dafe20cc2afc0dcfa10b802f251c72d0&cx=008693872176005135416:mcgpkfekrf0&gl=www.google.com&qid=13e7052fa8d369068&context=1&key=notsupplied&v=1.0&nocache=1367680573915&q=";


$queryURL = $baseURL . $search_string;
$results = file_get_contents($queryURL);
echo $results;

?>