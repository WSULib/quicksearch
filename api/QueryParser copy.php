<?php $wsuroot = realpath($_SERVER["DOCUMENT_ROOT"]); $headerType = "plain"; $pageTitle=""; $pageBreadCrumbsGoByURL = "resources/quicksearch/api/QueryParser copy.php"; $pageSidebarSectionsGoByURL = "resources/quicksearch/api/QueryParser copy.php"; require_once("$wsuroot/header.php") ?><?php require_once("$wsuroot/page-begin.php"); ?><?php




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
		//
		$this->query = $query;
		$this->queryNormalizedWhitespace = $this->normalizeWhitespace($query);
		$this->queryKeywords = $this->getKeywords($query);
		$this->queryCharacterCount = $this->queryCharacterCount($query);
		//
		if ( $this->isIdentifier( $this->queryNormalizedWhitespace ) ) {
			// its an Identifier such as ISBN, ISSN, DOI, OCLC... etc...
			$this->bestResult['image'] = $this->identifierParser->image;
			$this->bestResult['title'] = $this->identifierParser->title;
			$this->bestResult['url'] = $this->identifierParser->url;
			// $this->bestResult['data'] = array(
			// 	'Authors' => $this->identifierParser->authors,
			// 	'Publisher' => $this->identifierParser->publication,
			// );
			$this->bestResult['data'] = $this->identifierParser->data;
			////$identifierData = array('Authors', 'Publisher');


			if (isset($this->identifierParser->DOI)) {
				$this->summonApi( $this->queryNormalizedWhitespace, (array) $this->citationParser );
				if (isset($this->summonAPI->result['Title'])) {
					$this->bestResult['image'] = $this->validImage( $this->summonAPI->result['thumbnail_m'][0] );
					$this->bestResult['title'] = $this->replaceWithBold($this->queryKeywords, $this->summonAPI->result['Title'][0]);
					$this->bestResult['url'] = $this->summonAPI->result['link'];
					$this->bestResult['data'] = array(
						'Authors' => implode(', ', $this->summonAPI->result['Author']),
						'Date' => date("n/j/Y", strtotime($this->summonAPI->result['PublicationDate'][0])),
						'Publication' => $this->summonAPI->result['PublicationTitle'][0],
						'Publisher' => $this->summonAPI->result['Publisher'][0],
						'Type' => $this->summonAPI->result['ContentType'][0],
						'Discipline' => $this->summonAPI->result['Discipline'][0],
					);
					$this->checkSpelling( $this->queryNormalizedWhitespace );
					return;
				}
			}


			return;
		} else if ( $this->isCitation( $this->queryNormalizedWhitespace ) ) {
			// its a Citation
			$this->summonApi( $this->queryNormalizedWhitespace, (array) $this->citationParser );
			if (isset($this->summonAPI->result['Title'])) {
				$this->bestResult['image'] = $this->validImage( $this->summonAPI->result['thumbnail_m'][0] );
				$this->bestResult['title'] = $this->replaceWithBold($this->queryKeywords, $this->summonAPI->result['Title'][0]);
				$this->bestResult['url'] = $this->summonAPI->result['link'];
				$this->bestResult['data'] = array(
					'Authors' => implode(', ', $this->summonAPI->result['Author']),
					'Date' => date("n/j/Y", strtotime($this->summonAPI->result['PublicationDate'][0])),
					'Publication' => $this->summonAPI->result['PublicationTitle'][0],
					'Publisher' => $this->summonAPI->result['Publisher'][0],
					'Type' => $this->summonAPI->result['ContentType'][0],
					'Discipline' => $this->summonAPI->result['Discipline'][0],
				);
				$this->checkSpelling( $this->queryNormalizedWhitespace );
				return;
			}
		} else {
			// something else...
			$this->checkSpelling( $this->queryNormalizedWhitespace );
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
		return array_unique( explode(" ", preg_replace("/[^A-Za-z0-9 ]/", "", $this->queryNormalizedWhitespace) ) );// we only want to replace each term once
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
		// 	$this->itemImage = 'http://www.syndetics.com/index.aspx?isbn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
		// 	$this->itemElibraryUrl = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/marc&FF=i" .$match[1] . "&1%2C1%2C";
		// } else if (preg_match("/^(978[0-9]{10})$/i", $query, $match)) {
		// 	$this->ISBN13 = $match[1];
		// 	$this->itemImage = 'http://www.syndetics.com/index.aspx?isbn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
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
	public function checkSpelling($query) {
		$this->spellChecker = new SpellChecker($query);
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function summonApi($queryNormalizedWhitespace, $summonOptionsArray) {
		//print_r($summonOptionsArray);
		$this->summonAPI = new SummonAPI($queryNormalizedWhitespace, $summonOptionsArray);
		if ($this->summonAPI->result['title'][0] == '') {
			// $this->summonAPI = new SummonAPI($queryNormalizedWhitespace, array());
		}
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
	public function validImage($src) {
		///$fgc = file_get_contents($src);
		return $src;
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

		$results = array();
 		
		if (preg_match("/^([0-9]{7}|ocm[0-9]{8}|ocn[0-9]{9}|on[0-9]{10,})$/i", $query, $match)) {
			// OCLC
			$this->isIdentifier = true;
			$this->OCLC = $match[1];
			// this oclc is wrong
			//$this->image = 'http://coverart.oclc.org/ImageWebSvc/oclc/+-+' .preg_replace("/[a-zA-z]+/", "", $match[1]). '_70.jpg?SearchOrder=+-+OT,OS,TN,AV,GO,FA';
			//
			//$this->eLibraryUrlFrameset = "http://elibrary.wayne.edu/search~S47/?searchtype=o&searcharg=" .$match[1]. "&searchscope=47&SORT=D&extended=1&SUBMIT=Search&searchlimits=&searchorigarg=o05812780";
			$this->imageSyndeticsSOMETIMESisBLANK_IMAGE = 'http://coverart.oclc.org/ImageWebSvc/oclc/+-+' .preg_replace("/[a-zA-z]+/", "", $match[1]). '_70.jpg?SearchOrder=+-+OT,OS,TN,AV,GO,FA';
			if ($match[1][0] == '0') {
				$shortenedOcn = substr(preg_replace("/[a-zA-z]+/", "", $match[1]), 1);
			} else {
				$shortenedOcn = preg_replace("/[a-zA-z]+/", "", $match[1]);
			}
			$this->eLibraryUrlFrameset = "http://elibrary.wayne.edu/search~S47?/o" .$match[1]. "/o" .$match[1]. "/-3%2C0%2C0%2CE/frameset&FF=o" .$shortenedOcn. "&1%2C1%2C/indexsort=-";
		} else if (preg_match("/^([0-9]{8}|[0-9]{4}\-[0-9]{4})$/i", $query, $match)) {
			// ISSN
			$this->isIdentifier = true;
			
			$this->ISSN = $match[1];
			//http://coverart.oclc.org/ImageWebSvc/oclc/+-+05812780_70.jpg?SearchOrder=+-+OT,OS,TN,AV,GO,FA
			////$this->image = 'http://www.syndetics.com/index.aspx?issn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
			$this->eLibraryUrlMarc = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/marc&FF=i" .$match[1] . "&1%2C1%2C";
			$this->eLibraryUrlFrameset = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/frameset&FF=i" .$match[1] . "&1%2C1%2C";
			$this->imageSyndetics = 'http://www.syndetics.com/index.aspx?issn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
		} else if (preg_match("/^([0-9]{10}|(978[0-9]{10}|978-[0-9]{10}))$/i", $query, $match)) {
			// ISBN
			$this->isIdentifier = true;
			$this->ISBN = $match[1];
			$this->eLibraryUrlMarc = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/marc&FF=i" .$match[1] . "&1%2C1%2C";
			$this->eLibraryUrlFrameset = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/frameset&FF=i" .$match[1] . "&1%2C1%2C";
			$this->imageSyndetics = 'http://www.syndetics.com/index.aspx?isbn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';

			$this->isIdentifier = true;
			$this->ISBN = $match[1];
			$api = $this->elibraryApi('ISBN', $match[1]);
			$this->title = $api['title'];
			$this->url = $api['url'];
			$this->image = $api['image'];
			$this->data = $api['data'];
		}
		// else if (preg_match("/^(978[0-9]{10}|978-[0-9]{10})$/i", $query, $match)) {
		// 	// ISBN13
		// 	$this->isIdentifier = true;
		// 	$this->ISBN13 = $match[1];
		// 	$this->imageSyndetics = 'http://www.syndetics.com/index.aspx?isbn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
		// 	$this->eLibraryUrlMarc = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/marc&FF=i" .$match[1] . "&1%2C1%2C";
		// 	$this->eLibraryUrlFrameset = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/frameset&FF=i" .$match[1] . "&1%2C1%2C";
		// } 
		else if (preg_match("/^(([0-9]{3}|[0-9]{3}.[0-9]+)[ a-zA-Z0-9]*)$/i", $query, $match)) {
			// Dewey
			$this->isIdentifier = true;
			$this->Dewey = $match[1];
			$this->imageSyndetics = 'http://www.syndetics.com/index.aspx?isbn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
			$this->eLibraryUrlMarc = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/marc&FF=i" .$match[1] . "&1%2C1%2C";
			//$this->eLibraryUrlFrameset = "http://elibrary.wayne.edu/search~S47?/i" .$match[1]. "/i" .$match[1]. "/1%2C2%2C2%2CE/frameset&FF=i" .$match[1] . "&1%2C1%2C";
			$this->eLibraryUrlFrameset = "http://elibrary.wayne.edu/search~S47?/e" .$match[1]. "/e" .$match[1]. "/-3%2C-1%2C0%2CB/frameset&FF=e" .$match[1]. "&1%2C1%2C";
		} else if (preg_match("/^(10[.][0-9]{4,}(?:[.][0-9]+)*\/(?:(?![%\"#? ])\\S)+)$/i", $query, $match)) {
			// DOI
			$this->isIdentifier = true;
			$this->DOI = $match[1];
			$this->title = 'http://dx.doi.org/' . $match[1];
			$this->url = 'http://dx.doi.org/' . $match[1];
			//$this->summonApi( $query, array() );

			// http://dx.doi.org/10.3389/conf.fphar.2010.60.00158 
		}
		// else if (preg_match("~^(10[.][0-9]{4,}(?:[.][0-9]+)*/(?:(?![\"&\'<>])\S)+)$~", $query, $match)) {
		// 	$this->isIdentifier = true;
		// 	$this->DOI2 = $match[1];
		// 	//(10[.][0-9]{4,}(?:[.][0-9]+)*/(?:(?!["&\'<>])\S)+)
		// }
		else if (preg_match("/^PMID[ ]*([0-9]{8})$/i", $query, $match)) {
			//  PMID
			// //
			// // get pubmed api json
			// $pubmedApi = json_decode( file_get_contents('http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?db=pubmed&retmode=json&rettype=abstract&id=' . $match[1]), true);
			// $pubmedApiResult = $pubmedApi['result'][$match[1]];
			// $this->isIdentifier = true;
			// //print_r($pubmedApi);
			// $this->title = $pubmedApiResult['title'];
			// $this->url = 'http://www.ncbi.nlm.nih.gov/pubmed/' . $pubmedApiResult['uid'];
			// //$this->imageSyndetics = 'http://www.syndetics.com/index.aspx?issn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
			// $this->image = 'http://www.syndetics.com/index.aspx?issn=' .$pubmedApiResult['issn']. '/sc.gif&client=waynestmis&freeimage=true';
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
			$this->isIdentifier = true;
			$api = $this->pubmedApi('pubmed', $match[1]);
			$this->title = $api['title'];
			$this->url = $api['url'];
			$this->image = $api['image'];
			$this->data['Authors'] = $api['Authors'];
			$this->data['Type'] = $api['Type'];
			$this->data['Language'] = $api['Language'];
			$this->data['Journal'] = $api['Journal'];
			$this->data['Journal ISSN'] = $api['Journal ISSN'];
			$this->data['DOI'] = $api['DOI'];
			$this->data['NLM ID'] = $api['NLM ID'];
		} else if (preg_match("/^PMC([0-9]{7})$/i", $query, $match)) {
			// PMCID
			$this->isIdentifier = true;
			$api = $this->pubmedApi('pmc', $match[1]);
			$this->title = $api['title'];
			$this->url = $api['url'];
			$this->image = $api['image'];
			$this->data['Authors'] = $api['Authors'];
			$this->data['Type'] = $api['Type'];
			$this->data['Language'] = $api['Language'];
			$this->data['Journal'] = $api['Journal'];
			$this->data['Journal ISSN'] = $api['Journal ISSN'];
			$this->data['DOI'] = $api['DOI'];
			$this->data['NLM ID'] = $api['NLM ID'];
		}


		

		// $page = requestUrl($this->itemElibraryUrl);
		// $qp = htmlqp($page['response'], 'body');

		// foreach ($qp->find('#main > div > pre') as $child) {
		// 	$marc = $child->html();
		// }

		// // require_once('File_MARC-1.1.1/MARC.php');
		// // require_once('File_MARC-1.1.1/MARCXML.php');

		// // // Retrieve a set of MARCXML records from a string
		// // $journals = new File_MARCXML($marc, File_MARC::SOURCE_STRING);
		// // echo '<pre>';
		// // print_r($journals);
		// // echo '</pre>';

		// // // Iterate through the retrieved records
		// // while ($record = $journals->next()) {
		// //     // Pretty print each record
		// //     print $record;
		// //     print "\n";
		// // }





		// if (isset($this->eLibraryUrlFrameset)) {
		// 	$page = requestUrl($this->eLibraryUrlFrameset);
		// 	$qp = htmlqp($page['response'], 'body');

		// 	// foreach ($qp->find('.bibInfoData') as $child) {
		// 	// 	$data[] = $child->text();
		// 	// }

		// 	// $this->title = $data[1];
		// 	// $this->url = $this->eLibraryUrlFrameset;
		// 	// $this->authors = $this->normalizeWhitespace($data[0]);
		// 	// $this->publication = $this->normalizeWhitespace($data[2]);

			


		// 	// .bibDisplayContentMain
		// 	// #bibDisplayContentMore




		// 	$this->url = $this->eLibraryUrlFrameset;
		// 	foreach ($qp->find('tr > td.bibInfoLabel') as $child) {
		// 		if ($child->text() == 'Author') {
		// 			$this->data['Author'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Title') {
		// 			$this->title = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Edition') {
		// 			$this->data['Edition'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Publication Info.') {
		// 			$this->data['Publication Info'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Description') {
		// 			$this->data['Description'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Series') {
		// 			$this->data['Series'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Frequency') {
		// 			$this->data['Frequency'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Publication Date') {
		// 			$this->data['Publication Date'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Issued By') {
		// 			$this->data['Issued By'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'Indexes') {
		// 			$this->data['Indexes'] = $child->next()->text(); 
		// 		}
		// 		if ($child->text() == 'ISBN') {
		// 			$this->data['ISBN'] = $child->next()->text(); 
		// 		}
		// 	}

		// 	// for things like oclc, I need to get the image directly from the elibrary page
		// 	$this->imageELibrary = $qp->find('.bibResourceSidebar > a > img')->attr('src');
		// 	list($imageELibraryWidth, $imageELibraryHeight) = getimagesize($this->imageELibrary);
		// 	list($imageSyndeticsWidth, $imageSyndeticsHeight) = getimagesize($this->imageSyndetics);
		// 	if ($imageELibraryWidth > 1) {
		// 		$this->image = $this->imageELibrary;
		// 	} else if ($imageSyndeticsWidth > 1) {
		// 		$this->image = $this->imageSyndetics;
		// 	}


		// 	// else get alternate isbn imageSyndetics url
		// }


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
	public function elibraryApi($callNumType, $callNum) {

		require_once('querypath-master/src/qp.php');

		function requestUrl($url) {
			// Must set $url first. Duh...
			$curl = curl_init();
			// Make curl_exec return the data instead of outputting it.
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			// The URL to be downloaded is set
			curl_setopt($curl, CURLOPT_URL, $url);
			// Return the HTTP headers
			//curl_setopt($curl, CURLOPT_HEADER, true);
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

		if ($callNumType == 'ISBN') {
			$data['url'] = "http://elibrary.wayne.edu/search~S47?/i" .$callNum. "/i" .$callNum. "/1%2C2%2C2%2CE/frameset&FF=i" .$callNum. "&1%2C1%2C";
			$syndeticsImage = 'http://www.syndetics.com/index.aspx?isbn=' .$callNum. '/sc.gif&client=waynestmis&freeimage=true';
		} else if ($callNumType == 'ISSN') {
			$callNum = str_replace('-', '', $callNum);
			$data['url'] = "http://elibrary.wayne.edu/search~S47?/i" .$callNum. "/i" .$callNum. "/1%2C2%2C2%2CE/frameset&FF=i" .$callNum. "&1%2C1%2C";
			$syndeticsImage = 'http://www.syndetics.com/index.aspx?issn=' .$callNum. '/sc.gif&client=waynestmis&freeimage=true';
		} else if ($callNumType == 'OCLC') {
			if ($callNum[0] == '0') {
				$shortenedOcn = substr(preg_replace("/[a-zA-z]+/", "", $callNum), 1);
			} else {
				$shortenedOcn = preg_replace("/[a-zA-z]+/", "", $callNum);
			}
			$data['url'] = "http://elibrary.wayne.edu/search~S47?/o" .$callNum. "/o" .$callNum. "/-3%2C0%2C0%2CE/frameset&FF=o" .$shortenedOcn. "&1%2C1%2C/indexsort=-";
		} else if ($callNumType == 'Dewey') {
			$data['url'] = "http://elibrary.wayne.edu/search~S47?/e" .$callNum. "/e" .$callNum. "/-3%2C-1%2C0%2CB/frameset&FF=e" .$callNum. "&1%2C1%2C";
		}

		$page = requestUrl($data['url']);
		$qp = htmlqp($page['response'], 'body');

		// #bibDisplayContentMore
		////$this->url = $this->eLibraryUrlFrameset;
		foreach ($qp->find('tr > td.bibInfoLabel') as $child) {
			if ($child->text() == 'Author') {
				$data['data']['Author'] = $child->next()->text(); 
			}
			if ($child->text() == 'Title') {
				$data['title'] = $child->next()->text(); 
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
		}

		// making sure to always get an image and to always get the best image
		// elibrary image is better than syndetics
		if (!isset($syndeticsImage) && isset($data['data']['ISBN'])) {
			$syndeticsImage = 'http://www.syndetics.com/index.aspx?isbn=' .$data['data']['ISBN']. '/sc.gif&client=waynestmis&freeimage=true';
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
			//$data['image'] = 'blah';
		}

		return $data;
	}

	/**
	 * description...
	 *
	 * @param string $query
	 */
	public function summonApi($queryNormalizedWhitespace, $summonOptionsArray) {
		//print_r($summonOptionsArray);
		$this->summonAPI = new SummonAPI($queryNormalizedWhitespace, $summonOptionsArray);
		if ($this->summonAPI->result['title'][0] == '') {
			// $this->summonAPI = new SummonAPI($queryNormalizedWhitespace, array());
		}
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
			$api = json_decode( file_get_contents('http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esummary.fcgi?db=pubmed&retmode=json&rettype=abstract&id=' . $id), true);
			$apiResult = $api['result'][$id];
			$data = array();

			$data['title'] = $apiResult['title'];
			$data['url'] = 'http://www.ncbi.nlm.nih.gov/pubmed/' . $apiResult['uid'];
			$data['image'] = 'http://www.syndetics.com/index.aspx?issn=' .$apiResult['issn']. '/sc.gif&client=waynestmis&freeimage=true';
			foreach ($apiResult['authors'] as $author) {
				$authors []= $author['name'];
			}
			$data['Authors'] = implode(', ', $authors);
			$data['Type'] = implode(', ', $apiResult['pubtype']);
			$data['Language'] = getLanguageFromISOLanguageCode( $apiResult['lang'][0] );
			$data['Journal'] = $apiResult['fulljournalname'] .', Vol. '. $apiResult['volume'] .', No. '. $apiResult['issue'] .', pp. '. $apiResult['pages'];
			$data['Journal ISSN'] = $apiResult['issn'];
			$data['DOI'] = str_replace('doi: ', '', $apiResult['elocationid']);
			$data['NLM ID'] = $apiResult['nlmuniqueid'];





			// $this->url = 'http://www.ncbi.nlm.nih.gov/pubmed/' . $pubmedApiResult['uid'];
			// //$this->imageSyndetics = 'http://www.syndetics.com/index.aspx?issn=' .$match[1]. '/sc.gif&client=waynestmis&freeimage=true';
			// $this->image = 'http://www.syndetics.com/index.aspx?issn=' .$pubmedApiResult['issn']. '/sc.gif&client=waynestmis&freeimage=true';
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

		$authors = "([ -.,&A-Za-z]+).";
		$date = "( [0-9]{4}| \([0-9]{4}\)| [(]*[0-9]{4}[)]*).";
		$title = "([ \(\)\";:\-,'&A-Za-z]+[0-9]{0,3}[ \";:\-,'&A-Za-z]+)[.?]{1,2}";
		$title2 = "([ \";:\-,'&A-Za-z]+[0-9]{0,3}[ \";:\-,'&A-Za-z]+)[.?]*";
		//$title2 = "([ \";:\-,'&A-Za-z]+)[.?]*";
		$journal = "([ '.;:,&A-Za-z]+)[,.:]{1,2}";
		$journal2 = "([ '.;:,&A-Za-z]+)";
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
		$volume = "([ ]*[0-9]+|[ ]*[0-9]+[ ]*\([0-9]+\))[.,:]*";
		$pages = "( pp. [0-9]+-[0-9]+| [0-9]+-[0-9]+| [0-9]+)[.]*";

		

		$citationFormats = array(
			array(
				array( 'authors', 'date', 'title', 'journal', 'volume', 'pages'),
				"/^" . $authors . $date . $title . $journal . $volume . $pages . "$/",
			),
			array(
				array( 'authors', 'date', 'journal', 'volume', 'pages'),
				"/^" . $authors . $date . $journal . $volume . $pages . "$/",
			),
			array(
				array( 'authors', 'date', 'journal', 'volume'),
				"/^" . $authors . $date . $journal . $volume . "$/",
			),
			array(
				array( 'authors', 'date', 'title', 'journal'),
				"/^" . $authors . $date . $title . $journal2 . "$/",
			),
			array(
				array( 'authors', 'date', 'title'),
				"/^" . $authors . $date . $title2 . "$/",
			),
		);


		foreach ($citationFormats as $citationFormat) {
			$labels = $citationFormat[0];
			$regex = $citationFormat[1];
			if ( preg_match($regex, $query, $match) ) {
				$this->isCitation = true;
				$this->style = 'APA/Turabian/Chicago';
				foreach ($labels as $i => $label) {
					if ($label == 'date') {
						$this->$label = $this->parseDate( $match[$i+1] );
					} else {
						$this->$label = $match[$i+1];
					}
					//
					$this->match = $match;
				}
				break;
			}
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
	public function __construct($queryNormalizedWhitespace, $querySummonOptions) {
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
		$query = new SerialsSolutions_Summon_Query($queryNormalizedWhitespace, $querySummonOptions);

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
		$this->summonAPI = new SummonAPI($query, array());
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