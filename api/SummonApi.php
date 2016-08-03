<?php



class SummonApi {

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
	public $querySummonOptions;
	public $result;

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
		//$this->result = $summon->query($query);
		$this->result = $summon->query($query);
	}

}









?>