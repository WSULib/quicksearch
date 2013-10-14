<?php
include('app/app.php');
include('rest/EBSCOAPI.php');

$userid = $_REQUEST['userId'];
$password = $_REQUEST['password'];
$flag = FALSE;
$db = isset($_REQUEST['db'])?$_REQUEST['db']:"";
$an = isset($_REQUEST['an'])?$_REQUEST['an']:"";
$query = isset($_REQUEST['query'])?$_REQUEST['query']:"";
$fieldCode = isset($_REQUEST['fieldcode'])?$_REQUEST['fieldcode']:"";
$highlight=isset($_REQUEST['highlight'])?$_REQUEST['highlight']:"";
$resultId = isset($_REQUEST['resultId'])?$_REQUEST['resultId']:"";
$recordCount = isset($_REQUEST['recordCount'])?$_REQUEST['recordCount']:"";
$f =isset($_REQUEST['f'])?$_REQUEST['f']:"";
$bn = isset($_REQUEST['bn'])?$_REQUEST['bn']:"";

$xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);      
      $clientCredentials = $dom ->getElementsByTagName('ClientCredentials')->item(0);
      $users = $clientCredentials ->getElementsByTagName('User');
      foreach($users as $user){
       $UserId = $user -> getElementsByTagName('UserId')->item(0)->nodeValue;
       $Password = $user -> getElementsByTagName('Password') -> item(0) -> nodeValue;       
       
       if($userid == $UserId && $password == $Password){          
           $flag = $UserId;
           break;       
       }
      }
   
      
     if($flag==FALSE){
         
         $path = $_REQUEST['path'];
    
    if($path=="record"){
    $params = array(
        'path'=>'record',
        'db'=>$db,
        'an'=>$an,
        'query'=>$query,
        'fieldcode'=>$fieldCode,
        'highlight'=>$highlight,
        'resultId'=>$resultId,
        'recordCount'=>$recordCount,
        'f'=>$f,
        'fail'=>'y',
        'bn'=>$bn
    );
    $params = http_build_query($params);
    header("location: login.php?$params");
    }
    
    else if($path=="PDF"){
    $db = $_REQUEST['db'];
    $an = $_REQUEST['an'];
    header("location: login.php?path=PDF&an=$an&db=$db&fail=y");
    }
    
    else if($path=="HTML"){
    $params = array(
        'path'=>'HTML',
        'db'=>$db,
        'an'=>$an,
        'query'=>$query,
        'fieldcode'=>$fieldCode,
        'highlight'=>$highlight,
        'resultId'=>$resultId,
        'recordCount'=>$recordCount,
        'f'=>$f,
        'fail'=>'y',
        'bn'=>$bn
    );
    $params = http_build_query($params);
    header("location: login.php?$params");
    }
    
    else if($_REQUEST['path']=="results"){
   
   $params = array(
       'path'=>'results',
       'query'=>$query,
       'fieldcode'=>$fieldCode,
       'expander'=>$_REQUEST['expander'],
       'fail'=>'y'
   );
   $params = http_build_query($params);
   header("location: login.php?$params");
   }
   else if($_REQUEST['path']=="box"){
       $params = array(
       'path'=>'box',
       'query'=>$query,
       'fieldcode'=>$fieldCode,
       'expander'=>$_REQUEST['expander'],
       'fail'=>'y'
   );
   $params = http_build_query($params);
   header("location: login.php?$params");
   }
   else{
       header("location: login.php?path=index&fail=y");
   }
 
     }else{
       $EDSCredentials = $dom ->getElementsByTagName('EDSCredentials')->item(0);
            $users = $EDSCredentials -> getElementsByTagName('User');
            
            foreach($users as $user){
               $userType = $user->getElementsByTagName('ClientUser')->item(0)->nodeValue;
                if($userType == $UserId){                              
                $profile = $user -> getElementsByTagName('EDSProfile')->item(0)->nodeValue;
                break;
                }
            }
                
        $api = new EBSCOAPI();
        $newSessionToken = $api->apiSessionToken($api->getAuthToken(), $profile,'n');          
        $_SESSION['sessionToken']=$newSessionToken;      
        
        setcookie('login',$profile,0);       
       
       if(isset($_COOKIE['Guest'])){
           setcookie('Guest','',time()-3600); 
       }
       
       $path = $_REQUEST['path'];
    
    if($path=="record"){

    $params = array(
        'db'=>$db,
        'an'=>$an,
        'query'=>$query,
        'fieldcode'=>$fieldCode,
        'highlight'=>$highlight,
        'resultId'=>$resultId,
        'recordCount'=>$recordCount,
        'f'=>$f,
        'bn'=>$bn
    );
    $params = http_build_query($params);
    header("location: $path.php?$params");
    }
    
    else if($path=="PDF"){
    $db = $_REQUEST['db'];
    $an = $_REQUEST['an'];
    header("location: $path.php?db=$db&an=$an");
    }
    
    else if($path=="HTML"){
    
    $params = array(
        'db'=>$db,
        'an'=>$an,
        'query'=>$query,
        'fieldcode'=>$fieldCode,
        'highlight'=>$highlight,
        'resultId'=>$resultId,
        'recordCount'=>$recordCount,
        'f'=>$f,
        'bn'=>$bn
    );
    $params = http_build_query($params);

    header("location: record.php?$params#html");
    }
    
    else if($_REQUEST['path']=="results"){

      $params = array(
          'login'=>'y',
          'query'=>$query,
          'fieldcode'=>$fieldCode,
          'expander'=>$_REQUEST['expander']
      );
      $params = http_build_query($params);
   header("location: $path.php?$params");
   }
   else if($_REQUEST['path']=="box"){
       
       $params = array(
          'query'=>$query,
          'fieldcode'=>$fieldCode,
          'expander'=>$_REQUEST['expander']
      );
      $params = http_build_query($params);       
       header("location: pre-results.php?$params");
   }
   else{
       header("location: index.php");
   }
       
   }
  
?>
