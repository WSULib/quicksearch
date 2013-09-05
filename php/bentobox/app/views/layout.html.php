<!DOCTYPE html>
<?php 
$xml ="Config.xml";
$dom = new DOMDocument();
$dom->load($xml);
$version = $dom->getElementsByTagName('Version')->item(0)->nodeValue;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>BentoBox Demo</title>
        <link rel="stylesheet" href="web/styles.css" type="text/css" media="screen" />
        <link rel="shortcut icon" href="web/favicon.ico" />
        <script type="text/javascript" src="jquery.js" ></script>       
    </head>

    <body name="body" onclick="hide()">
        <div class="container">
        <div class="header">
            <div><a id="logo" href="index.php"></a></div>
            <?php if(!(isset($_COOKIE['login'])||isset($login))){ ?>
            <div class="guestbox">
                <div>
                    Hello, Guest.              
                    <a href="login.php?path=index">Login</a>              
                    for full access.
                </div>
            </div>
             <?php } ?>
            <?php if(isset($_COOKIE['login'])||isset($login)){ ?>                     
                    <div class="login"><a href="logout.php">Logout</a></div>                             
               <?php } else { ?>                   
                    <div class="login"><a href="login.php?path=index">Login</a></div>                                   
               <?php } ?>
        </div>    
        <div class="content">
            <?php echo $content; ?>
        </div>

        <div class="footer">        
            <div class="span-5">
               <table cellspacing="20px">               
              <tr>
              <td>
              <strong>Need Help?</strong>         
              </td>
              <td>
              <a href="#">Search Tips</a>
              </td>
              <td>
              <a href="#">Ask a Librarian</a>
              </td>
              <td>
              <a href="#">FAQs</a>
              </td>      
              </tr>
                </table>
           </div>
            <div class="version"><?php echo $version ?></div>
        </div>
        </div>
    </body>
</html>