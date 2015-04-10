<?php

if(($_REQUEST['link'])!=null)
{
	$myurl=$_REQUEST['link'];
}
else
{
	$myurl= $_REQUEST['url'];
	foreach ($_GET as $key=>$value)
        {
		if ($key=="url" || $key=="linkText"|| $key=="searchTerm" || $key=="category")
		{	
			
		}
		else
		{
			$myurl=$myurl."&".$key."=".$value;
		}
        }
}
$myurl=urldecode($myurl);
$myurl=urldecode($myurl);
$myurl=str_replace("http:/","http://",$myurl);
$myurl=str_replace("https:/","https://",$myurl);
header("Location: $myurl");
exit();
?>
