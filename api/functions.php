<?php $wsuroot = realpath($_SERVER["DOCUMENT_ROOT"]); $headerType = "plain"; $pageTitle=""; $pageBreadCrumbsGoByURL = "resources/quicksearch/api/functions.php"; $pageSidebarSectionsGoByURL = "resources/quicksearch/api/functions.php"; require_once("$wsuroot/header.php") ?><?php require_once("$wsuroot/page-begin.php"); ?><?php



// error_reporting(E_ALL);
// ini_set('display_errors', 1);


function replaceWithBold($terms, $target) {
	// remove stopwords
	//$stopwords = array('and', 'of', 'is');
	//$stopwords = array('and', 'of', 'is', 'the');
	$stopwords = array('and', 'of', 'is', 'the', 'in', 'on', 'to', 'from', 'by', 'with');
	foreach ($stopwords as $stopword) {
		if(($key = array_search($stopword, $terms)) !== false) {
			unset($terms[$key]);
		}
	}
	// replace with same word, but bold
	foreach ($terms as $term) {
		$target = preg_replace('/\b(' . preg_quote($term) . ')\b/i', "<b>$1</b>", $target);
	}
	return $target;
}



?><?php require_once("$wsuroot/page-end.php"); ?><?php require_once("$wsuroot/footer.php") ?>