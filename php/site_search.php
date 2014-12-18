<?php

// retrieve search_string
$search_string = $_POST['search_string'];

// construct query string from wayne.edu's custom search element ajax call
$baseURL = "https://www.googleapis.com/customsearch/v1element?key=AIzaSyCVAXiUzRYsML1Pv6RwSG1gunmMikTzQqY&rsz=filtered_cse&num=10&hl=en&prettyPrint=false&source=gcsc&gss=.com&sig=23952f7483f1bca4119a89c020d13def&cx=008693872176005135416:hd9kmpeywgi&q=$search_string&sort=&googlehost=www.google.com&nocache=1418925969190";

$queryURL = $baseURL . $search_string;
$results = file_get_contents($queryURL);
echo $results;

?>