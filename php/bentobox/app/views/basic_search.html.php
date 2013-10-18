<?php
$api =  new EBSCOAPI();
$Info = $api->getInfo();
?>
<div id="toptabcontent"> 
<div class="searchHomeContent">
    <center><h1>Bento Box Demo</h1></center>
<div class="searchHomeForm">  
    <div class="searchform">
<h1>Basic Search</h1>

<?php //Load Config.xml file
      $xml ="Config.xml";
      $dom = new DOMDocument();
      $dom->load($xml);
      $expander = $dom->getElementsByTagName('Expander')->Item(0)->nodeValue;
?>
<form action="pre-results.php">
    <p>
        <input type="text" name="query" style="width: 350px;" id="lookfor" />  
        <input type="hidden" name="expander" value="<?php echo $expander ?>" />       
        <input type="submit" value="Search" />
    </p>
    <table>
        <tr>
            <td>
                <input type="radio" id="type-keyword" name="fieldcode" value="keyword" checked="checked"/>
                <label for="type-keyword">Keyword</label>
            </td>
            <?php if(!empty($Info['search'])){ ?>
      <?php foreach($Info['search'] as $searchField){
          if($searchField['Label']=='Author'){
              $fieldCode = $searchField['Code']; ?>
      
            <td>
                <input type="radio" id="type-author" name="fieldcode" value="<?php echo $fieldCode; ?>" />
                <label for="type-author">Author</label>
            </td>
      <?php   
          }
          if($searchField['Label']=='Title'){
              $fieldCode = $searchField['Code']; ?>
            <td>
                <input type="radio" id="type-title" name="fieldcode" value="<?php echo $fieldCode; ?>" />
                <label for="type-title">Title</label>                             
            </td>          
      <?php
          }
      } ?>
      <?php } ?>   
        </tr>
    </table>
</form>
</div>
</div>
</div>
</div>
