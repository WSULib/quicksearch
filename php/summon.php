<?php
require_once 'summon/CURL.php';

$terms = $_REQUEST['q'];

// For some reason trying to pass the $filters variable to the SerialSolutions class 
// does not work I added the array to the Query.php file. - Elliot
// $filters = array('s.fvf' => 'ContentType,Newspaper Article,true');
// Create Summon Connector
$summon = new SerialsSolutions_Summon_CURL('wayne', 'F83344m8ifV91jjnYifVLr0BQyA4v2y8');

// Setup Query
$query = new SerialsSolutions_Summon_Query($terms);

// Execute Query
$result = $summon->query($query);

json_encode($result);

// This is the Wikipedia Style API section, need to break this out to a new section
//echo $result['topicRecommendations'][0]['title'] . '</br>' . $result['topicRecommendations'][0]['snippet'] . '</br></br>';
//echo '</br>';

if (empty($result['documents'])) { ?>
  <p>No articles results were found.  Please try another search in <a href="http://wayne.summon.serialssolutions.com">Summon</a></p>
<?php
}

if (count($result['documents']) >= 3) {
        $n = 3;
    } else {
        $n = count($result['documents']);
    }
//echo $n;


for ($z = 0; $z < $n; $z++) {
 // print_r($result['documents'][$z]); 
  if (!empty($result['documents'][$z]['Title'])) {
  	?> <a href = "<?php echo $result['documents'][$z]['link']?>"><?php echo $result['documents'][$z]['Title'][0]; ?></a></br>
   	<?php }
  if (!empty($result['documents'][$z]['Author'])) {
   	echo 'Author: ' . $result['documents'][$z]['Author'][0] . '</br>';
   	}
  if (!empty($result['documents'][$z]['PublicationDate_xml'][0])) {
    echo 'Date: ';
      if (!empty($result['documents'][$z]['PublicationDate_xml'][0]['month'])) { 
      echo $result['documents'][$z]['PublicationDate_xml'][0]['month'] . '/';
      }
      if (!empty($result['documents'][$z]['PublicationDate_xml'][0]['day'])) {
      echo $result['documents'][$z]['PublicationDate_xml'][0]['day'] . '/';  
      }  
      if (!empty($result['documents'][$z]['PublicationDate_xml'][0]['year'])) {
      echo $result['documents'][$z]['PublicationDate_xml'][0]['year'] . '</br>';  
      }
  }
  if (!empty($result['documents'][$z]['PublicationTitle'])) {
    echo 'Journal: ' . $result['documents'][$z]['PublicationTitle'][0] . '</br>';   
  }
  if (!empty($result['documents'][$z]['Volume'])) {
    echo 'Volume: ' . $result['documents'][$z]['Volume'][0];
  } 
  if (!empty($result['documents'][$z]['Issue'])) {
    echo ' Issue: ' . $result['documents'][$z]['Issue'][0] . '</br>';
  } else {
    echo '</br>';
  }
  echo '</br>';
}

echo '<a href="http://wayne.summon.serialssolutions.com/#!/search?ho=t&fvf=ContentType,Journal Article,f|ContentType,Magazine Article,f&q=' . $terms . '"> View more results...(' . $result['recordCount'] . ')</a>'; 
  

//print_r($result);

//print_r($query);

?>