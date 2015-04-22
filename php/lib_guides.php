<?php
$search_string = $_GET['search_string'];
echo '<div id="libGuideWidget">';
echo '<div id="api_search_guides_iid692">';
echo file_get_contents("http://lgapi.libapps.com/widgets.php?site_id=176&widget_type=1&search_terms=".$search_string."&search_match=2&search_type=0&sort_by=relevance&list_format=1&drop_text=Select+a+Guide...&output_format=1&load_type=2&enable_description=1&enable_group_search_limit=0&enable_subject_search_limit=0&widget_embed_type=2&num_results=3&enable_more_results=1&window_target=2&config_id=1422564343616");
echo "</div>";
echo "</div>";
?>
