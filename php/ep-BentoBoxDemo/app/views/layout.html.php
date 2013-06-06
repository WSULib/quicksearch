<!DOCTYPE html>
<?php 
$xml ="Config.xml";
$dom = new DOMDocument();
$dom->load($xml);
$_SESSION['version'] = $dom->getElementsByTagName('Version')->item(0)->nodeValue;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bento Boxes</title>
        <link rel="stylesheet" href="web/styles.css" type="text/css" media="screen" />
        <link rel="shortcut icon" href="web/favicon.ico" />
        <script type="text/javascript" src="jquery.js" ></script>       
    </head>

    <body name="body" onclick="hide()">
        <div class="container">
        <div class="header">
            <a id="logo" href="basic_search.php"></a>
        </div>

        <div class="content">
            <?php echo $content; ?>
        </div>

        <div class="footer">        
           </div>
        </div>
    </body>
</html>