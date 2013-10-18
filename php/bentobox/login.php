<?php 
include('app/app.php');
include('rest/EBSCOAPI.php');

$fail = isset($_REQUEST['fail'])?$_REQUEST['fail']:'';
$expander = isset($_REQUEST['expander'])?$_REQUEST['expander']:'';
$query = isset($_REQUEST['query'])?$_REQUEST['query']:'';
$fieldCode = isset($_REQUEST['fieldcode'])?$_REQUEST['fieldcode']:'';
$path = $_REQUEST['path'];
if($path=="record" || $path=="HTML"){
    
$varables = array(
    'path' => $path,
    'db' => $_REQUEST['db'],
    'an' => $_REQUEST['an'],
    'query'=> $query,
    'fieldCode' => $fieldCode,
    'highlight'=> $_REQUEST['highlight'],
    'resultId' => $_REQUEST['resultId'],
    'recordCount' => $_REQUEST['recordCount'],
    'f' => $_REQUEST['f'],
    'bn'=> $_REQUEST['bn']
);
}
else if($path=="PDF"){
$db = $_REQUEST['db'];
$an = $_REQUEST['an'];

$varables = array(
    'path' => $path,
    'db' => $db,
    'an' => $an
);
}
else if($path=="results"||$path=='box'){
   
   $varables = array(
       'path' => $path,
       'query' => $query,
       'fieldCode'=>$fieldCode
   );
}
else {
    $varables = array(
        'path' => 'index'
    );
}

$varables['expander']=$expander;
$varables['fail'] = $fail;
render('login.html', 'layout.html',$varables);
?>
