<?php
session_start();
require_once 'rest/EBSCOAPI.php';
        
        $an = $_REQUEST['an'];
        $db = $_REQUEST['db'];  
              
        $api = new EBSCOAPI();
        $record = $api->apiRetrieve($an, $db, 'y');        
        
        if(empty($record['pdflink'])){
            header("location: login.php?path=PDF&an=$an&db=$db");
        }else{
            header("location: {$record['pdflink']}");   
        }   
?>
