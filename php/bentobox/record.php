<?php

include('app/app.php');
include('rest/EBSCOAPI.php');

$xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);
      $version = $dom->getElementsByTagName('Version')->item(0)->nodeValue;

$api = new EBSCOAPI();

$db = $_REQUEST['db'];
$an = $_REQUEST['an'];
$highlight = $_REQUEST['highlight'];
$highlight = str_replace(array(" ","&","-"), array("","",""), $highlight);
$result = $api->apiRetrieve($an, $db, $highlight);

$debug = isset($_REQUEST['debug'])? $_REQUEST['debug']:'';
$name = isset($_REQUEST['bn'])?$_REQUEST['bn']:'';

// Set error
if (isset($result['error'])) {
    $error = $result['error'];
} else {
    $error = null;
}

//save debug into session
if($debug == 'y'||$debug == 'n'){
    $_SESSION['debug'] = $debug;
}

// Variables used in view
$variables = array(
    'result' => $result,
    'error'  => $error,
    'version' => $version,
    'debug'  => isset($_SESSION['debug'])? $_SESSION['debug']:'',
    'bn'    => $name
);

render('record.html', 'blank.html', $variables);

?>