<?php

/**
 * EBSCO Response class
 *
 * PHP version 5
 *
 */


/**
 * EBSCOResponse class
 */
class EBSCOResponse
{

    /**
     * A SimpleXml object
     * @global object
     */
    private $response;


    /**
     * Constructor
     *
     * Setup the EBSCO Response
     *
     * @param none
     *
     * @access public
     */
    public function __construct($response)
    {
        $this->response = $response;
    }


    /**
     * A proxy method which decides which subsequent method should be     * called, based on the SimpleXml object structure
     *
     * @param none
     *
     * @return array      An associative array of data or the SimpleXml object itself in case of API error messages
     * @access public
     */
    public function result()
    {
        // If there is an ErrorNumber tag then return the object itself.
        // Should not happen, this method is called after parsing the SimpleXml for API errors
        if(!empty($this->response->ErrorNumber)) {
            return $this->response;
        } else {
            if (!empty($this->response->AuthToken)) {
                return $this->buildAuthenticationToken();
            } else if (!empty($this->response->SessionToken)) {
                return (string) $this->response->SessionToken;
            } else if (!empty($this->response->SearchResult)) {
                return $this->buildSearch();
            } else if(!empty($this->response->Record)) {
                return $this->buildRetrieve();
            } else if(!empty($this->response->AvailableSearchCriteria)) {
                return $this->buildInfo();
            }
        }
    }


    /**
     * Parse the SimpleXml object when an AuthenticationToken API call was executed
     *
     * @param none
     *
     * @return array   An associative array of data
     * @access private
     */
     private function buildAuthenticationToken()
     {
        $token = (string) $this->response->AuthToken;
        $timeout = (integer) $this->response->AuthTimeout;

        $result = array(
            'authenticationToken'   => $token,
            'authenticationTimeout' => $timeout
        );

        return $result;
     }


    /**
     * Parse the SimpleXml object when a Search API call was executed
     *
     * @param none
     *
     * @return array   An associative array of data
     * @access private
     */
    private function buildSearch()
    {
        $hits = (integer) $this->response->SearchResult->Statistics->TotalHits;

        $records = array();
        $facets = array();
        if ($hits > 0) {
            $records = $this->buildRecords();
            $facets = $this->buildFacets();
        }

        $results = array(
            'recordCount' => $hits,
            'records'     => $records,
            'facets'      => $facets
        );

        return $results;
    }


    /**
     * Parse the SimpleXml object when a Search API call was executed
     * and find all records
     *
     * @param none
     *
     * @return array    An associative array of data
     * @access private
     */
    private function buildRecords()
    {
        $results = array();

        $records = $this->response->SearchResult->Data->Records->Record;
        foreach ($records as $record) {
            $result = array();

            $result['ResultId'] = $record->ResultId ? (integer) $record->ResultId : '';
            $result['DbId'] = $record->Header->DbId ? (string) $record->Header->DbId : '';
            $result['DbLabel'] = $record->Header->DbLabel ? (string) $record->Header->DbLabel:'';
            $result['PubType'] = $record->Header->PubType ? (string) $record->Header->PubType:'';
            $result['An'] = $record->Header->An ? (string) $record->Header->An : '';
            $result['PLink'] = $record->PLink ? (string) $record->PLink : '';
            $result['PDF'] = $record->FullText->Links->Link->Type ? (string) $record->FullText->Links->Link->Type : '';
            $result['HTML'] = $record->FullText->Text->Availability? (string) $record->FullText->Text->Availability : '';
            if (!empty($record->ImageInfo->CoverArt)) {
                foreach ($record->ImageInfo->CoverArt as $image) {
                    $size = (string) $image->Size;
                    $target = (string) $image->Target;
                    $result['ImageInfo'][$size] = $target;
                }
            } else {
                $result['ImageInfo'] = '';
            }

            $result['FullText'] = $record->FullText ? (string) $record->FullText : '';

            if ($record->CustomLinks) {
                $result['CustomLinks'] = array();
                foreach ($record->CustomLinks->CustomLink as $customLink) {
                    $category = $customLink->Category ? (string) $customLink->Category : '';
                    $icon = $customLink->Icon ? (string) $customLink->Icon : '';
                    $mouseOverText = $customLink->MouseOverText ? (string) $customLink->MouseOverText : '';
                    $name = $customLink->Name ? (string) $customLink->Name : '';
                    $text = $customLink->Text ? (string) $customLink->Text : '';
                    $url = $customLink->Url ? (string) $customLink->Url : '';
                    $result['CustomLinks'][] = array(
                        'Category'      => $category,
                        'Icon'          => $icon,
                        'MouseOverText' => $mouseOverText,
                        'Name'          => $name,
                        'Text'          => $text,
                        'Url'           => $url
                    );
                }
             }

            if($record->Items) {
                $result['Items'] = array();
                foreach ($record->Items->Item as $item) {
                    $name = $item->Name ? (string) $item->Name : '';
                    $label = $item->Label ? (string) $item->Label : '';
                    $group = $item->Group ? (string) $item->Group : '';
                    $data = $item->Data ? (string) $item->Data : '';
                    $result['Items'][$label] = array(
                        'Name'  => $name,
                        'Label' => $label,
                        'Group' => $group,
                        'Data'  => $this->toHTML($data, $group)
                    );
                }
            }

            $results[] = $result;
        }

        return $results;
    }


     /**
     * Parse the SimpleXml object when a Search API call was executed
     * and find all facets
     *
     * @param none
     *
     * @return array    An associative array of data
     * @access private
     */
    private function buildFacets()
    {
        $results = array();

        $facets = $this->response->SearchResult->AvailableFacets->AvailableFacet;
        foreach ($facets as $facet) {
            $values = array();
            foreach ($facet->AvailableFacetValues->AvailableFacetValue as $value) {
                $replaced = urlencode($value->AddAction);
                $value->AddAction = $replaced;    
                $values[] = array(
                   'Value'  => (string) $value->Value,
                   'Action' => (string) $value->AddAction,
                   'Count'  => (string) $value->Count
               );
            }
            $id = (string) $facet->Id;
            $label = (string) $facet->Label;
            $results[] = array(
                'Id'     => $id,
                'Label'  => $label,
                'Values' => $values
            );
        }

        return $results;
    }


    /**
     * Parse the SimpleXml object when an Info API call was executed
     *
     * @param none
     *
     * @return array      An associative array of data
     * @access private
     */
    private function buildInfo()
    {
        // Sort options
        $elements = $this->response->AvailableSearchCriteria->AvailableSorts->AvailableSort;
        $sort = array();
        foreach ($elements as $element) {
            $sort[] = array(
                'Id'     => (string) $element->Id,
                'Label'  => (string) $element->Label,
                'Action' => (string) $element->AddAction
            );
        }

        // Search fields
        $elements = $this->response->AvailableSearchCriteria->AvailableSearchFields->AvailableSearchField;
        $search = array();
        foreach ($elements as $element) {
            $search[] = array(
                'Label' => (string) $element->Label,
                'Code'  => (string) $element->FieldCode
            );
        }

        // Expanders
        $elements = $this->response->AvailableSearchCriteria->AvailableExpanders->AvailableExpander;
        $expanders = array();
        foreach ($elements as $element) {
            $expanders[] = array(
                'Id'     => (string) $element->Id,
                'Label'  => (string) $element->Label,
                'Action' => (string) $element->AddAction
            );
        }

        // Limiters
        $elements = $this->response->AvailableSearchCriteria->AvailableLimiters->AvailableLimiter;
        $limiters = array();
        foreach ($elements as $element) {
            if ($element->LimiterValues) {
                $items = $element->LimiterValues->LimiterValue;
                $values = array();
                foreach($items as $item) {
                    $values[] = array(
                        'Value'  => (string) $item->Value,
                        'Action' => (string) $item->AddAction
                    );
                }
            }
            $limiters[] = array(
                'Id'     => (string) $element->Id,
                'Label'  => (string) $element->Label,
                'Action' => (string) $element->AddAction,
                'Type'   => (string) $element->Type,
                'values' => $values
            );
        }

        $result = array(
            'sort'      => $sort,
            'search'    => $search,
            'expanders' => $expanders,
            'limiters'  => $limiters
        );

        return $result;
    }


    /**
     * Parse a SimpleXml object when a Retrieve API call was executed
     *
     * @param none
     *
     * @return array      An associative array of data
     * @access private
     */
    private function buildRetrieve()
    {
        $record = $this->response->Record;

        if ($record) {
            $record = $record[0]; // there is only one record
        }

        $result = array();
        $result['DbId'] = $record->Header->DbId ? (string) $record->Header->DbId : '';
        $result['DbLabel'] = $record->Header->DbLabel ? (string) $record->Header->DbLabel:'';
        $result['An'] = $record->Header->An ? (string) $record->Header->An : '';
        $result['PubType'] = $record->Header->PubType ? (string) $record->Header->PubType:'';
        $result['PLink'] = $record->PLink ? (string) $record->PLink : ''; 
        $result['pdflink'] = $record->FullText->Links->Link->Url ? (string) $record->FullText->Links->Link->Url : '';
        $value = $record->FullText->Text->Value ? (string) $record->FullText->Text->Value : '';
        $result['htmllink'] = $this->toHTML($value,$group = '');
        if (!empty($record->ImageInfo->CoverArt)) {
            foreach ($record->ImageInfo->CoverArt as $image) {
                $size = (string) $image->Size;
                $target = (string) $image->Target;
                $result['ImageInfo'][$size] = $target;
            }
        } else {
            $result['ImageInfo'] = '';
        }
        $result['FullText'] = $record->FullText ? (string) $record->FullText : '';

        if ($record->CustomLinks) {
            $result['CustomLinks'] = array();
            foreach ($record->CustomLinks->CustomLink as $customLink) {
                $category = $customLink->Category ? (string) $customLink->Category : '';
                $icon = $customLink->Icon ? (string) $customLink->Icon : '';
                $mouseOverText = $customLink->MouseOverText ? (string) $customLink->MouseOverText : '';
                $name = $customLink->Name ? (string) $customLink->Name : '';
                $text = $customLink->Text ? (string) $customLink->Text : '';
                $url = $customLink->Url ? (string) $customLink->Url : '';
                $result['CustomLinks'][] = array(
                    'Category'      => $category,
                    'Icon'          => $icon,
                    'MouseOverText' => $mouseOverText,
                    'Name'          => $name,
                    'Text'          => $text,
                    'Url'           => $url
                );
            }
        }

        if($record->Items) {
            $result['Items'] = array();
            foreach ($record->Items->Item as $item) {
                $name = $item->Name ? (string) $item->Name : '';
                $label = $item->Label ? (string) $item->Label : '';
                $group = $item->Group ? (string) $item->Group : '';
                $data = $item->Data ? (string) $item->Data : '';
                $result['Items'][$label] = array(
                    'Name'  => $name,
                    'Label' => $label,
                    'Group' => $group,
                    'Data'  => $this->toHTML($data, $group)
                );
            }
        }

        return $result;
    }


    /**
     * Parse the "inner XML" of a SimpleXml element and 
     * return it as an HTML string
     *
     * @param SimpleXml $element  A SimpleXml DOM
     *
     * @return string            The HTML string
     * @access protected
     */
    private function toHTML($data, $group = '')
    {
        global $path;
        // Any group can be added here, but we only use Au (Author) 
        // Other groups, not present here, won't be transformed to HTML links
        $allowed_searchlink_groups = array('Au');
        $allowed_link_groups = array('URL');
        // Map xml tags to the HTML tags
        // This is just a small list, the total number of xml tags is far more greater
        $xml_to_html_tags = array(
            '<jsection'    => '<section',
            '</jsection'   => '</section',
            '<highlight'   => '<span class="highlight"',
            '<highligh'    => '<span class="highlight"', // Temporary bug fix
            '</highlight>' => '</span>', // Temporary bug fix
            '</highligh'   => '</span>',
            '<text'        => '<div',
            '</text'       => '</div',
            '<title'       => '<h2',
            '</title'      => '</h2',
            '<anid'        => '<p',
            '</anid'       => '</p',
            '<aug'         => '<strong',
            '</aug'        => '</strong',
            '<hd'          => '<h3',
            '</hd'         => '</h3',
            '<linebr'      => '<br',
            '</linebr'     => '',
            '<olist'       => '<ol',
            '</olist'      => '</ol',
            '<reflink'     => '<a',
            '</reflink'    => '</a',
            '<blist'       => '<p class="blist"',
            '</blist'      => '</p',
            '<bibl'        => '<a',
            '</bibl'       => '</a',
            '<bibtext'     => '<span',
            '</bibtext'    => '</span',
            '<ref'         => '<div class="ref"',
            '</ref'        => '</div',
            '<ulink'       => '<a',
            '</ulink'      => '</a',
            '<superscript' => '<sup',
            '</superscript'=> '</sup',
            '<i>'	   => '',
            '<br />'	   => ' ',
            '<relatesTo>1</relatesTo>'   => '',
	//    '<relatesTo'   => '<sup',  //EP killing these guys off for the purpose of the boxes and adding <i>
        //    '</relatesTo'  => '</sup',
            // A very basic security implementation, using a  blackist instead of a whitelist as needed.
            // But the total number of xml tags is so large that we won't build a whitelist right now
            '<script'      => '',
            '</script'     => ''
        );

        // Map xml types to Search types used by the UI
        $xml_to_search_types = array(
            'Au' => 'Author',
            'Su' => 'Subject'
        );

        //  The XML data is XML escaped, let's unescape html entities (e.g. &lt; => <)
        $data = html_entity_decode($data);

        // Start parsing the xml data
        if (!empty($data)) {
            // Replace the XML tags with HTML tags
            $search = array_keys($xml_to_html_tags);
            $replace = array_values($xml_to_html_tags);
            $data = str_replace($search, $replace, $data);

            // Temporary : fix unclosed tags
            $data = preg_replace('/<\/highlight/', '</span>', $data);
            $data = preg_replace('/<\/span>>/', '</span>', $data);
            $data = preg_replace('/<\/searchLink/', '</searchLink>', $data);
            $data = preg_replace('/<\/searchLink>>/', '</searchLink>', $data);

            // Parse searchLinks
            if (!empty($group) && in_array($group, $allowed_searchlink_groups)) {
                $type = $xml_to_search_types[$group];
           //     $link_xml = '/<searchLink fieldCode="([^"]*)" term="([^"]*)">/';
           //     $link_html = "<a href=\"results.php?lookfor=$2&type=$1\">";  //replaced $path with "result.php"
           	$link_xml = '/<searchLink fieldCode="([^"]*)" term="([^"]*)">/'; //EP switching code around to only view elements
           	$link_html = "";
           	$data = preg_replace($link_xml, $link_html, $data);
            //    $data = str_replace('</searchLink>', '</a>', $data);
            	
            	$data = str_replace('</searchLink>', '', $data);
            	$data = str_replace('<br />', '', $data);
            }
            // Parse link
            if (!empty($group) && in_array($group, $allowed_link_groups)) {          
                $link_xml = '/<link linkTarget="([^"]*)" linkTerm="([^"]*)" linkWindow="([^"]*)">/';
                $link_html = "<a name=\"$1\" href=\"$2\" target=\"$3\">";  //replaced $path with "result.php"
                $data = preg_replace($link_xml, $link_html, $data);
                $data = str_replace('</link>', '</a>', $data);            
            }
            // Replace the rest of searchLinks with simple spans
            $link_xml = '/<searchLink fieldCode="([^\"]*)" term="%22([^\"]*)%22">/';
            $link_html = '<span>';
            $data = preg_replace($link_xml, $link_html, $data);
            $data = str_replace('</searchLink>', '</span>', $data);
             // Parse bibliography (anchors and links)
            $data = preg_replace('/<a idref="([^\"]*)"/', '<a href="#$1"', $data);
            $data = preg_replace('/<a id="([^\"]*)" idref="([^\"]*)" type="([^\"]*)"/', '<a id="$1" href="#$2"', $data);
        }

        return $data;
    }


}


?>