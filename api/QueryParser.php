<?php $wsuroot = realpath($_SERVER["DOCUMENT_ROOT"]); $headerType = "plain"; $pageTitle=""; $pageBreadCrumbsGoByURL = "resources/quicksearch/api/QueryParser.php"; $pageSidebarSectionsGoByURL = "resources/quicksearch/api/QueryParser.php"; require_once("$wsuroot/header.php") ?><?php require_once("$wsuroot/page-begin.php"); ?><?php




// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);


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








// oclc ocm09847382 / ocm05812780
// issn 10792089
// isbn 9781118407806
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 

// Reis, H. T.,  Aron, A. (2008). Love, what is it, why does it matter, and how does it operate? Perspectives on Psychological Science
// Sigelman, Lee, and SusanWelch 1991 "Black Americans' Views of Racial Inequalitys: The Dream Deferred" New York: Cambridge University Press.
// Jackson, Graham. 2008. Cardiovascular effects of testosterone. Current Sexual Health Reports
// Jackson, G. (2008). Cardiovascular effects of testosterone. Current Sexual Health Reports
// Schwarzer, R. & Jerusalem, M. (1993). The general self-efficacy scale. Berlin: Germany.
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 
// 


function getLanguageFromISOLanguageCode($code) {
	$lang = array(
		"ab" => "Abkhazian",
		"abk" => "Abkhazian",
		"aa" => "Afar",
		"aar" => "Afar",
		"af" => "Afrikaans",
		"afr" => "Afrikaans",
		"sq" => "Albanian",
		"alb" => "Albanian",
		"sqi" => "Albanian",
		"am" => "Amharic",
		"amh" => "Amharic",
		"ar" => "Arabic",
		"ara" => "Arabic",
		"an" => "Aragonese",
		"arg" => "Aragonese",
		"hy" => "Armenian",
		"arm" => "Armenian",
		"hye" => "Armenian",
		"as" => "Assamese",
		"asm" => "Assamese",
		"ae" => "Avestan",
		"ave" => "Avestan",
		"ay" => "Aymara",
		"aym" => "Aymara",
		"az" => "Azerbaijani",
		"aze" => "Azerbaijani",
		"ba" => "Bashkir",
		"bak" => "Bashkir",
		"eu" => "Basque",
		"baq" => "Basque",
		"eus" => "Basque",
		"be" => "Belarusian",
		"bel" => "Belarusian",
		"bn" => "Bengali",
		"ben" => "Bengali",
		"bh" => "Bihari",
		"bih" => "Bihari",
		"bi" => "Bislama",
		"bis" => "Bislama",
		"bs" => "Bosnian",
		"bos" => "Bosnian",
		"br" => "Breton",
		"bre" => "Breton",
		"bg" => "Bulgarian",
		"bul" => "Bulgarian",
		"my" => "Burmese",
		"bur" => "Burmese",
		"mya" => "Burmese",
		"ca" => "Catalan",
		"cat" => "Catalan",
		"ch" => "Chamorro",
		"cha" => "Chamorro",
		"ce" => "Chechen",
		"che" => "Chechen",
		"zh" => "Chinese",
		"chi" => "Chinese",
		"zho" => "Chinese",
		"cu" => "Church Slavic, Slavonic, Old Bulgarian",
		"chu" => "Church Slavic, Slavonic, Old Bulgarian",
		"cv" => "Chuvash",
		"chv" => "Chuvash",
		"kw" => "Cornish",
		"cor" => "Cornish",
		"co" => "Corsican",
		"cos" => "Corsican",
		"hr" => "Croatian",
		"hrv" => "Croatian",
		"scr" => "Croatian",
		"cs" => "Czech",
		"cze" => "Czech",
		"ces" => "Czech",
		"da" => "Danish",
		"dan" => "Danish",
		"dv" => "Divehi, Dhivehi, Maldivian",
		"div" => "Divehi, Dhivehi, Maldivian",
		"nl" => "Dutch",
		"dut" => "Dutch",
		"nld" => "Dutch",
		"dz" => "Dzongkha",
		"dzo" => "Dzongkha",
		"en" => "English",
		"eng" => "English",
		"eo" => "Esperanto",
		"epo" => "Esperanto",
		"et" => "Estonian",
		"est" => "Estonian",
		"fo" => "Faroese",
		"fao" => "Faroese",
		"fj" => "Fijian",
		"fij" => "Fijian",
		"fi" => "Finnish",
		"fin" => "Finnish",
		"fr" => "French",
		"fre" => "French",
		"fra" => "French",
		"gd" => "Gaelic, Scottish Gaelic",
		"gla" => "Gaelic, Scottish Gaelic",
		"gl" => "Galician",
		"glg" => "Galician",
		"ka" => "Georgian",
		"geo" => "Georgian",
		"kat" => "Georgian",
		"de" => "German",
		"ger" => "German",
		"deu" => "German",
		"el" => "Greek, Modern",
		"gre" => "Greek, Modern",
		"ell" => "Greek, Modern",
		"gn" => "Guarani",
		"grn" => "Guarani",
		"gu" => "Gujarati",
		"guj" => "Gujarati",
		"ht" => "Haitian, Haitian Creole",
		"hat" => "Haitian, Haitian Creole",
		"ha" => "Hausa",
		"hau" => "Hausa",
		"he" => "Hebrew",
		"heb" => "Hebrew",
		"hz" => "Herero",
		"her" => "Herero",
		"hi" => "Hindi",
		"hin" => "Hindi",
		"ho" => "Hiri Motu",
		"hmo" => "Hiri Motu",
		"hu" => "Hungarian",
		"hun" => "Hungarian",
		"is" => "Icelandic",
		"ice" => "Icelandic",
		"isl" => "Icelandic",
		"io" => "Ido",
		"ido" => "Ido",
		"id" => "Indonesian",
		"ind" => "Indonesian",
		"ia" => "Interlingua",
		"ina" => "Interlingua",
		"ie" => "Interlingue",
		"ile" => "Interlingue",
		"iu" => "Inuktitut",
		"iku" => "Inuktitut",
		"ik" => "Inupiaq",
		"ipk" => "Inupiaq",
		"ga" => "Irish",
		"gle" => "Irish",
		"it" => "Italian",
		"ita" => "Italian",
		"ja" => "Japanese",
		"jpn" => "Japanese",
		"jv" => "Javanese",
		"jav" => "Javanese",
		"kl" => "Kalaallisut",
		"kal" => "Kalaallisut",
		"kn" => "Kannada",
		"kan" => "Kannada",
		"ks" => "Kashmiri",
		"kas" => "Kashmiri",
		"kk" => "Kazakh",
		"kaz" => "Kazakh",
		"km" => "Khmer",
		"khm" => "Khmer",
		"ki" => "Kikuyu, Gikuyu",
		"kik" => "Kikuyu, Gikuyu",
		"rw" => "Kinyarwanda",
		"kin" => "Kinyarwanda",
		"ky" => "Kirghiz",
		"kir" => "Kirghiz",
		"kv" => "Komi",
		"kom" => "Komi",
		"ko" => "Korean",
		"kor" => "Korean",
		"kj" => "Kuanyama, Kwanyama",
		"kua" => "Kuanyama, Kwanyama",
		"ku" => "Kurdish",
		"kur" => "Kurdish",
		"lo" => "Lao",
		"lao" => "Lao",
		"la" => "Latin",
		"lat" => "Latin",
		"lv" => "Latvian",
		"lav" => "Latvian",
		"li" => "Limburgan, Limburger, Limburgish",
		"lim" => "Limburgan, Limburger, Limburgish",
		"ln" => "Lingala",
		"lin" => "Lingala",
		"lt" => "Lithuanian",
		"lit" => "Lithuanian",
		"lb" => "Luxembourgish, Letzeburgesch",
		"ltz" => "Luxembourgish, Letzeburgesch",
		"mk" => "Macedonian",
		"mac" => "Macedonian",
		"mkd" => "Macedonian",
		"mg" => "Malagasy",
		"mlg" => "Malagasy",
		"ms" => "Malay",
		"may" => "Malay",
		"msa" => "Malay",
		"ml" => "Malayalam",
		"mal" => "Malayalam",
		"mt" => "Maltese",
		"mlt" => "Maltese",
		"gv" => "Manx",
		"glv" => "Manx",
		"mi" => "Maori",
		"mao" => "Maori",
		"mri" => "Maori",
		"mr" => "Marathi",
		"mar" => "Marathi",
		"mh" => "Marshallese",
		"mah" => "Marshallese",
		"mo" => "Moldavian",
		"mol" => "Moldavian",
		"mn" => "Mongolian",
		"mon" => "Mongolian",
		"na" => "Nauru",
		"nau" => "Nauru",
		"nv" => "Navaho, Navajo",
		"nav" => "Navaho, Navajo",
		"nd" => "Ndebele, North",
		"nde" => "Ndebele, North",
		"nr" => "Ndebele, South",
		"nbl" => "Ndebele, South",
		"ng" => "Ndonga",
		"ndo" => "Ndonga",
		"ne" => "Nepali",
		"nep" => "Nepali",
		"se" => "Northern Sami",
		"sme" => "Northern Sami",
		"no" => "Norwegian",
		"nor" => "Norwegian",
		"nb" => "Norwegian Bokmal",
		"nob" => "Norwegian Bokmal",
		"nn" => "Norwegian Nynorsk",
		"nno" => "Norwegian Nynorsk",
		"ny" => "Nyanja, Chichewa, Chewa",
		"nya" => "Nyanja, Chichewa, Chewa",
		"oc" => "Occitan, Provencal",
		"oci" => "Occitan, Provencal",
		"or" => "Oriya",
		"ori" => "Oriya",
		"om" => "Oromo",
		"orm" => "Oromo",
		"os" => "Ossetian, Ossetic",
		"oss" => "Ossetian, Ossetic",
		"pi" => "Pali",
		"pli" => "Pali",
		"pa" => "Panjabi",
		"pan" => "Panjabi",
		"fa" => "Persian",
		"per" => "Persian",
		"fas" => "Persian",
		"pl" => "Polish",
		"pol" => "Polish",
		"pt" => "Portuguese",
		"por" => "Portuguese",
		"ps" => "Pushto",
		"pus" => "Pushto",
		"qu" => "Quechua",
		"que" => "Quechua",
		"rm" => "Raeto-Romance",
		"roh" => "Raeto-Romance",
		"ro" => "Romanian",
		"rum" => "Romanian",
		"ron" => "Romanian",
		"rn" => "Rundi",
		"run" => "Rundi",
		"ru" => "Russian",
		"rus" => "Russian",
		"sm" => "Samoan",
		"smo" => "Samoan",
		"sg" => "Sango",
		"sag" => "Sango",
		"sa" => "Sanskrit",
		"san" => "Sanskrit",
		"sc" => "Sardinian",
		"srd" => "Sardinian",
		"sr" => "Serbian",
		"scc" => "Serbian",
		"srp" => "Serbian",
		"sn" => "Shona",
		"sna" => "Shona",
		"ii" => "Sichuan Yi",
		"iii" => "Sichuan Yi",
		"sd" => "Sindhi",
		"snd" => "Sindhi",
		"si" => "Sinhala, Sinhalese",
		"sin" => "Sinhala, Sinhalese",
		"sk" => "Slovak",
		"slo" => "Slovak",
		"slk" => "Slovak",
		"sl" => "Slovenian",
		"slv" => "Slovenian",
		"so" => "Somali",
		"som" => "Somali",
		"st" => "Sotho, Southern",
		"sot" => "Sotho, Southern",
		"es" => "Spanish, Castilian",
		"spa" => "Spanish, Castilian",
		"su" => "Sundanese",
		"sun" => "Sundanese",
		"sw" => "Swahili",
		"swa" => "Swahili",
		"ss" => "Swati",
		"ssw" => "Swati",
		"sv" => "Swedish",
		"swe" => "Swedish",
		"tl" => "Tagalog",
		"tgl" => "Tagalog",
		"ty" => "Tahitian",
		"tah" => "Tahitian",
		"tg" => "Tajik",
		"tgk" => "Tajik",
		"ta" => "Tamil",
		"tam" => "Tamil",
		"tt" => "Tatar",
		"tat" => "Tatar",
		"te" => "Telugu",
		"tel" => "Telugu",
		"th" => "Thai",
		"tha" => "Thai",
		"bo" => "Tibetan",
		"tib" => "Tibetan",
		"bod" => "Tibetan",
		"ti" => "Tigrinya",
		"tir" => "Tigrinya",
		"to" => "Tonga",
		"ton" => "Tonga",
		"ts" => "Tsonga",
		"tso" => "Tsonga",
		"tn" => "Tswana",
		"tsn" => "Tswana",
		"tr" => "Turkish",
		"tur" => "Turkish",
		"tk" => "Turkmen",
		"tuk" => "Turkmen",
		"tw" => "Twi",
		"twi" => "Twi",
		"ug" => "Uighur",
		"uig" => "Uighur",
		"uk" => "Ukrainian",
		"ukr" => "Ukrainian",
		"ur" => "Urdu",
		"urd" => "Urdu",
		"uz" => "Uzbek",
		"uzb" => "Uzbek",
		"vi" => "Vietnamese",
		"vie" => "Vietnamese",
		"vo" => "Volapuk",
		"vol" => "Volapuk",
		"wa" => "Walloon",
		"wln" => "Walloon",
		"cy" => "Welsh",
		"wel" => "Welsh",
		"cym" => "Welsh",
		"fy" => "Western Frisian",
		"fry" => "Western Frisian",
		"wo" => "Wolof",
		"wol" => "Wolof",
		"xh" => "Xhosa",
		"xho" => "Xhosa",
		"yi" => "Yiddish",
		"yid" => "Yiddish",
		"yo" => "Yoruba",
		"yor" => "Yoruba",
		"za" => "Zhuang, Chuang",
		"zha" => "Zhuang, Chuang",
		"zu" => "Zulu",
		"zul" => "Zulu"
	);
	return $lang[$code];
}


class QueryParser {

	public $query;
	public $queryNormalizedWhitespace;
	public $queryCharacterCount;
	// public $queryWordCount;
	public $queryKeywords;
	public $queryType;// citaton, known item, 
	//public $isCitation;
	public $citationParser;
	public $wordTagger;
	public $spellChecker;
	public $nGram;
	public $summonAPI;
	//
	public $bestResult;

	/**
	 * Takes the connection parameters
	 *
	 * @param string $url Server URL
	 * @param mixed $request_jsonrpc_version JSON-RPC version (1 or 2) 
	 * @param boolean $debug
	 */
	public function __construct($query) {
		// decode url encoded string. ex. %3F becomes ?
		$query = urldecode($query);

		// convert microsoft word character crap to normal stuff
		$query = $this->fixMSWordCharacters($query);

		// assign object properties
		$this->query = $query;
		$this->queryNormalizedWhitespace = $this->normalizeWhitespace($query);
		$this->queryKeywords = $this->getKeywords($query);
		$this->queryCharacterCount = $this->queryCharacterCount($query);



		// determine what type of query it is
		// ex. identifier, citation
		if ( $this->isIdentifier( $this->queryNormalizedWhitespace ) ) {
			// its an Identifier such as ISBN, ISSN, DOI, OCLC... etc...
			// $this->bestResult['image'] = $this->identifierParser->image;
			// $this->bestResult['title'] = $this->identifierParser->title;
			// $this->bestResult['url'] = $this->identifierParser->url;
			// $this->bestResult['data'] = $this->identifierParser->data;


			//$this->bestResult = $this->identifierParser->results;
			foreach ($this->identifierParser->results as $key => $result) {
				$title []= $result['identifierType'];
			}
			$title = array_unique($title);
			$title = implode('/', $title) . ' Match';
			$this->bestResult = array(
				'title' => $title,
				'results' => $this->identifierParser->results,
			);


			// if (isset($this->identifierParser->DOI)) {
			// 	$this->summonApi( $this->queryNormalizedWhitespace, (array) $this->citationParser );
			// 	if (isset($this->summonAPI->result['Title'])) {
			// 		$this->bestResult['image'] = $this->validImage( $this->summonAPI->result['thumbnail_m'][0] );
			// 		$this->bestResult['title'] = $this->replaceWithBold($this->queryKeywords, $this->summonAPI->result['Title'][0]);
			// 		$this->bestResult['url'] = $this->summonAPI->result['link'];
			// 		$this->bestResult['data'] = array(
			// 			'Authors' => implode(', ', $this->summonAPI->result['Author']),
			// 			'Date' => date("n/j/Y", strtotime($this->summonAPI->result['PublicationDate'][0])),
			// 			'Publication' => $this->summonAPI->result['PublicationTitle'][0],
			// 			'Publisher' => $this->summonAPI->result['Publisher'][0],
			// 			'Type' => $this->summonAPI->result['ContentType'][0],
			// 			'Discipline' => $this->summonAPI->result['Discipline'][0],
			// 		);
			// 		$this->checkSpelling( $this->queryNormalizedWhitespace );
			// 		return;
			// 	}
			// }


			return;
		} else if ( $apiKnownTitle = $this->isKnownTitle( $this->queryNormalizedWhitespace ) ) {

			$api = $apiKnownTitle;
			
			//print_r($api);

			// $api = $api->results['documents'][0];
			// echo 34;
			// print_r($api);

			// 
			if (isset($api['Title'][0])) {
				$this->bestResult['beyondCollection'] = $api['inHoldings'] == 1 ? false : true;
				$this->bestResult['image'] = $this->validImage( $api['thumbnail_m'][0] );
				$fullTitle = $api['Subtitle'][0] ? $api['Title'][0] . ': ' . $api['Subtitle'][0] : $api['Title'][0];
				$this->bestResult['title'] = $this->replaceWithBold($this->queryKeywords, $fullTitle);
				$this->bestResult['url'] = $api['link'];
				$this->bestResult['data'] = array(
					'Authors' => implode('. ', $api['Author']),
					'Published' => $api['PublicationDate_xml'][0]['month'] ? date("n/j/Y", strtotime($api['PublicationDate_xml'][0]['text'])) : ($api['PublicationDate_xml'][0]['year'] ? $api['PublicationDate_xml'][0]['year'] : null),
					'Publication' => ($api['ContentType'][0] !== 'Book' && $api['ContentType'][0] !== 'eBook') ? $api['PublicationTitle'][0] . ($api['Volume'][0] ? '<br> Volume ' . $api['Volume'][0] . ', Issue ' . $api['Issue'][0] : '') : '',
					'Publisher' => $api['Publisher'][0],
					'Type' => $api['ContentType'][0],
					'Discipline' => $api['Discipline'][0],
					'Language' => $api['Language'][0],
					'Page Count' => $api['PageCount'][0],
					'DOI' => $api['DOI'][0],
					'LCCN' => $api['LCCN'][0],
					'OCLC' => implode(', ', $api['OCLC']),
					'ISBN' => implode(', ', $api['ISBN']),
					'ISSN' => implode(', ', $api['ISSN']),
					'Genre' => implode(', ', $api['Genre'][0]),
					'Library' => $api['Library'][0],
					'Abstract' => $api['Abstract'][0],
					//'Snippet' => $api['Snippet'][0],
				);
				$this->checkSpelling( $this->queryNormalizedWhitespace );
				//$this->bestResult = array($this->bestResult);
				$this->bestResult = array(
					'title' => $api['ContentType'][0] . ' Title Match',
					'results' => array($this->bestResult),
				);
				return;
			}




		} else if ( $this->isCitation( $this->queryNormalizedWhitespace ) ) {
			// its a Citation
			//$this->summonApi( $this->queryNormalizedWhitespace, (array) $this->citationParser );

// 			error_reporting(E_ALL);
// ini_set('display_errors', 1);

			//echo 'is cit';
			$api = $this->summonApi( $this->queryNormalizedWhitespace, (array) $this->citationParser );
			$api = $api->results['documents'][0];
			$doiBeyondCollection = false;

			//print_r($api);
			//print_r(  (array) $this->citationParser   );
			if (!$api['Title'][0]) {
				// beyond libraries collection
				//$api = $this->summonApi( $match[1], array('holdings' => false), array('s.fq' => 'doi:'.$match[1]) );
				$api = $this->summonApi( $this->queryNormalizedWhitespace, array_merge((array) $this->citationParser, array('holdings' => false)));

				$api = $api->results['documents'][0];
				$doiBeyondCollection = true;

				// echo '<pre>';
				// print_r($api);
				// echo '</pre>';

				//$api['DOI'][0]

				/*
				if ($api['Title'][0]) {
					// so it truly exists but is outside collection
					$crossrefApiUrl = "https://doi.crossref.org/openurl/?pid=em7418@wayne.edu&format=unixref&id=doi:" .$api['DOI'][0]. "&noredirect=true";
					$crossrefApiXml = simplexml_load_file($crossrefApiUrl);
					//print_r($crossrefApiXml);
					//print_r($crossrefApiXml->doi_record->crossref->journal->journal_article->doi_data->resource);
					//print_r($crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive);
					//echo $crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive;
					if (
						//isset($crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive)
						(string) $crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive != "true"
						) {
						// that means its NOT exclusive to the owner so that we can use it FREE
						// then change link to doi_data.resource
						$api['link'] = (string) $crossrefApiXml->doi_record->crossref->journal->journal_article->doi_data->resource;
						//echo $api['link'];
						$doiBeyondCollection = false;
					}
				}
				*/
			}
			// 
			if (isset($api['Title'][0])) {
				$this->bestResult['beyondCollection'] = $doiBeyondCollection;
				$this->bestResult['image'] = $this->validImage( $api['thumbnail_m'][0] );
				$fullTitle = $api['Subtitle'][0] ? $api['Title'][0] . ': ' . $api['Subtitle'][0] : $api['Title'][0];
				$this->bestResult['title'] = $this->replaceWithBold($this->queryKeywords, $fullTitle);
				$this->bestResult['url'] = $api['link'];
				$this->bestResult['data'] = array(
					'Authors' => implode('. ', $api['Author']),
					'Date' => date("n/j/Y", strtotime($api['PublicationDate'][0])),
					'Publication' => $api['PublicationTitle'][0],
					'Publisher' => $api['Publisher'][0],
					'Type' => $api['ContentType'][0],
					'Discipline' => $api['Discipline'][0],
					'DOI' => $api['DOI'][0],
				);
				$this->checkSpelling( $this->queryNormalizedWhitespace );
				//$this->bestResult = array($this->bestResult);
				$this->bestResult = array(
					'title' => 'Citation Match',
					'results' => array($this->bestResult),
				);
				return;
			}
		// } else if ( $apiAreYouLookingFor = $this->isAreYouLookingFor( $this->queryNormalizedWhitespace ) ) {


		// 	$this->bestResult = array(
		// 		'title' => 'Are you looking for:',
		// 		'resultsPossible' => $apiAreYouLookingFor,
		// 	);





		} else {
			// something else...
			//$this->checkSpelling( $this->queryNormalizedWhitespace );
			return;
		}
	}

	/**
	 * Sets the notification state of the object.
	 * In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function normalizeWhitespace($str) {
		return trim( preg_replace("/\s+/", " ", $str) );
	}

	/**
	 * Sets the notification state of the object.
	 * In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function fixMSWordCharacters($string) {
		// $search1 = [                 // www.fileformat.info/info/unicode/<NUM>/ <NUM> = 2018
		//                "\xC2\xAB",     // « (U+00AB) in UTF-8
		//                "\xC2\xBB",     // » (U+00BB) in UTF-8
		//                "\xE2\x80\x98", // ‘ (U+2018) in UTF-8
		//                "\xE2\x80\x99", // ’ (U+2019) in UTF-8
		//                "\xE2\x80\x9A", // ‚ (U+201A) in UTF-8
		//                "\xE2\x80\x9B", // ‛ (U+201B) in UTF-8
		//                "\xE2\x80\x9C", // “ (U+201C) in UTF-8
		//                "\xE2\x80\x9D", // ” (U+201D) in UTF-8
		//                "\xE2\x80\x9E", // „ (U+201E) in UTF-8
		//                "\xE2\x80\x9F", // ‟ (U+201F) in UTF-8
		//                "\xE2\x80\xB9", // ‹ (U+2039) in UTF-8
		//                "\xE2\x80\xBA", // › (U+203A) in UTF-8
		//                "\xE2\x80\x93", // – (U+2013) in UTF-8
		//                "\xE2\x80\x94", // — (U+2014) in UTF-8
		//                "\xE2\x80\xA6"  // … (U+2026) in UTF-8
		//    ];

		//    $replacements1 = [
		//                "<<", 
		//                ">>",
		//                "'",
		//                "'",
		//                "'",
		//                "'",
		//                '"',
		//                '"',
		//                '"',
		//                '"',
		//                "<",
		//                ">",
		//                "-",
		//                "-",
		//                "..."
		//    ];

		//    $string = str_replace($search1, $replacements1, $string);

	    // convert microsoft word character crap to normal stuff
		// function convert_smart_quotes2($string) { 
		//     $search = array(
		// 		chr(145),
		// 		chr(146),
		// 		chr(147),
		// 		chr(148),
		// 		chr(151),
		// 	);
		//     $replace = array(
		// 		"'",
		// 		"'",
		// 		'"',
		// 		'"',
		// 		'-',
		// 	);
		//     return str_replace($search, $replace, $string); 
		// }
		// $string = convert_smart_quotes2($string);




		// CORRECT WAY TO REPLACE smart quotes, em-dashes, and ellipses
		// http://www.toao.net/48-replacing-smart-quotes-and-em-dashes-in-mysql
		// First, replace UTF-8 characters.
		$string = str_replace(
		array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
		array("'", "'", '"', '"', '-', '-', '...'),
		$string);
		// Next, replace their Windows-1252 equivalents.
		$string = str_replace(
		array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)),
		array("'", "'", '"', '"', '-', '-', '...'),
		$string);

		// then do this stuff
		$map = Array(
			'33' => '!', '34' => '"', '35' => '#', '36' => '$', '37' => '%', '38' => '&', '39' => "'", '40' => '(', '41' => ')', '42' => '*', 
			'43' => '+', '44' => ',', '45' => '-', '46' => '.', '47' => '/', '48' => '0', '49' => '1', '50' => '2', '51' => '3', '52' => '4', 
			'53' => '5', '54' => '6', '55' => '7', '56' => '8', '57' => '9', '58' => ':', '59' => ';', '60' => '<', '61' => '=', '62' => '>', 
			'63' => '?', '64' => '@', '65' => 'A', '66' => 'B', '67' => 'C', '68' => 'D', '69' => 'E', '70' => 'F', '71' => 'G', '72' => 'H', 
			'73' => 'I', '74' => 'J', '75' => 'K', '76' => 'L', '77' => 'M', '78' => 'N', '79' => 'O', '80' => 'P', '81' => 'Q', '82' => 'R', 
			'83' => 'S', '84' => 'T', '85' => 'U', '86' => 'V', '87' => 'W', '88' => 'X', '89' => 'Y', '90' => 'Z', '91' => '[', '92' => '\\', 
			'93' => ']', '94' => '^', '95' => '_', '96' => '`', '97' => 'a', '98' => 'b', '99' => 'c', '100'=> 'd', '101'=> 'e', '102'=> 'f', 
			'103'=> 'g', '104'=> 'h', '105'=> 'i', '106'=> 'j', '107'=> 'k', '108'=> 'l', '109'=> 'm', '110'=> 'n', '111'=> 'o', '112'=> 'p', 
			'113'=> 'q', '114'=> 'r', '115'=> 's', '116'=> 't', '117'=> 'u', '118'=> 'v', '119'=> 'w', '120'=> 'x', '121'=> 'y', '122'=> 'z', 
			'123'=> '{', '124'=> '|', '125'=> '}', '126'=> '~', '127'=> ' ', '128'=> '&#8364;', '129'=> ' ', '130'=> ',', '131'=> ' ', '132'=> '"', 
			'133'=> '.', '134'=> ' ', '135'=> ' ', '136'=> '^', '137'=> ' ', '138'=> ' ', '139'=> '<', '140'=> ' ', '141'=> ' ', '142'=> ' ', 
			'143'=> ' ', '144'=> ' ', '145'=> "'", '146'=> "'", '147'=> '"', '148'=> '"', '149'=> '.', '150'=> '-', '151'=> '-', '152'=> '~', 
			'153'=> ' ', '154'=> ' ', '155'=> '>', '156'=> ' ', '157'=> ' ', '158'=> ' ', '159'=> ' ', '160'=> ' ', '161'=> '¡', '162'=> '¢', 
			'163'=> '£', '164'=> '¤', '165'=> '¥', '166'=> '¦', '167'=> '§', '168'=> '¨', '169'=> '©', '170'=> 'ª', '171'=> '«', '172'=> '¬', 
			'173'=> '­', '174'=> '®', '175'=> '¯', '176'=> '°', '177'=> '±', '178'=> '²', '179'=> '³', '180'=> '´', '181'=> 'µ', '182'=> '¶', 
			'183'=> '·', '184'=> '¸', '185'=> '¹', '186'=> 'º', '187'=> '»', '188'=> '¼', '189'=> '½', '190'=> '¾', '191'=> '¿', '192'=> 'À', 
			'193'=> 'Á', '194'=> 'Â', '195'=> 'Ã', '196'=> 'Ä', '197'=> 'Å', '198'=> 'Æ', '199'=> 'Ç', '200'=> 'È', '201'=> 'É', '202'=> 'Ê', 
			'203'=> 'Ë', '204'=> 'Ì', '205'=> 'Í', '206'=> 'Î', '207'=> 'Ï', '208'=> 'Ð', '209'=> 'Ñ', '210'=> 'Ò', '211'=> 'Ó', '212'=> 'Ô', 
			'213'=> 'Õ', '214'=> 'Ö', '215'=> '×', '216'=> 'Ø', '217'=> 'Ù', '218'=> 'Ú', '219'=> 'Û', '220'=> 'Ü', '221'=> 'Ý', '222'=> 'Þ', 
			'223'=> 'ß', '224'=> 'à', '225'=> 'á', '226'=> 'â', '227'=> 'ã', '228'=> 'ä', '229'=> 'å', '230'=> 'æ', '231'=> 'ç', '232'=> 'è', 
			'233'=> 'é', '234'=> 'ê', '235'=> 'ë', '236'=> 'ì', '237'=> 'í', '238'=> 'î', '239'=> 'ï', '240'=> 'ð', '241'=> 'ñ', '242'=> 'ò', 
			'243'=> 'ó', '244'=> 'ô', '245'=> 'õ', '246'=> 'ö', '247'=> '÷', '248'=> 'ø', '249'=> 'ù', '250'=> 'ú', '251'=> 'û', '252'=> 'ü', 
			'253'=> 'ý', '254'=> 'þ', '255'=> 'ÿ'
		);
		
		$search = Array();
		$replace = Array();

		foreach ($map as $s => $r) {
			$search[] = chr((int)$s);
			$replace[] = $r;
		}

		return str_replace($search, $replace, $string);
	}

	/**
	 * Sets the notification state of the object.
	 * In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function getKeywords($query) {
		$arr = array_unique( explode(" ", preg_replace("/[^A-Za-z0-9 ]/", "", $this->normalizeWhitespace($query)) ) );// we only want to replace each term once
		// remove emptys
		$arr = array_filter($arr);
		$arr = array_values($arr);
		// return
		return $arr;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function queryCharacterCount($query) {
		return strlen($query);
	}

	// /**
	//  * description...
	//  *
	//  * @param string $query
	//  */
	// public function queryWordCount($query) {
	// 	return strlen($query);
	// }

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function isIdentifier($query) {
		// if (preg_match("/^([0-9]{8})$/i", $query, $match)) {
		// 	$this->ISSN = $match[1];
		// 	//http://coverart.oclc.org/ImageWebSvc/oclc/+-+05812780_70.jpg?SearchOrder=+-+OT,OS,TN,AV,GO,FA
		// } else if (preg_match("/^([0-9]{10})$/i", $query, $match)) {
		// 	$this->ISBN10 = $match[1];
		// 	$this->itemImage = 'https://secure.syndetics.com/index.aspx?isbn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
		// 	$this->itemElibraryUrl = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/marc&FF=i" .$match[1] . "&1%2C1%2C";
		// } else if (preg_match("/^(978[0-9]{10})$/i", $query, $match)) {
		// 	$this->ISBN13 = $match[1];
		// 	$this->itemImage = 'https://secure.syndetics.com/index.aspx?isbn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
		// 	$this->itemElibraryUrl = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/marc&FF=i" .$match[1] . "&1%2C1%2C";
		// }

		// require 'querypath-master/src/qp.php';

		// function requestUrl($url) {
		// 	// Must set $url first. Duh...
		// 	$curl = curl_init();
		// 	// Make curl_exec return the data instead of outputting it.
		// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// 	// The URL to be downloaded is set
		// 	curl_setopt($curl, CURLOPT_URL, $url);
		// 	// Return the HTTP headers
		// 	//curl_setopt($curl, CURLOPT_HEADER, true);
		// 	// set max redirects
		// 	//curl_setopt($curl, CURLOPT_MAXREDIRS, 0);
		// 	// exec
		// 	$response = curl_exec($curl);
		// 	$info = curl_getinfo($curl);
		// 	curl_close($curl);
		// 	//print_r($info);
		// 	return array(
		// 		'response' => $response,
		// 		'info' => $info,
		// 	);
		// }

		// $page = requestUrl($this->itemElibraryUrl);
		// $qp = htmlqp($page['response'], 'body');

		// foreach ($qp->find('#main > div > pre') as $child) {
		// 	echo $child->html();
		// }


		$this->identifierParser = new IdentifierParser($query);

		return $this->identifierParser->isIdentifier;
		// if ($this->identifierParser->isIdentifier) {
		// 	$this->bestResultImage = $this->identifierParser->image;
		// }


	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function isCitation($query) {
		$this->citationParser = new CitationParser($query);
		return $this->citationParser->isCitation;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function isKnownTitle($query) {
		//echo 777777 . PHP_EOL;

		//if ( str_word_count($query) >= 3 ) {
		if ( str_word_count($query) >= 1 ) {
			$api = $this->summonApi( $this->queryNormalizedWhitespace, array_merge(array('title' => $this->queryNormalizedWhitespace, 'anyContentType' => 'true'), array('holdings' => false)) );
			$apiDocuments = $api->results['documents'];

			//print_r( $api );

			// // FIRST TRY
			// foreach ($apiDocuments as $key => $apiDocument) {
			// 	//echo $apiDocument['Title'][0] . PHP_EOL;
			// 	if ( $this->normalizeWhitespace(strtolower($apiDocument['Title'][0])) == $this->normalizeWhitespace(strtolower($this->queryNormalizedWhitespace)) ) {
			// 		//echo $apiDocument['Title'][0] . PHP_EOL;

			// 		// it can either be a book, or some other content type if it has more than 3 words
			// 		if ($apiDocument['ContentType'][0] == 'Book') {
			// 			return $apiDocument;
			// 		} else if ( str_word_count($query) >= 3 ) {
			// 			return $apiDocument;
			// 		}

			// 	}
			// }
			// // THEN TRY
			// foreach ($apiDocuments as $key => $apiDocument) {
			// 	//preg_replace('/[^A-Za-z0-9\-\s]/', '', $string);
			// 	//$string = preg_replace("/[^ \w]+/", "", $string);
			// 	if ( $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $apiDocument['Title'][0]))) == $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $this->queryNormalizedWhitespace))) ) {
			// 		echo $apiDocument['Title'][0] . PHP_EOL;

			// 		// it can either be a book, or some other content type if it has more than 3 words
			// 		if ($apiDocument['ContentType'][0] == 'Book') {
			// 			return $apiDocument;
			// 		} else if ( str_word_count($query) >= 3 ) {
			// 			return $apiDocument;
			// 		}

			// 	}
			// }


			// FIRST TRY
			foreach ($apiDocuments as $key => $apiDocument) {
				//echo $apiDocument['Title'][0] . PHP_EOL;

				$fullTitle = $apiDocument['Subtitle'][0] ? $apiDocument['Title'][0] . ': ' . $apiDocument['Subtitle'][0] : $apiDocument['Title'][0];
				$fullTitleNoColon = $apiDocument['Subtitle'][0] ? $apiDocument['Title'][0] . ' ' . $apiDocument['Subtitle'][0] : $apiDocument['Title'][0];
				$fullTitleWithAuthor = $apiDocument['Author'][0] . '. ' . $fullTitle;


				// $queryWordsArray = $this->getKeywords( strtolower($this->queryNormalizedWhitespace) );
				// $titleWordsArray = $this->getKeywords( strtolower($fullTitle) );

				

				// print_r($queryWordsArray);
				// print_r($titleWordsArray);
				// print_r($authorWordsArray);
				// print_r($apiDocument['Author_xml']);

				// echo $fullTitle . PHP_EOL;
				// echo $this->queryNormalizedWhitespace . PHP_EOL;
				// echo strpos(strtolower($this->queryNormalizedWhitespace), strtolower($fullTitle));


				// add every word to array
				// then remove matches 
				// then remove or words in array (fist name last name middle name, or initials )
				// 
				$removeTitleInQuery = false;
				if ( strpos(strtolower($this->queryNormalizedWhitespace), strtolower($fullTitle)) !== false ) {
					$removeTitleInQuery = str_replace(strtolower($fullTitle), '', strtolower($this->queryNormalizedWhitespace));
				} else if ( strpos(strtolower($this->queryNormalizedWhitespace), strtolower($fullTitleNoColon)) !== false ) {
					$removeTitleInQuery = str_replace(strtolower($fullTitleNoColon), '', strtolower($this->queryNormalizedWhitespace));
				} 
				// else if ( strpos(strtolower($this->queryNormalizedWhitespace), strtolower($fullTitle . ' by')) !== FALSE ) {
				// 	$removeTitleInQuery = str_replace(strtolower($fullTitle . ' by'), '', strtolower($this->queryNormalizedWhitespace));
				// } else if ( strpos(strtolower($this->queryNormalizedWhitespace), strtolower($fullTitleNoColon . ' by')) !== FALSE ) {
				// 	$removeTitleInQuery = str_replace(strtolower($fullTitleNoColon . ' by'), '', strtolower($this->queryNormalizedWhitespace));
				// }






				if ( $removeTitleInQuery !== false ) {
					//echo 'PIOSSIBLY FOUND' . $removeTitleInQuery;

					// print_r($queryWordsArray);
					// print_r($titleWordsArray);
					// print_r($authorWordsArray);
					// print_r($apiDocument['Author_xml']);

					$authorWordsArray = array('by');
					foreach ($apiDocument['Author_xml'] as $key => $author) {
						# code...
						$authorWordsArray = array_merge($authorWordsArray, $this->getKeywords( strtolower($author['fullname']) ) );
						foreach ($this->getKeywords( strtolower($author['fullname']) ) as $key => $authorFullnameWord) {
							# code...
							$authorWordsArray[] = $authorFullnameWord[0];
						}
					}

					$removeTitleInQueryArray = $this->getKeywords($removeTitleInQuery);
					foreach ($removeTitleInQueryArray as $key => $possiblyJustNames) {
						# code...
						if (in_array($possiblyJustNames, $authorWordsArray)) {
							unset($removeTitleInQueryArray[$key]);
						}
					}

					// echo 'IF THIS EMPTY THEN FOUND ITTT';
					// print_r($removeTitleInQueryArray);

					if (count($removeTitleInQueryArray) == 0) {
						// it can either be a book, or some other content type if it has more than 3 words
						if ($apiDocument['ContentType'][0] == 'Book' && str_word_count($query) >= 3) {
							return $apiDocument;
						} else if ( str_word_count($query) >= 3 ) {
							return $apiDocument;
						}
					}
				}








				// if ( $this->normalizeWhitespace(strtolower($fullTitle)) == $this->normalizeWhitespace(strtolower($this->queryNormalizedWhitespace)) ) {
				// 	//echo $apiDocument['Title'][0] . PHP_EOL;

				// 	// it can either be a book, or some other content type if it has more than 3 words
				// 	if ($apiDocument['ContentType'][0] == 'Book') {
				// 		return $apiDocument;
				// 	} else if ( str_word_count($query) >= 3 ) {
				// 		return $apiDocument;
				// 	}

				// } else if ( $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $fullTitle))) == $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $this->queryNormalizedWhitespace))) ) {
				// 	//echo $apiDocument['Title'][0] . PHP_EOL;

				// 	// it can either be a book, or some other content type if it has more than 3 words
				// 	if ($apiDocument['ContentType'][0] == 'Book') {
				// 		return $apiDocument;
				// 	} else if ( str_word_count($query) >= 3 ) {
				// 		return $apiDocument;
				// 	}

				// }  else if ( $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $fullTitleWithAuthor))) == $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $this->queryNormalizedWhitespace))) ) {
				// 	//echo $apiDocument['Title'][0] . PHP_EOL;

				// 	// it can either be a book, or some other content type if it has more than 3 words
				// 	if ($apiDocument['ContentType'][0] == 'Book') {
				// 		return $apiDocument;
				// 	} else if ( str_word_count($query) >= 3 ) {
				// 		return $apiDocument;
				// 	}

				// } 

			}


		}

		return false;
	}


	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function isAreYouLookingFor($query) {
		//echo 777777 . PHP_EOL;

		//if ( str_word_count($query) >= 3 ) {
		if ( str_word_count($query) >= 1 ) {
			$api = $this->summonApi( $this->queryNormalizedWhitespace, array_merge(array('title' => $this->queryNormalizedWhitespace, 'anyContentType' => 'true'), array('holdings' => false)) );
			$apiDocuments = $api->results['documents'];

			//print_r( $api );

			// // FIRST TRY
			// foreach ($apiDocuments as $key => $apiDocument) {
			// 	//echo $apiDocument['Title'][0] . PHP_EOL;
			// 	if ( $this->normalizeWhitespace(strtolower($apiDocument['Title'][0])) == $this->normalizeWhitespace(strtolower($this->queryNormalizedWhitespace)) ) {
			// 		//echo $apiDocument['Title'][0] . PHP_EOL;

			// 		// it can either be a book, or some other content type if it has more than 3 words
			// 		if ($apiDocument['ContentType'][0] == 'Book') {
			// 			return $apiDocument;
			// 		} else if ( str_word_count($query) >= 3 ) {
			// 			return $apiDocument;
			// 		}

			// 	}
			// }
			// // THEN TRY
			// foreach ($apiDocuments as $key => $apiDocument) {
			// 	//preg_replace('/[^A-Za-z0-9\-\s]/', '', $string);
			// 	//$string = preg_replace("/[^ \w]+/", "", $string);
			// 	if ( $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $apiDocument['Title'][0]))) == $this->normalizeWhitespace(strtolower(preg_replace("/[^ \w]+/", "", $this->queryNormalizedWhitespace))) ) {
			// 		echo $apiDocument['Title'][0] . PHP_EOL;

			// 		// it can either be a book, or some other content type if it has more than 3 words
			// 		if ($apiDocument['ContentType'][0] == 'Book') {
			// 			return $apiDocument;
			// 		} else if ( str_word_count($query) >= 3 ) {
			// 			return $apiDocument;
			// 		}

			// 	}
			// }




			// $queryKeywords = $this->getKeywords(strtolower($query));
			// //print_r($queryKeywords);


			// // FIRST TRY
			// foreach ($apiDocuments as $key => $apiDocument) {
			// 	//echo $apiDocument['Title'][0] . PHP_EOL;

			// 	//$fullTitle = $apiDocument['Subtitle'][0] ? $apiDocument['Title'][0] . ': ' . $apiDocument['Subtitle'][0] : $apiDocument['Title'][0];
			// 	//$fullTitleWithAuthor = $apiDocument['Author'][0] . '. ' . $fullTitle;

				
			// 	$itemTitleKeywords = $this->getKeywords(strtolower($apiDocument['Title'][0] . ' ' . $apiDocument['Subtitle'][0]));
			// 	//$itemAuthorKeywords = $this->getKeywords(strtolower($apiDocument['Author'][0]));
			// 	//print_r($itemTitleKeywords);
				
			// 	$keywordMatches = array();

			// 	foreach ($queryKeywords as $queryKeyword) {
			// 		if (in_array($queryKeyword, $itemTitleKeywords)) {
			// 			$keywordMatches[] = $queryKeyword;
			// 			//echo $queryKeyword . PHP_EOL;
			// 		} else {
			// 			//echo 'NO ' . $queryKeyword . PHP_EOL;
			// 		}
			// 		// if (in_array($queryKeyword, $itemAuthorKeywords)) {
			// 		// 	$keywordMatches[] = $value;
			// 		// }
			// 	}

			// 	//return;

			// 	// echo count($keywordMatches). PHP_EOL;
			// 	// echo count($itemTitleKeywords). PHP_EOL;
			// 	// echo $apiDocument['Title'][0] .' '. $apiDocument['Subtitle'][0] . PHP_EOL;

				

			// 	if ( count($keywordMatches) / count($queryKeywords) > 0.6 ) {	
			// 		echo 'ARE YOU LOOKING FOR:' . PHP_EOL;
			// 		echo 'TITLE: ' . $apiDocument['Title'][0] .' '. $apiDocument['Subtitle'][0] . PHP_EOL;
			// 		echo 'AUTHOR: ' .$apiDocument['Author'][0] . PHP_EOL;
			// 	}


			// }

			foreach ($apiDocuments as $key => $apiDocument) {
				$fullTitle = ($apiDocument['Subtitle'][0] ? $apiDocument['Title'][0] . ': ' . $apiDocument['Subtitle'][0] : $apiDocument['Title'][0]);
				$fullTitleLCASE = strtolower($apiDocument['Subtitle'][0] ? $apiDocument['Title'][0] . ': ' . $apiDocument['Subtitle'][0] : $apiDocument['Title'][0]);
				$queryLCASE = strtolower($query);

				// echo $fullTitle . PHP_EOL;
				// echo $apiDocument['Author'][0] . PHP_EOL;
				// echo levenshtein($fullTitleLCASE, $queryLCASE) . PHP_EOL;

				$levenshteinRankedTitles []= array(
					'summonRank' => $key,
					'levenshtein' => levenshtein($fullTitleLCASE, $queryLCASE),
					'title' => $fullTitle,
					'author' => $apiDocument['Author'][0],
					'type' => $apiDocument['ContentType'][0],
				);



			}

			// print_r($levenshteinRankedTitles);


			// function sortByLevenshtein($a, $b)
			// {
			//     $a = $a['levenshtein'];
			//     $b = $b['levenshtein'];

			//     if ($a == $b)
			//     {
			//         return 0;
			//     }

			//     return ($a < $b) ? -1 : 1;
			// }
			// uasort($levenshteinRankedTitles, 'sortByLevenshtein');

			// function cmp_by_optionNumber($a, $b) {
			// 	return $a["levenshtein"] - $b["levenshtein"];
			// }
			// usort($levenshteinRankedTitles, "cmp_by_optionNumber");


			usort($levenshteinRankedTitles, function($a, $b) { 
			    $rdiff = $a['levenshtein'] - $b['levenshtein'];
			    if ($rdiff) return $rdiff; 
			    return $a['summonRank'] - $b['summonRank']; 
			}); // anonymous function requires PHP 5.3 - use "normal" function earlier

			//print_r($levenshteinRankedTitles);



			// $levenshteinRankedTitles = array_reverse($levenshteinRankedTitles);
			// $order = range(1, count($levenshteinRankedTitles));
			// array_multisort($levenshteinRankedTitles, SORT_ASC, $order, SORT_ASC);



			foreach ($levenshteinRankedTitles as $key => $levenshteinRankedTitle) {
				# code...
				if ($levenshteinRankedTitle['levenshtein'] > 15) {
					unset($levenshteinRankedTitles[$key]);
				}
			}

			//print_r($levenshteinRankedTitles);

			if (count($levenshteinRankedTitles) > 0) {
				return $levenshteinRankedTitles;
			} else {
				return false;
			}


		}

		return false;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function checkSpelling($query) {
		$this->spellChecker = new SpellChecker($query);
	}

	// /**
	//  * description...
	//  *
	//  * @param string $query
	//  */
	// public function summonApi($queryNormalizedWhitespace, $summonOptionsArray) {
	// 	//print_r($summonOptionsArray);
	// 	$this->summonAPI = new SummonAPI($queryNormalizedWhitespace, $summonOptionsArray);
	// 	if ($this->summonAPI->result['title'][0] == '') {
	// 		// $this->summonAPI = new SummonAPI($queryNormalizedWhitespace, array());
	// 	}
	// }

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function summonApi($queryNormalizedWhitespace, $summonOptionsArray, $filters) {
		//print_r($summonOptionsArray);
		return new SummonAPI($queryNormalizedWhitespace, $summonOptionsArray, $filters);
		// if ($this->summonAPI->result['title'][0] == '') {
		// 	// $this->summonAPI = new SummonAPI($queryNormalizedWhitespace, array());
		// }
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function replaceWithBoldDONTDOTHIS($terms, $target) {
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
			//$target = preg_replace('/\b(' . preg_quote($term) . ')\b/i', "<b>$1</b>", $target);
			//$target = preg_replace('/(' . preg_quote($term) . ')/i', "<b>$1</b>", $target);
			$target = preg_replace('/^(.*?)<b>(.*?)<\/b>(.*?)$/us'," <b>$2</b> ", $target);
		}
		return $target;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function replaceWithBold($terms, $target) {
		return $target;
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
			//$target = preg_replace('/\b(' . preg_quote($term) . ')\b/i', "<b>$1</b>", $target);
			$target = preg_replace('/(' . preg_quote($term) . ')/i', "<span>$1</span>", $target);
			//$target = preg_replace('/^(.*?)<b>(.*?)<\/b>(.*?)$/us'," <span>$2</span> ", $target);
		}






		// split by spaces


		return $target;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function validImage($src) {
		///$fgc = file_get_contents($src);
		//return $src;
		return str_replace('http://www.syndetics', 'https://secure.syndetics', $src );
	}

}







class IdentifierParser {


	public $isIdentifier = false;

	public $image;
	public $title;
	public $url;
	public $data;

	/**
	 * Takes the connection parameters
	 *
	 * @param string $url Server URL
	 * @param mixed $request_jsonrpc_version JSON-RPC version (1 or 2) 
	 * @param boolean $debug
	 */
	public function __construct($query) {

		require_once('querypath-master/src/qp.php');

		// ini_set('display_errors',1);
		// ini_set('display_startup_errors',1);
		// error_reporting(-1);

		//
		$results = array();

		if (preg_match("/^([0-9]{10}|(978[0-9]{10}|978-[0-9]{10}))$/i", $query, $match)) {
			// ISBN
			$api = $this->elibraryApi('ISBN', $match[1]);
			if ($api['hasResults']) {
				foreach ($api['results'] as $api) {
					$results[] = array(
						'identifier' => $api['data']['ISBN'] ? $api['data']['ISBN'] : $match[1],
						'identifierType' => $match[1].' as ISBN',
						'identifierType' => 'ISBN',
						'title' => $api['title'],
						'url' => $api['url'],
						'image' => $api['image'],
						'data' => $api['data'],
					);
				}
			}
		}

		if (preg_match("/^([0-9]{8}|[0-9]{4}\-[0-9]{4})$/i", $query, $match)) {
			// ISSN
			$api = $this->elibraryApi('ISSN', $match[1]);
			//if ( str_replace('-', '', $api['data']['ISSN']) == str_replace('-', '', $match[1]) ) {
			if ($api['hasResults']) {
				foreach ($api['results'] as $api) {
					$results[] = array(
						'identifier' => $match[1],
						'identifierType' => $match[1].' as ISSN',
						'identifierType' => 'ISSN',
						'title' => $api['title'],
						'url' => $api['url'],
						'image' => $api['image'],
						'data' => $api['data'],
					);
				}
			}
		}

		if (preg_match("/^([0-9]{7,10}|[0-9]{7}|ocm[0-9]{8}|om[0-9]{8}|ocn[0-9]{9}|on[0-9]{10,})$/i", $query, $match)) {
			// OCLC
			$api = $this->elibraryApi('OCLC', $match[1]);
			if ($api['hasResults']) {
				foreach ($api['results'] as $api) {
					$results[] = array(
						'identifier' => $match[1],
						'identifierType' => $match[1].' as OCLC',
						'identifierType' => 'OCLC',
						'title' => $api['title'],
						'url' => $api['url'],
						'image' => $api['image'],
						'data' => $api['data'],
					);
				}
			}
		}

		// 171 C159hE 1956
		// 020.82 As78m no.16  
		// 025.4 D515a 7th ed.  
		//261.8 N213c v.3  	
		//262.90Sch81g1c-Bd.1-2  	
		//262.90Sch81g1c-Bd.3  	
		if (preg_match("/^(([0-9]{3}|[0-9]{3}.[0-9]+) [a-zA-Z0-9]{1,7}( [0-9]{4}| no.[0-9]+| [0-9]+th ed.| v.[0-9]+|))$/i", $query, $match)) {
			// Dewey
			$api = $this->elibraryApi('Dewey', $match[1]);
			//if ($api['data']['Call Number'] == $api['data']['Call Number']) {
			if ($api['hasResults']) {
				foreach ($api['results'] as $api) {
					$results[] = array(
						'identifier' => $match[1],
						'identifierType' => $match[1].' as DDC',
						'identifierType' => 'Dewey',
						'title' => $api['title'],
						'url' => $api['url'],
						'image' => $api['image'],
						'data' => $api['data'],
					);
				}
			}
		}

		if (preg_match("/^([ .a-zA-Z0-9]+)$/i", $query, $match)) {
			// LCCN
			$api = $this->elibraryApi('LCCN', $match[1]);
			$this->resultsNumber = $api['resultsNumber'];
			if ($api['hasResults']) {
				if ($api['resultsNumber'] > 1) {
					$results[] = array(
						'identifier' => $match[1],
						// 'identifierType' => $match[1].' as LCCN',
						// 'identifierType' => 'LCCN',
						'title' => 'See '.$api['resultsNumber'].' LCCN results matching "'.$match[1].'"',
						'url' => $api['url'],
						// 'image' => $api['image'],
						// 'data' => $api['data'],
					);
				} else {
					foreach ($api['results'] as $api) {
						$results[] = array(
							'identifier' => $match[1],
							'identifierType' => $match[1].' as LCCN',
							'identifierType' => 'LCCN',
							'title' => $api['title'],
							'url' => $api['url'],
							'image' => $api['image'],
							'data' => $api['data'],
						);
					}
				}
			}
		}

		if (preg_match("/^(10[.][0-9]{4,}(?:[.][0-9]+)*\/(?:(?![%\"#? ])\\S)+)$/i", $query, $match)) {
			// DOI
			$api = $this->summonApi( $match[1], array('s.fq' => 'doi:'.$match[1]) );
			$api = $api->results['documents'][0];
			$doiBeyondCollection = false;

			if (!$api['Title'][0]) {
				// beyond libraries collection
				// it checks again but this time var holdings is false
				$api = $this->summonApi( $match[1], array('holdings' => false, 's.fq' => 'doi:'.$match[1]) );
				$api = $api->results['documents'][0];
				$doiBeyondCollection = true;
				/*
				if ($api['Title'][0]) {
					// so it truly exists but is outside collection
					$crossrefApiUrl = "https://doi.crossref.org/openurl/?pid=em7418@wayne.edu&format=unixref&id=doi:" .$match[1]. "&noredirect=true";
					$crossrefApiXml = simplexml_load_file($crossrefApiUrl);
					//print_r($crossrefApiXml);
					//print_r($crossrefApiXml->doi_record->crossref->journal->journal_article->doi_data->resource);
					//print_r($crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive);
					//echo $crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive;
					if (
						//isset($crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive)
						(string) $crossrefApiXml->doi_record->crossref->journal->journal_article->crossmark->crossmark_domain_exclusive != "true"
						) {
						// that means its NOT exclusive to the owner so that we can use it FREE
						// then change link to doi_data.resource
						$api['link'] = (string) $crossrefApiXml->doi_record->crossref->journal->journal_article->doi_data->resource;
						$doiBeyondCollection = false;
					}
				}
				*/
			}

			if ($api['Title'][0]) {
				$results[] = array(
					'beyondCollection' => $doiBeyondCollection,
					'identifier' => $match[1],
					'identifierType' => $match[1].' as DOI',
					'identifierType' => 'DOI',
					'title' => $this->replaceWithBold( $this->queryKeywords, $api['Title'][0] ),
					'url' => $api['link'],
					'image' => $this->validImage( $api['thumbnail_m'][0], 'https://secure.syndetics.com/index.aspx?issn=' .$api['EISSN'][0]. '/sc.gif&client=waynestmis&freeimage=true' ),
					'data' => array(
						'Authors' => implode(', ', $api['Author']),
						'Date' => date("n/j/Y", strtotime($api['PublicationDate'][0])),
						'Publication' => $api['PublicationTitle'][0],
						'Publisher' => $api['Publisher'][0],
						'Type' => $api['ContentType'][0],
						'Discipline' => $api['Discipline'][0],
						'DOI' => $api['DOI'][0],
						'PMID' => $api['PMID'][0] ? $api['PMID'][0] : null,
					),
				);
			}
		}

		if (preg_match("/^(PMID[ ]*([0-9]{8})|([0-9]{8}))$/i", $query, $match)) {
			// PMID
			$api = $this->pubmedApi('pubmed', $match[1]);
			if ($api['title']) {
				$results[] = array(
					'identifier' => $match[1],
					'identifierType' => $match[1].' as PMID',
					'identifierType' => 'PMID',
					'title' => $api['title'],
					'url' => $api['url'],
					'image' => $api['image'],
					'data' => $api['data'],
				);
			}
		}

		if (preg_match("/^PMC([0-9]{7})$/i", $query, $match)) {
			// PMCID
			$api = $this->pubmedApi('pmc', $match[1]);
			$results[] = array(
				'identifier' => $match[1],
				'identifierType' => $match[1].' as PMCID',
				'identifierType' => 'PMCID',
				'title' => $api['title'],
				'url' => $api['url'],
				'image' => $api['image'],
				'data' => $api['data'],
			);
		}

		// if (preg_match("/^([0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9X]{4})$/i", $query, $match)) {
		// 	// ORCID
		// 	$api = $this->orcidApi($match[1]);
		// 	if ($api['title']) {
		// 		$results[] = array(
		// 			'identifier' => $match[1],
		// 			'identifierType' => $match[1].' as ORCID',
		// 			'identifierType' => 'ORCID',
		// 			'title' => $api['title'],
		// 			'url' => $api['url'],
		// 			'data' => $api['data'],
		// 		);
		// 	}
		// }

		//
		$this->isIdentifier = count($results) >= 1;
		// 
		$this->results = $results;
		// foreach ($results as $key => $result) {
		// 	$title []= $result['identifierType'];
		// }
		// $title = implode('/', $title) . ' Match';
		// $this->results = array(
		// 	'title' => $title,
		// 	'results' => $results,
		// );
	}

	/**
	 * Sets the notification state of the object.
	 * In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function normalizeWhitespace($str) {
		return trim( preg_replace("/\s+/", " ", $str) );
	}

	/**
	 * Sets the notification state of the object.
	 * In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function requestUrl($url) {
		// Must set $url first. Duh...
		$curl = curl_init();
		// Make curl_exec return the data instead of outputting it.
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// The URL to be downloaded is set
		curl_setopt($curl, CURLOPT_URL, $url);
		// Return the HTTP headers
		curl_setopt($curl, CURLOPT_HEADER, true);
		// set max redirects
		//curl_setopt($curl, CURLOPT_MAXREDIRS, 0);
		// exec
		$response = curl_exec($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);
		//print_r($info);
		return array(
			'response' => $response,
			'info' => $info,
		);
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function elibraryApi($callNumType, $callNum) {

		

		

		if ($callNumType == 'ISBN') {
			$syndeticsImage = 'https://secure.syndetics.com/index.aspx?isbn=' .$callNum. '/sc.gif&client=waynestmis&freeimage=true';
			//$data['url'] = "http://elibrary.wayne.edu/search~S47?/i" .$callNum. "/i" .$callNum. "/1%2C2%2C2%2CE/frameset&FF=i" .$callNum. "&1%2C1%2C";
			//$data['url'] = "http://elibrary.wayne.edu/search~S47/?searchtype=i&searcharg=" .$callNum. "&searchscope=47&sortdropdown=-&SORT=D&extended=1&SUBMIT=Search&searchlimits=&searchorigarg=i" .$callNum;
			//$data['url'] = "http://elibrary.wayne.edu/search~S47?/i" .$callNum. "/i" .$callNum. "/1%2C2%2C3%2CE/2exact&FF=i" .$callNum. "&1%2C2%2C/indexsort=-";
			$data['url'] = "http://elibrary.wayne.edu/search~/?searchtype=i&searcharg=" .$callNum. "&SORT=D&searchscope=47";
		} else if ($callNumType == 'ISSN') {
			$callNum = str_replace('-', '', $callNum);
			$syndeticsImage = 'https://secure.syndetics.com/index.aspx?issn=' .$callNum. '/sc.gif&client=waynestmis&freeimage=true';
			//$data['url'] = "http://elibrary.wayne.edu/search~S47?/i" .$callNum. "/i" .$callNum. "/1%2C2%2C2%2CE/frameset&FF=i" .$callNum. "&1%2C1%2C";
			$data['url'] = "http://elibrary.wayne.edu/search~S47/?searchtype=i&searcharg=" .urlencode($callNum). "&searchscope=47&sortdropdown=-&SORT=D&extended=1&SUBMIT=Search&searchlimits=&searchorigarg=iurinbinnoscraper";
		} else if ($callNumType == 'OCLC') {
			if ($callNum[0] == '0') {
				$shortenedOcn = substr(preg_replace("/[a-zA-z]+/", "", $callNum), 1);
			} else {
				$shortenedOcn = preg_replace("/[a-zA-z]+/", "", $callNum);
			}
			//$data['url'] = "http://elibrary.wayne.edu/search~S47?/o" .$callNum. "/o" .$callNum. "/-3%2C0%2C0%2CE/frameset&FF=o" .$shortenedOcn. "&1%2C1%2C/indexsort=-";
			$data['url'] = "http://elibrary.wayne.edu/search~S47/?searchtype=o&searcharg=" .urlencode($shortenedOcn). "&searchscope=47&SORT=D&extended=1&SUBMIT=Search&searchlimits=&searchorigarg=ourinbinnoscraper";
		} else if ($callNumType == 'Dewey') {
			//$data['url'] = "http://elibrary.wayne.edu/search~S47?/e" .$callNum. "/e" .$callNum. "/-3%2C-1%2C0%2CB/frameset&FF=e" .$callNum. "&1%2C1%2C";
			//$data['url'] =  "http://elibrary.wayne.edu/search~S47/?searchtype=e&searcharg=" .$callNum. "&searchscope=47&sortdropdown=-&SORT=D&extended=0&SUBMIT=Search&searchlimits=&searchorigarg=e" .$callNum;
			//$data['url'] = "http://elibrary.wayne.edu/search~S47/?searchtype=e&searcharg=" .$callNum. "&searchscope=47&SORT=D&extended=0&SUBMIT=Search&searchlimits=&searchorigarg=e" .$callNum;
			$data['url'] = "http://elibrary.wayne.edu/search~S47/?searchtype=e&searcharg=" .urlencode($callNum). "&searchscope=47&sortdropdown=-&SORT=D&extended=0&SUBMIT=Search&searchlimits=&searchorigarg=eurinbinnoscraper";
		} else if ($callNumType == 'LCCN') {
			//$data['url'] = "http://elibrary.wayne.edu/search~S47?/e" .$callNum. "/e" .$callNum. "/-3%2C-1%2C0%2CB/frameset&FF=e" .$callNum. "&1%2C1%2C";
			//$data['url'] =  "http://elibrary.wayne.edu/search~S47/?searchtype=e&searcharg=" .$callNum. "&searchscope=47&sortdropdown=-&SORT=D&extended=0&SUBMIT=Search&searchlimits=&searchorigarg=e" .$callNum;
			$data['url'] = "http://elibrary.wayne.edu/search~S47/?searchtype=c&searcharg=" .urlencode($callNum). "&searchscope=47&SORT=D&extended=1&SUBMIT=Search&searchlimits=&searchorigarg=curinbinnoscraper";
		}

		$page = $this->requestUrl($data['url']);
		$qp = htmlqp($page['response'], 'body');

		// echo '<pre>';
		// var_dump($qp);
		// echo '</pre>';
		//echo $data['url'];
		
		$data['hasResults'] = true;
		if ($qp->find('tr.msg')->text()) {
			// "no matches found"
			$data['hasResults'] = false;
		} else if ($qp->find('td.yourEntryWouldBeHere')->text()) {
			// "YOUR ENTRY WOULD BE HERE"
			$data['hasResults'] = false;
		} else if ($qp->find('span.briefcitTitle')->text()) {
			// MULTIPLE RESULTS?????
			// multiple print and electironic
			foreach ($qp->find('span.briefcitTitle > a') as $child) {
				//echo 'http://elibrary.wayne.edu' . $child->attr('href');
				//echo $child->text();
				$data['results'][] = $this->elibraryApiScraper('http://elibrary.wayne.edu' . $child->attr('href'), $syndeticsImage);
			}
			//print_r($data);
			//echo 'multiple';
		} else if ($qp->find('td.browseEntryData')->text()) {
			// MULTIPLE RESULTS
			// MULTIPLE RESULTS
			// MULTIPLE RESULTS
			// multiple print and electironic NO ACTUALLY JUST MULTIPLE RESULTS
			foreach ($qp->find('td.browseEntryData > a:nth-child(2)') as $child) {// 2 times
				//echo 'http://elibrary.wayne.edu' . $child->attr('href') . '<br>';
				//echo $child->text();

				$page2 = $this->requestUrl('http://elibrary.wayne.edu' . $child->attr('href'));
				$qp2 = htmlqp($page2['response'], 'body');

				//$data['results'][] = $this->elibraryApiScraper('http://elibrary.wayne.edu' . $child->attr('href'), $syndeticsImage);

				if ($qp2->find('.briefcitTitle')->text()) {
					foreach ($qp2->find('.briefcitTitle a') as $child2) {// 2 times
						$data['results'][] = $this->elibraryApiScraper('http://elibrary.wayne.edu' . $child2->attr('href'), $syndeticsImage);
					}
					//echo 'ooonnnee';
				} else {
					$data['results'][] = $this->elibraryApiScraper('http://elibrary.wayne.edu' . $child->attr('href'), $syndeticsImage);
					//echo 'tttwwwwooo';
				}

			}
			$data['resultsNumber'] = $qp->find('td.browseHeaderData')->text();
			preg_match("/of ([0-9]+)/i", $data['resultsNumber'], $match);
			$data['resultsNumber'] = $match[1];
			//print_r($data);
			//echo 'multiple';
		} else {
			// one match found - elibray auto redirect to page
			$data['results'][] = $this->elibraryApiScraper($data['url'], $syndeticsImage);
			//echo 'one';

		}


		// #bibDisplayContentMore
		////$this->url = $this->eLibraryUrlFrameset;
		// foreach ($qp->find('tr > td.bibInfoLabel') as $child) {
		// 	if ($child->text() == 'Author') {
		// 		$data['data']['Author'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Title') {
		// 		$data['title'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Edition') {
		// 		$data['data']['Edition'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Publication Info.') {
		// 		$data['data']['Publication Info'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Description') {
		// 		$data['data']['Description'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Series') {
		// 		$data['data']['Series'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Frequency') {
		// 		$data['data']['Frequency'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Publication Date') {
		// 		$data['data']['Publication Date'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Issued By') {
		// 		$data['data']['Issued By'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'Indexes') {
		// 		$data['data']['Indexes'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'ISBN') {
		// 		$data['data']['ISBN'] = $child->next()->text(); 
		// 	}
		// 	if ($child->text() == 'ISSN') {
		// 		$data['data']['ISSN'] = $child->next()->text(); 
		// 	}
		// }

		//print_r($data);

		//
		// $data['data']['Location'] = trim(trim( $qp->find('table.bibItems tr.bibItemsEntry td:nth-child(1)')->text(), "\xC2\xA0" ));
		// $data['data']['Call Number'] = trim(trim( $qp->find('table.bibItems tr.bibItemsEntry td:nth-child(2)')->text(), "\xC2\xA0" ));
		// $data['data']['Status'] = trim(trim( $qp->find('table.bibItems tr.bibItemsEntry td:nth-child(3)')->text(), "\xC2\xA0" ));

		// // making sure to always get an image and to always get the best image
		// // elibrary image is better than syndetics
		// if (!isset($syndeticsImage) && isset($data['data']['ISBN'])) {
		// 	$syndeticsImage = 'https://secure.syndetics.com/index.aspx?isbn=' .$data['data']['ISBN']. '/sc.gif&client=waynestmis&freeimage=true';
		// }
		// $elibraryImage = $qp->find('.bibResourceSidebar > a > img')->attr('src');
		// if (isset($elibraryImage)) {
		// 	list($elibraryImageWidth, $elibraryImageHeight) = getimagesize($elibraryImage);
		// }
		// if (isset($syndeticsImage)) {
		// 	list($syndeticsImageWidth, $syndeticsImageHeight) = getimagesize($syndeticsImage);
		// }
		// if (isset($elibraryImageWidth) && $elibraryImageWidth > 1) {
		// 	$data['image'] = $elibraryImage;
		// } else if (isset($syndeticsImageWidth) && $syndeticsImageWidth > 1) {
		// 	$data['image'] = $syndeticsImage;
		// } else {
		// 	//$data['image'] = 'blah ';
		// }

		return $data;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function elibraryApiScraper($url, $syndeticsImage) {

		$page = $this->requestUrl($url);
		$qp = htmlqp($page['response'], 'body');

		$data['url'] = $url;

		foreach ($qp->find('tr > td.bibInfoLabel') as $child) {
			if ($child->text() == 'Author') {
				$data['data']['Author'] = $child->next()->text();
			}
			if ($child->text() == 'Title') {
				$data['title'] = $child->next()->text();
				//echo $data['title'] . '3298479238142308437894';
			}
			if ($child->text() == 'Edition') {
				$data['data']['Edition'] = $child->next()->text(); 
			}
			if ($child->text() == 'Publication Info.') {
				$data['data']['Publication Info'] = $child->next()->text(); 
			}
			if ($child->text() == 'Description') {
				$data['data']['Description'] = $child->next()->text(); 
			}
			if ($child->text() == 'Series') {
				$data['data']['Series'] = $child->next()->text(); 
			}
			if ($child->text() == 'Frequency') {
				$data['data']['Frequency'] = $child->next()->text(); 
			}
			if ($child->text() == 'Publication Date') {
				$data['data']['Publication Date'] = $child->next()->text(); 
			}
			if ($child->text() == 'Issued By') {
				$data['data']['Issued By'] = $child->next()->text(); 
			}
			if ($child->text() == 'Indexes') {
				$data['data']['Indexes'] = $child->next()->text(); 
			}
			if ($child->text() == 'ISBN') {
				$data['data']['ISBN'] = $child->next()->text(); 
			}
			if ($child->text() == 'ISSN') {
				$data['data']['ISSN'] = $child->next()->text(); 
			}
		}

		//print_r($data);

		//
		$data['data']['Location'] = trim(trim( $qp->find('table.bibItems tr.bibItemsEntry td:nth-child(1)')->text(), "\xC2\xA0" ));
		$data['data']['Call Number'] = trim(trim( $qp->find('table.bibItems tr.bibItemsEntry td:nth-child(2)')->text(), "\xC2\xA0" ));
		$data['data']['Status'] = trim(trim( $qp->find('table.bibItems tr.bibItemsEntry td:nth-child(3)')->text(), "\xC2\xA0" ));

		if (
			stripos($data['title'], '[electronic resource]') !== false ||
			stripos($data['data']['Location'], 'electronic') !== false ||
			stripos($data['data']['Call Number'], 'electronic') !== false
			) {
			$data['data']['Media Type'] = 'Electronic';
			// echo 'electron';
		} else {
			$data['data']['Media Type'] = 'Print';
			// echo 'prnit';
		}

		// making sure to always get an image and to always get the best image
		// elibrary image is better than syndetics
		if (!isset($syndeticsImage) && isset($data['data']['ISBN'])) {
			$syndeticsImage = 'https://secure.syndetics.com/index.aspx?isbn=' .$data['data']['ISBN']. '/sc.gif&client=waynestmis&freeimage=true';
		}
		$elibraryImage = $qp->find('.bibResourceSidebar > a > img')->attr('src');
		if (isset($elibraryImage)) {
			list($elibraryImageWidth, $elibraryImageHeight) = getimagesize($elibraryImage);
		}
		if (isset($syndeticsImage)) {
			list($syndeticsImageWidth, $syndeticsImageHeight) = getimagesize($syndeticsImage);
		}
		if (isset($elibraryImageWidth) && $elibraryImageWidth > 1) {
			$data['image'] = $elibraryImage;
		} else if (isset($syndeticsImageWidth) && $syndeticsImageWidth > 1) {
			$data['image'] = $syndeticsImage;
		} else {
			//$data['image'] = 'blah ';
		}

		//print_r($data);

		return $data;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function summonApi($queryNormalizedWhitespace, $summonOptionsArray, $filters) {
		//print_r($summonOptionsArray);
		return new SummonAPI($queryNormalizedWhitespace, $summonOptionsArray, $filters);
		// if ($this->summonAPI->result['title'][0] == '') {
		// 	// $this->summonAPI = new SummonAPI($queryNormalizedWhitespace, array());
		// }
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function pubmedApi($db, $id) {
		if ($db == 'pmc') {
			$api = json_decode( file_get_contents('http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?db=pmc&retmode=json&rettype=abstract&id=' . $id), true);
			$apiResult = $api['result'][$id];
			return $this->pubmedApi('pubmed', $apiResult['articleids'][0]['value']);
		} else if ($db == 'pubmed') {
			$idWithoutPMID = str_replace('PMID', '', $id);
			$api = json_decode( file_get_contents('http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?db=pubmed&retmode=json&rettype=abstract&id=' . $idWithoutPMID), true);
			$apiResult = $api['result'][$idWithoutPMID];
			$data = array();

			$data['title'] = $apiResult['title'];
			$data['url'] = 'http://www.ncbi.nlm.nih.gov/pubmed/' . $apiResult['uid'];
			$data['image'] = 'https://secure.syndetics.com/index.aspx?issn=' .$apiResult['issn']. '/sc.gif&client=waynestmis&freeimage=true';
			foreach ($apiResult['authors'] as $author) {
				$authors []= $author['name'];
			}
			$data['data']['Authors'] = implode(', ', $authors);
			$data['data']['Type'] = implode(', ', $apiResult['pubtype']);
			$data['data']['Language'] = getLanguageFromISOLanguageCode( $apiResult['lang'][0] );
			$data['data']['Journal'] = $apiResult['fulljournalname'] .', Vol. '. $apiResult['volume'] .', No. '. $apiResult['issue'] .', pp. '. $apiResult['pages'];
			$data['data']['Journal ISSN'] = $apiResult['issn'];
			$data['data']['Journal NLM ID'] = $apiResult['nlmuniqueid'];
			$data['data']['DOI'] = str_replace('doi: ', '', $apiResult['elocationid']);





			// $this->url = 'http://www.ncbi.nlm.nih.gov/pubmed/' . $pubmedApiResult['uid'];
			// //$this->imageSyndetics = 'https://secure.syndetics.com/index.aspx?issn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
			// $this->image = 'https://secure.syndetics.com/index.aspx?issn=' .$pubmedApiResult['issn']. '/sc.gif&client=waynestmis&freeimage=true';
			// foreach ($pubmedApiResult['authors'] as $author) {
			// 	$authors []= $author['name'];
			// }
			// $this->data['Authors'] = implode(', ', $authors);
			// $this->data['Type'] = implode(', ', $pubmedApiResult['pubtype']);
			// $this->data['Language'] = getLanguageFromISOLanguageCode( $pubmedApiResult['lang'][0] );
			// $this->data['Journal'] = $pubmedApiResult['fulljournalname'] .', Vol. '. $pubmedApiResult['volume'] .', No. '. $pubmedApiResult['issue'] .', pp. '. $pubmedApiResult['pages'];
			// $this->data['Journal ISSN'] = $pubmedApiResult['issn'];
			// //$this->data['Journal ESSN'] = $pubmedApiResult['essn'];
			// $this->data['DOI'] = str_replace('doi: ', '', $pubmedApiResult['elocationid']);
			// $this->data['NLM ID'] = $pubmedApiResult['nlmuniqueid'];
			
			return $data;
		}
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function orcidApi($orcid) {
		$url = "http://orcid.org/" . $orcid;

		$page = $this->requestUrl($url);
		$qp = htmlqp($page['response'], 'body');

		// id ORCID actaully exists
		if ($qp->find('.col-md-offset-3.col-md-9.col-sm-12.col-xs-12 p')->text() == 'The page requested cannot be found. If you have this page bookmarked, please delete it. If you have followed a link, please report it.') {
			// no ORCID exists
			$data['title'] = null;
			return $data;
		}

		$data['url'] = $url;
		$data['title'] = $qp->find('.full-name')->text();
		$data['data']['ORCID'] = $orcid;
		$data['data']['Biography'] = $qp->find('.bio-content')->text();

		foreach ($qp->find('.workspace-section-title') as $child) {
			if ($child->text() == 'Country') {
				$data['data']['Country'] = $child->next()->text();
			}
			if ($child->text() == 'Websites') {
				$data['data']['Websites'] = '<a href="' . $child->next()->find('a')->attr('href') . '" style="word-break:break-all;">' . $child->next()->find('a')->text() . '</a>';
			}
			if ($child->text() == 'Other IDs') {
				foreach ($child->next()->find('a') as $child) {
					if (stripos($child->text(), 'ResearcherID:') !== false) {
						$data['data']['ResearcherID'] = str_replace('ResearcherID: ', '', $child->text());
					}
					if (stripos($child->text(), 'Scopus Author ID:') !== false) {
						$data['data']['Scopus Author ID'] = str_replace('Scopus Author ID: ', '', $child->text());
					}
				}
			}
		}

		return $data;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function replaceWithBold($terms, $target) {
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

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function validImage($elibraryImage, $syndeticsImage) {
		///$fgc = file_get_contents($src);
		//return $src;

		if (isset($elibraryImage)) {
			list($elibraryImageWidth, $elibraryImageHeight) = getimagesize($elibraryImage);
		}
		if (isset($syndeticsImage)) {
			list($syndeticsImageWidth, $syndeticsImageHeight) = getimagesize($syndeticsImage);
		}
		if (isset($elibraryImageWidth) && $elibraryImageWidth > 1) {
			//return $elibraryImage;
			return str_replace('http://elibrary.wayne.edu', 'https://elibrary.wayne.edu', $elibraryImage);
		} else if (isset($syndeticsImageWidth) && $syndeticsImageWidth > 1) {
			//return $syndeticsImage;
			return str_replace('http://www.syndetics', 'https://secure.syndetics', $syndeticsImage);
		} else {
			return null;
		}
	}

}







class CitationParser {

	public $isCitation = false;

	public $citationClean;
	public $title;
	public $authors;
	public $date;
	public $journal;
	// strip out volume, edition, page numbers

	/**
	 * Takes the connection parameters
	 *
	 * @param string $url Server URL
	 * @param mixed $request_jsonrpc_version JSON-RPC version (1 or 2) 
	 * @param boolean $debug
	 */
	public function __construct( $citation ) {
		$this->citationClean = $this->normalizeWhitespace( $citation );
		$this->parseCitation( $this->citationClean );
	}

	/**
	 * Sets the notification state of the object.
	 * In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function normalizeWhitespace($str) {
		return trim( preg_replace("/\s+/", " ", $str) );
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function parseCitation($query) {

		// convert microsoft word character crap to normal stuff
		function convert_smart_quotes($string) { 
		    $search = array(
				chr(145),
				chr(146),
				chr(147),
				chr(148),
				chr(151),
			);
		    $replace = array(
				"'",
				"'",
				'"',
				'"',
				'-',
			);
		    return str_replace($search, $replace, $string); 
		}
		$query = convert_smart_quotes($query);



		////////$authors1 = "([ A-Za-z]+).";
		// APA/Turabian/Chicago

		//$authors =  "([ -.,&A-Za-z]+).";
		$authors = "([ -,&A-Za-z]+|(?:(?:[ -,&A-Za-z]+(?:[A-Za-z]{1}.)[ -,&A-Za-z]+)*)).";
		$authors = "([ -,&A-Za-z]+|(?:(?:[ -,&A-Za-z]+(?:[A-Za-z]{1}.)[ -,&A-Za-z]+)*)).";
		$authors = "([ -,&A-Za-z]*(?:[A-Za-z]{1}.)*[ -,&A-Za-z]+)+.";// THINK THIS IS RIGHTTTTT!!! BUT IT Cuts offffff
		$authorsBeforeDate = "([ -.,&A-Za-z]+).";
		//$authors =  "([ -.,&A-Za-z]+).";
		//$authors2 = "([ -,&A-Za-z]+).";// without period in it
		$date = "( [0-9]{4}| \([0-9]{4}\)| [(]*[0-9]{4}[)]*).";
		$date2 = "( [0-9]{4}| \([0-9]{4}\)| [(]*[0-9]{4}[)]*):";
		$title = "[ ]*(?:[\"]{1})([ \(\)\";:\-,'&A-Za-z]+[0-9]{0,3}[ \";:\-,'&A-Za-z]+)[.?\"]{1,2}";// for mla
		//$title2 = "([ \";:\-,'&A-Za-z]+[0-9]{0,3}[ \";:\-,'&A-Za-z]+)[.?\"]*";
		$title2 =   "([ \";:\-,'&A-Za-z]+[0-9]{0,3}[ \";:\-,'&A-Za-z]+)[.?\"]{1,2}";
		$title3 =   "([ \(\)\";:\-,'&A-Za-z]+[0-9]{0,3}[ \";:\-,'&A-Za-z]+)[.?\"]{1,2}";/// for apa
		$title4 =   "([ \-\(\)\"'?;:,.&A-Za-z0-9]+)[.?\"]{1,2}";
		$title5 =   "([ \-\(\)\"'?;:,&A-Za-z0-9]+)[.?\"]{1,2}";
		//$titleEnd = "([ \";:\-,'&A-Za-z]+)[.?\"]{0,2}";
		$titleEnd = "([ \-\(\)\"'?;:,&A-Za-z0-9]+)[.?\"]{0,2}";
		//$title2 = "([ \";:\-,'&A-Za-z]+)[.?]*";
		$journal =  "( [ \-'.;:,&A-Za-z]+)[,.:]{0,2}";
		/////////$journal2 = "([ ';:,&A-Za-z]+)[,.:]{1,2}";
		$journal2 = "( [ \-';:,&A-Za-z]+)[,.:]{0,1}";
		// these are loose journal versions!!!!!!!!
		$journal =  "([ \(\)\-'.;:,&A-Za-z]+)[,.:]{0,2}";
		$journal2 = "([ \(\)\-';:,&A-Za-z]+)[,.:]{0,1}";
		// , 45 (3), 203-212
		// , 3, 80-86.
		// : 50-56. Web. 23 Mar. 2015.
		// . Web. 4 March 2013.
		// , 2206-2214
		// ;125:2854–62
		// , 2002:280–3.
		// , 2002:280–3.
		// , Vol. 169, No. 4 , April 1990
		// , March 2013, 20(3), 14.
		// , March 2013, 20(3), 14.
		// , (1996), pp. 48-71.
		// ,34(2), 138-157.
		// 37(2): 82–88.
		// , 29, 289-293.
		// , 72(2), 157-177.
		$issue = "[s0-9]+";
		$volume =  "([ ]*[0-9]+|[ ]*[0-9]+[ ]*.[0-9]+|[ ]*[0-9]+[, ]*\(".$issue."\)|[ ]*vol.[ ]*[0-9]+[, ]*no.[ ]*[0-9]+)[.,:]*";
		//$volume2 = "([ ]*[0-9]+|[ ]*[0-9]+[ ]*.[0-9]+)[.,:]*";
		$volume2 = $volume;
		$pages = "([ ]*pp.[ ]*[0-9]+-[0-9]+|[ ]*[0-9]+-[0-9]+|[ ]*[0-9]+)[.]*";
		$doi = "( doi:(?:10[.][0-9]{4,}(?:[.][0-9]+)*\/(?:(?![%\"#? ])\\S)+))[.]{0,1}";
		$printorweb = "( Print| Web)[.]{1,2}";
		$fulldate = "( [0-9]{2} (?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)[.]* [0-9]{4})[.]{1}";
		$fulldate2 = "( [0-9]{2} (?:Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)[.]* [0-9]{4})[.]*";
		$anything = "([ \(\)\-';:,&A-Za-z]+)[,.:]{0,1}";
		$anything = "(.*)";
		

		$citationFormats = array(
			
			//////////////////////////////
			array(
				array( 'authors',           'date', 'title',  'anything'),
				"/^" . $authorsBeforeDate . $date . $title5 . $anything . "$/",
			),

			



			// APA and Chicago and Turabian
			array(
				array( 'authors',           'date', 'title',  'journal', 'volume', 'pages', 'doi'),
				"/^" . $authorsBeforeDate . $date . $title4 . $journal . $volume . $pages . $doi . "$/",
			),
			array(
				array( 'authors',           'date', 'title', 'journal', 'volume', 'pages'),
				"/^" . $authorsBeforeDate . $date . $title4 . $journal . $volume . $pages . "$/",
			),
			array(
				array( 'authors',           'date', 'title',  'journal', 'volume'),
				"/^" . $authorsBeforeDate . $date . $title4 . $journal . $volume . "$/",
			),
			array(
				array( 'authors',           'date', 'title',  'journal'),
				"/^" . $authorsBeforeDate . $date . $title4 . $journal2 . "$/",
			),
			// array(
			// 	array( 'authors',           'date', 'journal', 'volume', 'pages'),
			// 	"/^" . $authorsBeforeDate . $date . $journal . $volume . $pages . "$/",
			// ),





			// I THINK I WAS SUPPOSD TO DO THIS TO MAKE THIS WORK: A conversation with bob raymond, detroit tigers. (2008). Crain's Detroit Business, 24(11), 11
			// array(
			// 	array( 'authors',           'date', 'journal', 'volume'),
			// 	"/^" . $authorsBeforeDate . $date . $journal . $volume2 . "$/",
			// ),
			// array(
			// 	array( 'authors',           'date', 'title'),
			// 	"/^" . $authorsBeforeDate . $date . $titleEnd . "$/",
			// ),




			// array(
			// 	array( 'title', 'date', 'journal', 'volume', 'pages'),
			// 	"/^" . $title . $date . $journal . $volume . $pages . "$/",
			// ),
			// array(
			// 	array( 'title', 'date', 'journal'),
			// 	"/^" . $title . $date . $journal . "$/",
			// ),
			// MLA and AMA

			//////////////////////////////
			array(
				array( 'authors',           'title', 'journal',  'anything'),
				"/^" . $authorsBeforeDate . $title . $journal2 . $anything . "$/",
			),

			array(
				array( 'authors', 'title', 'journal',  'volume',  'date',  'pages', 'printorweb', 'fulldate'),
				"/^" . $authors . $title . $journal2 . $volume2 . $date2 . $pages . $printorweb . $fulldate2 . "$/",
			),
			array(
				array( 'authors', 'title', 'journal',  'volume',  'date',  'pages', 'printorweb'),
				"/^" . $authors . $title . $journal2 . $volume2 . $date2 . $pages . $printorweb . "$/",
			),
			array(
				array( 'authors', 'title', 'journal',  'volume',  'date',  'pages'),
				"/^" . $authors . $title . $journal2 . $volume2 . $date2 . $pages . "$/",
			),
			array(
				array( 'authors', 'title', 'journal' ),
				"/^" . $authors . $title . $journal2 . "$/",
			),
			array(
				array( 'authors', 'title', 'journal' ),
				"/^" . $authors . $title3 . $journal2 . "$/",
			),
			// AMA
			array(
				array( 'authors', 'title',  'journal',  'date', 'volume', 'pages' ),
				"/^" . $authors . $title2 . $journal2 . $date . $volume . $pages . "$/",
			),
			// TITLE DATE JOURNAL

			//////////////////////////////
			array(
				array( 'title',  'date', 'journal',  'anything'),
				"/^" . $title4 . $date . $journal2 . $anything . "$/",
			),

			array(
				array( 'title',  'date', 'journal',  'volume', 'pages'),
				"/^" . $title4 . $date . $journal2 . $volume2 . $pages . "$/",
			),
			array(
				array( 'title',  'date', 'journal'),
				"/^" . $title4 . $date . $journal2 . "$/",
			),
		);


		foreach ($citationFormats as $key => $citationFormat) {
			$labels = $citationFormat[0];
			$regex = $citationFormat[1];
			if ( preg_match($regex, $query, $match) ) {
				//echo 'EEEEEE' . $key;
				$this->isCitation = true;
				//$this->style = 'APA/Turabian/Chicago';
				foreach ($labels as $i => $label) {
					if ($label == 'date') {
						$this->$label = $this->normalizeWhitespace( $this->parseDate( $match[$i+1] ) );
					} else {
						$this->$label = $this->normalizeWhitespace( $match[$i+1] );
					}
					//
					$this->match = $match;
				}
				break;
			}
		}

		// IF IT GOES TITLE / AUTHOR / JORUNAL
		if (!preg_match("( [A-Za-z]{1}[.]{1})", $this->authors, $match)) {
			$oldAuthors = $this->authors;
			$oldTitle = $this->title;
			$this->title = $oldAuthors;
			$this->authors = '';
			$this->journal = $oldTitle;
		}





		// // MLA/AMA
		// $mlaAuthors = "([ ,A-Za-z]+).";
		// $mlaDate = "( [0-9]{4})";
		// $mlaTitle = "([ ,A-Za-z]+).";
		// $mlaJournal = "([ .:,A-Za-z]+).";
		// $fullCitationMLA = "/^" . $mlaAuthors . $mlaTitle . $mlaJournal . $mlaDate . "$/";

		////$mlaTEST = "([ .:,A-Za-z0-9]+)";
		////$fullCitationMLA = "/^" . $mlaTEST . "$/";
		// general or broken or poorly styled citation

		// $authors = "([ A-Za-z]+).";
		// $date = "( [0-9]{4})";
		// $title = "([ A-Za-z]+).";
		// $journal = "([ A-Za-z]+).";
		// $fullCitation = "/^" . $authors . $title . $journal . $date . "$/i";

		//echo $fullCitation;







		// $citationAuthorsDateTitleJournalVolumePages = "/^" . $authors . $date . $title . $journal . $volume . $pages . "$/";
		// $citationAuthorsDateTitleVolumePages = "/^" . $authors . $date . $title . $volume . $pages . "$/";
		// $citationAuthorsDateTitleJournal = "/^" . $authors . $date . $title . $journal2 . "$/";
		// $citationAuthorsDateTitle = "/^" . $authors . $date . $title2 . "$/";
		// if ( preg_match($citationAuthorsDateTitleJournalVolumePages, $query, $match) ) {
		// 	// APA/Turabian/Chicago
		// 	//print_r($match);
		// 	$this->isCitation = true;
		// 	$this->style = 'APA/Turabian/Chicago';
		// 	$this->authors = $match[1];
		// 	$this->date = $this->parseDate($match[2]);
		// 	$this->title = $match[3];
		// 	$this->journal = $match[4];
		// 	$this->match = $match;
		// }
		// elseif ( preg_match($citationAuthorsDateTitleVolumePages, $query, $match) ) {
		// 	// APA/Turabian/Chicago
		// 	//print_r($match);
		// 	$this->isCitation = true;
		// 	$this->style = 'APA/Turabian/Chicago';
		// 	$this->authors = $match[1];
		// 	$this->date = $this->parseDate($match[2]);
		// 	$this->title = $match[3];
		// 	$this->volume = $match[4];
		// 	$this->pages = $match[5];
		// 	$this->match = $match;
		// }
		// elseif ( preg_match($citationAuthorsDateTitleJournal, $query, $match) ) {
		// 	// APA/Turabian/Chicago
		// 	//print_r($match);
		// 	$this->isCitation = true;
		// 	$this->style = 'APA/Turabian/Chicago';
		// 	$this->authors = $match[1];
		// 	$this->date = $this->parseDate($match[2]);
		// 	$this->title = $match[3];
		// 	$this->journal = $match[4];
		// 	$this->match = $match;
		// }
		// elseif ( preg_match($citationAuthorsDateTitle, $query, $match) ) {
		// 	// APA/Turabian/Chicago
		// 	//print_r($match);
		// 	$this->isCitation = true;
		// 	$this->style = 'APA/Turabian/Chicago';
		// 	$this->authors = $match[1];
		// 	$this->date = $this->parseDate($match[2]);
		// 	$this->title = $match[3];
		// 	$this->journal = $match[4];
		// 	$this->match = $match;
		// }
		// elseif ( preg_match($fullCitationMLA, $query, $match) ) {
		// 	// MLA/AMA
		// 	$this->isCitation = true;
		// 	$this->style = 'MLA/AMA';
		// 	$this->authors = $match[1];
		// 	$this->title = $match[2];
		// 	$this->journal = $match[3];
		// 	$this->date = $match[4];
		// 	$this->match = $match;
		// }
		// else {
		// 	// didnt match either
		// 	$this->style = 'unknown citation style';
		// }
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function parseDate($str) {
		$str = $this->normalizeWhitespace($str);
		preg_match("/^[(]*([0-9]{4})[)]*$/i", $str, $match);
		return $match[1];
	}

}







class SummonAPI {

	// public $query;
	// public $queryNormalizedWhitespace;
	// public $queryCharacterCount;
	// public $queryWordCount;
	// public $queryType;// citaton, known item, 
	// //public $isCitation;
	// public $citationParser;
	// public $wordTagger;
	// public $spellChecker;
	// public $nGram;
	// strip out volume, edition, page numbers
	
	//public $querySummonOptions;
	public $resultsCount;
	public $results;

	/**
	 * Takes the connection parameters
	 *
	 * @param string $url Server URL
	 * @param mixed $request_jsonrpc_version JSON-RPC version (1 or 2) 
	 * @param boolean $debug
	 */
	public function __construct($queryNormalizedWhitespace, $querySummonOptions, $filters) {
		//$this->query = $query;

		require_once '../php/summon/CURL.php';
		//require_once '../api/QueryParser.php';

		$summon = new SerialsSolutions_Summon_CURL('wayne', 'F83344m8ifV91jjnYifVLr0BQyA4v2y8');

		// $queryParser = new QueryParser( $terms );
		// $querySummonOptions = array(
		// 	//'query' => $queryParser->queryNormalizedWhitespace,
		// 	'title' => $queryParser->citationTitle,
		// 	'dateIs' => $queryParser->citationDate,
		// );

		// Setup Query
		$query = new SerialsSolutions_Summon_Query($queryNormalizedWhitespace, $querySummonOptions, $filters);

		// Execute Query
		$query = $summon->query($query);
		$this->resultsCount = count($query['documents']);
		$this->results = $query;
		$this->result = $query['documents'][0];
	}

}













class SpellChecker {

	public $query;
	public $summonAPI;
	public $didyoumean;
	//public $isCorrection;
	public $correction;

	/**
	 * Takes the connection parameters
	 *
	 * @param string $url Server URL
	 * @param mixed $request_jsonrpc_version JSON-RPC version (1 or 2) 
	 * @param boolean $debug
	 */
	public function __construct( $query ) {
		$this->query = $query;
		$this->summonAPI = new SummonAPI($query, array(), null);
		$this->didyoumean = $this->summonAPI->results['didYouMeanSuggestions'][0]['suggestedQuery'];
		
		if ($this->didyoumean) {
			$words1 = explode(' ', preg_replace("/[^A-Za-z0-9 ]/", '', $this->normalizeWhitespace($query)));
			$words2 = explode(' ', preg_replace("/[^A-Za-z0-9 ]/", '', $this->normalizeWhitespace($this->didyoumean)));
			foreach ($words2 as $i => $word) {
				if ($words1[$i] != $word) {
					$words2[$i] = '<b>' . $words2[$i] . '</b>';
				}
			}
		}
		
		$this->correction = implode($words2, ' ');
	}

	/**
	 * Sets the notification state of the object.
	 * In this state, notifications are performed, instead of requests.
	 *
	 * @param boolean $notification
	 */
	public function normalizeWhitespace($str) {
		return trim( preg_replace("/\s+/", " ", $str) );
	}




}











// echo 'Silverstein, Alvin, Virginia B Silverstein, and Laura Silverstein Nunn. The grizzly bear. Brookfield, CN: Millbrook Press. 1998';
// echo '<br>';
// echo 'Hamaker C. 2005. Open URL The challenge of success. The Charleston Advisor';
// $q = new QueryParser( $_GET['q'] );
// echo '<pre>';
// print_r( $q );
// echo '</pre>';






?><?php require_once("$wsuroot/page-end.php"); ?><?php require_once("$wsuroot/footer.php") ?>