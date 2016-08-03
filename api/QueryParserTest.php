<?php $wsuroot = realpath($_SERVER["DOCUMENT_ROOT"]); $headerType = "plain"; $pageTitle=""; $pageBreadCrumbsGoByURL = "resources/quicksearch/api/QueryParserTest.php"; $pageSidebarSectionsGoByURL = "resources/quicksearch/api/QueryParserTest.php"; require_once("$wsuroot/header.php") ?><?php require_once("$wsuroot/page-begin.php"); ?><?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

/*



Known Item Search

	Article name
	Relationship Between Testosterone Levels, Insulin Sensitivity, and Mitochondrial Function in Men

	Gender differences in financial risk aversion and career choices are affected by testosterone
	
	EX:::: Sapienza Gender differences in financial risk aversion and career choices are affected by testosterone
	------ in this case Sapienza will need to be classified as a "name"


	Full citation
	Kaplan, S., & Crawford, E. (2006). Relationship Between Testosterone Levels, Insulin Sensitivity, and Mitochondrial Function in Men: Response to Pitteloud et al. Diabetes Care, 749-749.

	Sapienza, P., Zingales, L., & Maestripieri, D. (2009). Gender differences in financial risk aversion and career choices are affected by testosterone. Proceedings of the National Academy of Sciences, 15268-15273.

	Sapienza, P., L. Zingales, and D. Maestripieri. "Gender Differences in Financial Risk Aversion and Career Choices Are Affected by Testosterone." Proceedings of the National Academy of Sciences (2009): 15268-5273. Print.

Unknown Item Search

	testosterone and financial risk taking


steps
- asssume full and proerly formatted citation
- then assume broken citation OR half made thing
--- look for date in parenthesis
--- look for date by format, four numbers between 1800 and 2099.. EX.. 1955 ... 2012




TODO
stemming
n-gram


*/





/*
 * helps with
 * known item search
 * citation search
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */


require_once("QueryParser.php");


// echo 'Silverstein, Alvin, Virginia B Silverstein, and Laura Silverstein Nunn. The grizzly bear. Brookfield, CN: Millbrook Press. 1998';
// echo '<br>';
// // echo 'Okuda M, Okuda D. Star Trek Chronology The History of the Future. New York Pocket Books. 1993';
// // echo '<br>';
// echo 'Hamaker C. 2005. Open URL The challenge of success. The Charleston Advisor';
// echo '<br>';
// echo 'Hamaker C. 2005. Open URL: The challenge of success. The Charleston Advisor';
// echo '<br>';
// echo '<br>';


?>


<style type="text/css">
body {
	font: 15px Arial;
}
</style>


<!-- 
Kent A. Kirwan (1991). Review of Robert A. Goldwin 'Why Blacks, Women,and Jews Are Not Mentioned in the Constitution and Other Unorthodox Views' The Review of Politics
<br />
Lilienfeld, S.O, Lynn, S.J., Namy, L.L., & Woolf, N.J. (2014). Psychology: From Inquiry to Understanding. Allyn & Bacon Publishers.
<br />
<br />
 -->


<?php
echo '<br>';
echo '<br>';
$q = new QueryParser( $_GET['q'] );


?>


<form action="" method="GET">
	<input type="text" name="q" value="<?php echo htmlspecialchars($q->query, ENT_QUOTES, 'UTF-8') /*htmlspecialchars($_GET['q'], ENT_IGNORE, 'UTF-8');*/ ?>" style="width:100%;padding: 0 4px;line-height:32px;font-size:14px;" />
</form>

<div id="" style="padding-left:6px;">
	<span style="color:red"><?php echo $q->citationParser->match[1]; ?></span>
	<span style="color:green"><?php echo $q->citationParser->match[2]; ?></span>
	<span style="color:blue"><?php echo $q->citationParser->match[3]; ?></span>
	<span style="color:purple"><?php echo $q->citationParser->match[4]; ?></span>
	<span style="color:orange"><?php echo $q->citationParser->match[5]; ?></span>
	<span style="color:brown"><?php echo $q->citationParser->match[6]; ?></span>
	<span style="color:pink"><?php echo $q->citationParser->match[7]; ?></span>
	<span style="color:tan"><?php echo $q->citationParser->match[8]; ?></span>
	<span style="color:gold"><?php echo $q->citationParser->match[9]; ?></span>
</div>

<br>
<br>
<!-- <img src="<?php echo $q->bestResult['image']; ?>" />
 -->

<?php

echo '<pre>';
print_r( $q );
echo '</pre>';


















?><?php require_once("$wsuroot/page-end.php"); ?><?php require_once("$wsuroot/footer.php") ?>