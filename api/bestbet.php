<?php $wsuroot = realpath($_SERVER["DOCUMENT_ROOT"]); $headerType = "plain"; $pageTitle=""; $pageBreadCrumbsGoByURL = "resources/quicksearch/api/bestbet.php"; $pageSidebarSectionsGoByURL = "resources/quicksearch/api/bestbet.php"; require_once("$wsuroot/header.php") ?><?php require_once("$wsuroot/page-begin.php"); ?><?php

//header("Access-Control-Allow-Origin: http://library.wayne.edu");
header("Access-Control-Allow-Origin: http://library2.wayne.edu");

require_once("functions.php");















$query = $_GET['query'];



require_once("QueryParser.php");
$queryParser = new QueryParser( urldecode($query) );// YOU MUST DO THIS FOR WHEN THERES AN APOSTROPHE
//$queryParser = new QueryParser( $query );

// if ($queryParser->summonAPI->resultsCount == 1) {
// 	//echo 567;
// 	$bestbet = array(
// 		'name' => replaceWithBold($queryParser->queryKeywords, $queryParser->summonAPI->results['Title'][0]),
// 		'url' => $queryParser->summonAPI->results['link'],
// 		'image' => $queryParser->summonAPI->results['thumbnail_m'],
// 		'data' => array(
// 			'Authors' => $queryParser->summonAPI->results['Author'],
// 			'Date' => $queryParser->summonAPI->results['PublicationDate'],
// 			'Publication' => $queryParser->summonAPI->results['PublicationTitle'][0] . ', Vol. ' . $queryParser->summonAPI->results['Volume'][0] . ', No. ' . $queryParser->summonAPI->results['Issue'][0],
// 			'Discipline' => $queryParser->summonAPI->results['Discipline'],
// 			'Type' => $queryParser->summonAPI->results['ContentType'],
// 		),
// 	);
// } else {
// 	$bestbet = bestbet($query);
// }



// function savedImages($phrase) {
// 	$savedImages = array(
// 		'pubmed' => 'http://static.pubmed.gov/portal/portal3rc.fcgi/4066669/img/2318832',
// 		'pubmed' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/US-NLM-PubMed-Logo.svg/250px-US-NLM-PubMed-Logo.svg.png',
// 		'uptodate' => 'https://www.uptodate.com/images/UTD3_masthead.png',
// 		'proquest' => 'http://search.proquest.com/assets/r20151.3.2-2/ctx/images/pagelayout/pq_logo_sml.gif',
// 		//'jstor' => 'http://www.jstor.org/search_20150428T1033/files/search/images/jstor_logo.jpg',
// 		'jstor' => 'http://17rg073sukbm1lmjk9jrehb643.wpengine.netdna-cdn.com/wp-content/uploads/2013/11/jstor-400.png',
// 		'pipeline' => 'https://lumprod.wayne.edu/cps/images/pipeline_logo_white.gif',
// 		'endnote' => 'http://endnote.com/sites/en/files/endnote_logo.png',
// 		'web and of and science' => 'http://www.lis.upatras.gr/wp-content/uploads/2013/01/wos.png',
// 		'cinahl' => 'http://ulsterlibrarylhs.jiscinvolve.org/wp/files/2011/05/logo_cinahl1-e1306855444650.png',
// 			'cinahl and complete' => 'http://ulsterlibrarylhs.jiscinvolve.org/wp/files/2011/05/logo_cinahl1-e1306855444650.png',
// 		'psycinfo' => 'http://www.osu-tulsa.okstate.edu/library/Images/Logo%20-%20PsycInfo.jpg',
// 		'proquest' => 'http://www.ala.org/news/sites/ala.org.news/files/news/pressreleaseimages/PQ_Logo_2013.jpg',
// 		'proquest and research and library' => 'http://www.ala.org/news/sites/ala.org.news/files/news/pressreleaseimages/PQ_Logo_2013.jpg',
// 	);
// 	return $savedImages[strtolower($phrase)];
// }


function savedImages($url) {
	$savedImages = array(
		// pubmed
		'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e10002327&link=https://proxy.lib.wayne.edu/login?url=http://www.ncbi.nlm.nih.gov/pubmed?otool=waynelib' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/US-NLM-PubMed-Logo.svg/250px-US-NLM-PubMed-Logo.svg.png',
		// pubmed
		'https://proxy.lib.wayne.edu/login?url=http://www.ncbi.nlm.nih.gov/pubmed?otool=waynelib' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/US-NLM-PubMed-Logo.svg/250px-US-NLM-PubMed-Logo.svg.png',
		// pubmed central
		'http://elibrary.wayne.edu/record=e1000045' => 'http://static.pubmed.gov/portal/portal3rc.fcgi/4035897/img/3005255',
		// pubmed central
		'http://elibrary.wayne.edu/record=e1000045' => 'http://www.pubmedcentral.nih.gov/utils/pv/corehtml/pmc/pmcgifs/pmclogo.gif',
		// jstor
		'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e1000032x&link=https://proxy.lib.wayne.edu/login?url=http://www.jstor.org' => 'http://17rg073sukbm1lmjk9jrehb643.wpengine.netdna-cdn.com/wp-content/uploads/2013/11/jstor-400.png',
		// uptodate
		'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e1000581x&link=https://proxy.lib.wayne.edu/login?url=http://www.uptodate.com/contents/search?unid=^u&srcsys=UTD176259&eiv=2.1.0' => 'https://www.uptodate.com/images/UTD3_masthead.png',
		// pipeline
		'https://lumprod.wayne.edu/cp/home/displaylogin' => 'https://lumprod.wayne.edu/cps/images/pipeline_logo_white.gif',
		// cinahl
		'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e10008184&link=https://proxy.lib.wayne.edu/login?url=http://search.ebscohost.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=ccm' => 'http://ulsterlibrarylhs.jiscinvolve.org/wp/files/2011/05/logo_cinahl1-e1306855444650.png',
		// psycinfo
		'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e10008652&link=https://proxy.lib.wayne.edu/login?url=http://search.ebscohost.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=psyh' => 'http://www.osu-tulsa.okstate.edu/library/Images/Logo%20-%20PsycInfo.jpg',
		// proquest
		'http://elibrary.wayne.edu/record=e1000044' => 'http://www.ala.org/news/sites/ala.org.news/files/news/pressreleaseimages/PQ_Logo_2013.jpg',
		// web of science
		'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e10001992&link=https://proxy.lib.wayne.edu/login?url=http://www.webofknowledge.com/WOS' => 'http://www.lis.upatras.gr/wp-content/uploads/2013/01/wos.png',
		// endnote
		'http://wayne.v1.libguides.com/endnote?hs=a' => 'http://endnote.com/sites/en/files/endnote_logo.png',
		// melcat
		'http://elibrary.mel.org/search/a?searchtype=X&searcharg=hagakure&SORT=D' => 'http://dearbornlibrary.org/wordpress/wp-content/uploads/2013/06/mel_logo_3-08.jpg',
		'http://elibrary.mel.org/search/a?searchtype=X&searcharg=melcat&SORT=D' => 'http://dearbornlibrary.org/wordpress/wp-content/uploads/2013/06/mel_logo_3-08.jpg',
		// worldcat
		'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e10001542&link=https://proxy.lib.wayne.edu/login?url=http://firstsearch.oclc.org/FSIP?dbname=WorldCat' => 'http://static1.worldcat.org/wcpa/rel20150616/images/logo_wcmasthead_en.png',


		// 'uptodate' => 'https://www.uptodate.com/images/UTD3_masthead.png',
		// 'proquest' => 'http://search.proquest.com/assets/r20151.3.2-2/ctx/images/pagelayout/pq_logo_sml.gif',
		// //'jstor' => 'http://www.jstor.org/search_20150428T1033/files/search/images/jstor_logo.jpg',
		// 'jstor' => 'http://17rg073sukbm1lmjk9jrehb643.wpengine.netdna-cdn.com/wp-content/uploads/2013/11/jstor-400.png',
		// 'pipeline' => 'https://lumprod.wayne.edu/cps/images/pipeline_logo_white.gif',
		// 'endnote' => 'http://endnote.com/sites/en/files/endnote_logo.png',
		// 'web and of and science' => 'http://www.lis.upatras.gr/wp-content/uploads/2013/01/wos.png',
		// 'cinahl' => 'http://ulsterlibrarylhs.jiscinvolve.org/wp/files/2011/05/logo_cinahl1-e1306855444650.png',
		// 	'cinahl and complete' => 'http://ulsterlibrarylhs.jiscinvolve.org/wp/files/2011/05/logo_cinahl1-e1306855444650.png',
		// 'psycinfo' => 'http://www.osu-tulsa.okstate.edu/library/Images/Logo%20-%20PsycInfo.jpg',
		// 'proquest' => 'http://www.ala.org/news/sites/ala.org.news/files/news/pressreleaseimages/PQ_Logo_2013.jpg',
		// 'proquest and research and library' => 'http://www.ala.org/news/sites/ala.org.news/files/news/pressreleaseimages/PQ_Logo_2013.jpg',
	);
	// if ($url == 'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e1000581x&link=https://proxy.lib.wayne.edu/login?url=http://www.uptodate.com/contents/search?unid=^u&srcsys=UTD176259&eiv=2.1.0') {
	// 	return 'https://www.uptodate.com/images/UTD3_masthead.png';
	// }
	// if ($url == 'http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e10001992&link=https://proxy.lib.wayne.edu/login?url=http://www.webofknowledge.com/WOS') {
	// 	return 'http://www.lis.upatras.gr/wp-content/uploads/2013/01/wos.png';
	// }
	// if ($url == 'http://elibrary.mel.org/search/a?searchtype=X&searcharg=hagakure&SORT=D') {
	// 	return 'http://dearbornlibrary.org/wordpress/wp-content/uploads/2013/06/mel_logo_3-08.jpg';
	// }

	foreach ($savedImages as $pageUrl => $imageUrl) {
		if ($url == $pageUrl) {
			return $imageUrl;
		}
	}

	//return $savedImages[strtolower($url)];
}



//print_r($queryParser);

if (isset($queryParser->bestResult)) {
	//echo 7777777777;
	$bestbet = $queryParser->bestResult;
} else {
	//echo 'nnnnn';
	function bestbet($phrase) {
		$phrase = str_replace(' ', ' AND ', $phrase);
		//echo $phrase;
		global $queryParser;
		$fgc1 = file_get_contents("http://digital.library.wayne.edu/solr4/quicksearch/select?q=" . urlencode($phrase) . "&rows=0&wt=json&indent=true&facet=true&facet.field=link_text&facet.limit=6&facet.pivot=link_text,resource_url,click_category");
		$json1 = json_decode($fgc1, true);


		// if ($json1['response']['numFound'] > 0) {
		// 	// 
		// 	$savedImages = array(
		// 		'pubmed' => 'http://static.pubmed.gov/portal/portal3rc.fcgi/4066669/img/2318832',
		// 		'pubmed' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/US-NLM-PubMed-Logo.svg/250px-US-NLM-PubMed-Logo.svg.png',
		// 		'uptodate' => 'https://www.uptodate.com/images/UTD3_masthead.png',
		// 		'proquest' => 'http://search.proquest.com/assets/r20151.3.2-2/ctx/images/pagelayout/pq_logo_sml.gif',
		// 		//'jstor' => 'http://www.jstor.org/search_20150428T1033/files/search/images/jstor_logo.jpg',
		// 		'jstor' => 'http://17rg073sukbm1lmjk9jrehb643.wpengine.netdna-cdn.com/wp-content/uploads/2013/11/jstor-400.png',
		// 		'pipeline' => 'https://lumprod.wayne.edu/cps/images/pipeline_logo_white.gif',
		// 		'endnote' => 'http://endnote.com/sites/en/files/endnote_logo.png',
		// 		'web and of and science' => 'http://www.lis.upatras.gr/wp-content/uploads/2013/01/wos.png',
		// 		'cinahl' => 'http://ulsterlibrarylhs.jiscinvolve.org/wp/files/2011/05/logo_cinahl1-e1306855444650.png',
		// 			'cinahl and complete' => 'http://ulsterlibrarylhs.jiscinvolve.org/wp/files/2011/05/logo_cinahl1-e1306855444650.png',
		// 		'psycinfo' => 'http://www.osu-tulsa.okstate.edu/library/Images/Logo%20-%20PsycInfo.jpg',
		// 		'proquest' => 'http://www.ala.org/news/sites/ala.org.news/files/news/pressreleaseimages/PQ_Logo_2013.jpg',
		// 		'proquest and research and library' => 'http://www.ala.org/news/sites/ala.org.news/files/news/pressreleaseimages/PQ_Logo_2013.jpg',
		// 	);
		// 	return array(
		// 		'title' => $queryParser->replaceWithBold($queryParser->queryKeywords, $json1['facet_counts']['facet_pivot']['link_text,resource_url'][0]['value']),
		// 		'url' => urldecode( $json1['facet_counts']['facet_pivot']['link_text,resource_url'][0]['pivot'][0]['value'] ),
		// 		'image' => $savedImages[strtolower($phrase)],
		// 	);
		// } else {
		// 	// 
		// 	return null;
		// }


		$bestbetResults = array();
		if ($json1['response']['numFound'] > 0) {
			foreach ($json1['facet_counts']['facet_pivot']['link_text,resource_url,click_category'] as $key => $bestbet) {
				if ($bestbet['count'] >= 1) {
					// what type is it?
					// if (strpos($bestbet['pivot'][0]['value'], 'wayne.summon.serialssolutions.com') ) {
					// 	$type = 'Article';
					// } elseif (strpos($bestbet['pivot'][0]['value'], 'library.wayne.edu/resources/databases') ) {
					// 	$type = 'Database';
					// } elseif (strpos($bestbet['pivot'][0]['value'], 'proxy.lib.wayne.edu') ) {
					// 	// http://cgi.lib.wayne.edu/stats/v5fudinsrt.php?bib=e10002327&link=https://proxy.lib.wayne.edu/login?url=http://www.ncbi.nlm.nih.gov/pubmed?otool=waynelib
					// 	$type = 'Database';
					// } elseif (strpos($bestbet['pivot'][0]['value'], 'digitalcommons.wayne.edu') ) {
					// 	$type = 'Digital Commons';
					// } elseif (strpos($bestbet['pivot'][0]['value'], 'elibrary.wayne.edu') ) {
					// 	$type = 'eLibrary';
					// 	$type = 'Books and Media';
					// } elseif (strpos($bestbet['pivot'][0]['value'], 'digital.library.wayne.edu/digitalcollections') ) {
					// 	$type = 'Digital Collections';
					// } elseif (strpos($bestbet['pivot'][0]['value'], 'guides.lib.wayne.edu') ) {
					// 	$type = 'Research Guide';
					// } elseif (strpos($bestbet['pivot'][0]['value'], 'wayne.edu') ) {
					// 	$type = 'WSU Site Search';
					// }
					//
					//
					//
					//
					$typeNamesConverted = array(
						'summonjs' => 'Article',
						'databases' => 'Database',
						'digi_commons' => 'Digital Commons',
						'digi_commons0' => 'Digital Commons',
						'books' => 'Books and Media',
						'journals' => 'Journal',
						'digi_collections' => 'Digital Collections',
						'site_search' => 'WSU Site Search',
						'lib_guides' => 'Research Guide',
						'bestanswer' => 'Best Answer',
					);
					$type = $typeNamesConverted[ $bestbet['pivot'][0]['pivot'][0]['value'] ];
					if ($type == 'Database') {
						$bestbetResultsContainsDatabase = true;
					}
					//print_r($bestbet);
					//
					$bestbetResults []= array(
						'title' => $queryParser->replaceWithBold($queryParser->queryKeywords, $bestbet['value']),
						'url' => urldecode( $bestbet['pivot'][0]['value'] ),
						//'image' => savedImages($phrase),
						'image' => savedImages( $bestbet['pivot'][0]['value'] ),
						//'type' => $type,
						'type' => $type,
					);
					//echo 'START' . savedImages( $bestbet['pivot'][0]['value'] ) . '<br><br><br>';
					//echo $bestbet['pivot'][0]['value'] . '<br>';
				}
			}
			// remove all bestanswer types
			foreach ($bestbetResults as $key => $bestbet) {
				if ( $bestbet['type'] == 'Best Answer' ) {
					unset( $bestbetResults[$key] );
				}
			}
			// remove duplicates by URL
			foreach ($bestbetResults as $key => $bestbet) {
				if ( in_array($bestbet['url'], $arrToRemoveDuplicateUrls) ) {
					unset( $bestbetResults[$key] );
				}
				$arrToRemoveDuplicateUrls []= $bestbet['url'];
			}
			// if a bestbet is a database, remove all articles
			if ($bestbetResultsContainsDatabase) {
				foreach ($bestbetResults as $key => $bestbet) {
					if ($bestbet['type'] == 'Article') {
						unset( $bestbetResults[$key] );
					}
				}
			}
			
			///////$bestbetResults = array_map("unserialize", array_unique(array_map("serialize", $bestbetResults)));
			$bestbetResults = array_slice($bestbetResults, 0, 3);
			if (count($bestbetResults) > 0) {
				return array(
					'title' => 'Best Bet',
					'results' => $bestbetResults,
				);
			} else {
				return 999;				
			}
		} else {
			// 
			return null;
		}

	}
	$bestbet = bestbet( $queryParser->queryNormalizedWhitespace );
}



// function utf8_converter($array)
// {
//     array_walk_recursive($array, function(&$item, $key){
//         if(!mb_detect_encoding($item, 'utf-8', true)){
//                 $item = utf8_encode($item);
//         }
//     });
 
//     return $array;
// }

// echo json_encode( utf8_converter($bestbet) );


function utf8_converter($array) {
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}

echo json_encode( utf8_converter($bestbet) );





?><?php require_once("$wsuroot/page-end.php"); ?><?php require_once("$wsuroot/footer.php") ?>