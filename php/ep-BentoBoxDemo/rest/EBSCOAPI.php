<?php


/**
 * EBSCO API class
 *
 * PHP version 5
 *
 */

require_once 'EBSCOConnector.php';
require_once 'EBSCOResponse.php';


/**
 * EBSCO API class
 */
class EBSCOAPI
{
    /**
     * The authentication token used for API transactions
     * @global string
     */
    private $authenticationToken;


    /**
     * The session token for API transactions
     * @global string
     */
    private $sessionToken;

    /**
     * The EBSCOConnector object used for API transactions
     * @global object EBSCOConnector
     */
    private $connector;


    /**
     * Search types (see Basic Search)  mapped to EBSCO search tags
     * @global array
     */   
    
    public function tagSelect($term){
        if($term=='Author'){
            return 'AU';
        }
        if($term == 'title'){
            return 'TI';
        }
        if($term == 'keyword'){
            return '';
        }
        else{
            return $term;
        }
    }


    /*
     * This fuction is used to replace the old authToken() and sessionToken methods
     * in order to figure out the infinit request for sessionToken when authToken has expired bug.
     */
    
    public function apiAuthenticationAndSessionToken(){
      $authenticationToken = $this->apiAuthenticationToken();
      $sessionToken = $this->apiSessionToken($authenticationToken);
      $tokens['authToken'] = $authenticationToken;
      $tokens['sessionToken'] = $sessionToken;
      return $tokens;
    }
    

    /**
     * Create a new EBSCOConnector object or reuse an existing one
     *
     * @param none
     *
     * @return EBSCOConnector object
     * @access public
     */
    public function connector()
    {
        if (empty($this->connector)) {
            $this->connector = new EBSCOConnector();
        }

        return $this->connector;
    }


    /**
     * Create a new EBSCOResponse object
     *
     * @param object $response
     *
     * @return EBSCOResponse object
     * @access public
     */
    public function response($response)
    {
        $responseObj = new EBSCOResponse($response);
        return $responseObj;
    }


    /**
     * Request authentication and session tokens, then send the API request.
     * Retry the request if authentication errors occur
     *
     * @param string  $action     The EBSCOConnector method name
     * @param array   $params     The parameters for the HTTP request
     * @param integer $attempts   The number of retries. The default number is 3 but can be increased.
     * 3 retries can handle a situation when both autentication and session tokens need to be refreshed + the current API call
     *
     * @return array              An associative array with results.
     * @access protected
     */
    protected function request($action, $params = null, $attempts = 3)
    {
        try {
            $tokens = $this->apiAuthenticationAndSessionToken();
                        $authenticationToken = $tokens['authToken'];
                        $sessionToken = $tokens['sessionToken'];

            // If authentication token or session token is empty request one and update the headers
            if (empty($authenticationToken)||empty($sessionToken)) {
               $tokens = $this->apiAuthenticationAndSessionToken();
                        $authenticationToken = $tokens['authToken'];
                        $sessionToken = $tokens['sessionToken'];
                
            }

            $headers = array(
                'x-authenticationToken: ' . $authenticationToken,
                'x-sessionToken: ' . $sessionToken
            );

            $response = call_user_func_array(array($this->connector(), "request{$action}"), array($params, $headers));
            $result = $this->response($response)->
                    result();
            return $result;
        } catch(EBSCOException $e) {
            try {
                // Retry the request if there were authentication errors
                $code = $e->getCode();
                switch ($code) {
                    case EBSCOConnector::EDS_AUTH_TOKEN_INVALID:
                        $tokens = $this->apiAuthenticationAndSessionToken();
                        $authenticationToken = $tokens['authToken'];
                        $sessionToken = $tokens['sessionToken'];
                        //$this->authenticationToken($authenticationToken);
                        if ($attempts > 0) {
                            return $this->request($action, $params, $headers, --$attempts);
                        }
                        break;
                    case EBSCOConnector::EDS_SESSION_TOKEN_INVALID:
                        $tokens = $this->apiAuthenticationAndSessionToken();
                        $authenticationToken = $tokens['authToken'];
                        $sessionToken = $tokens['sessionToken'];
                        //$this->sessionToken($sessionToken);
                        if ($attempts > 0) {
                            return $this->request($action, $params, $headers, --$attempts);
                        }
                        break;
                    default:
                        $result = array(
                            'error' => $e->getMessage()
                        );
                        return $result;
                        break;
                }
            }  catch(Exception $e) {
                $result = array(
                    'error' => $e->getMessage()
                );
                return $result;
            }
        } catch(Exception $e) {
            $result = array(
                'error' => $e->getMessage()
            );
            return $result;
        }
    }


    /**
     * Wrapper for authentication API call
     *
     * @param none
     *
     * @access public
     */
    public function apiAuthenticationToken()
    {
        $response = $this->connector()->requestAuthenticationToken();
        $result = $this->response($response)->result();
        return $result['authenticationToken'];
    }


    /**
     * Wrapper for session API call
     *
     * @param none
     *
     * @access public
     */
    public function apiSessionToken($authenToken)
    {
        // Add authentication tokens to headers
        $headers = array(
            'x-authenticationToken: ' . $authenToken
        );

        $response = $this->connector()->requestSessionToken($headers);
        $result = $this->response($response)->result();
        return $result;
    }


    /**
     * Wrapper for search API call
     *
     * @param array  $search      The search terms
     * @param array  $filters     The facet filters
     * @param string $start       The page to start with
     * @param string $limit       The number of records to return
     * @param string $sortBy      The value to be used by for sorting
     * @param string $amount      The amount of data to be returned
     * @param string $mode        The search mode
     *
     * @throws object             PEAR Error
     * @return array              An array of query results
     * @access public
     */
    public function apiSearch($search, $filters,
        $start = 1, $limit = 20, $sortBy = 'relevance', $amount, $mode = 'all',$highlight, $inclf, $expander 
    ) {
        $query = array();

        // Basic search
        if(!empty($search['lookfor'])) {
            $term = urldecode($search['lookfor']);
            $term = str_replace('"', '', $term); // Temporary
            $term = str_replace(',',"\,",$term);
            $term = str_replace(':', '\:', $term);
            $term = str_replace('(', '\(', $term);
            $term = str_replace(')', '\)', $term);
            $type = $search['type'];
            // Transform a Search type into an EBSCO search tag
            $tag = $this->tagSelect($type);//self::$search_tags[$type];
            if($tag!=null){
            $query_str = implode(" ", array($tag, $term));
            }else{
            $query_str = $term;
            }
            $query["query"] = $query_str;

        // No search term, return an empty array
        } else {
            $results = array();
            return $results;
        }
         $query['action'] = array();
        // Add filters
        foreach ($filters as $filter) {
            if (preg_match('/(addfacetfilter|addlimiter|addexpander)/', $filter)) {
                $query['action'][] = $filter;
            }
        }
        array_push($query['action'], "GoToPage($start)");
        
        // Add the HTTP query params
        $params = array(
            // Specifies the sort. Valid options are:
            // relevance, date, date2
            // date = Date descending
            // date2 = Date descending
            'sort'           => $sortBy,
            // Specifies the search mode. Valid options are:
            // bool, any, all, smart
            'searchmode'     => $mode,
            // Specifies the amount of data to return with the response. Valid options are:
            // Title: title only
            // Brief: Title + Source, Subjects
            // Detailed: Brief + full abstract
            'view'           => $amount,
            // Specifies whether or not to include facets
            'includefacets'  => $inclf,
            'resultsperpage' => $limit,
            'pagenumber'     => $start,
            // Specifies whether or not to include highlighting in the search results
            'highlight'      => $highlight,
            'expander'       => $expander
        );
          
        $params = array_merge($params, $query);

        $results = $this->request('Search', $params);
        return $results;
    }


    /**
     * Wrapper for retrieve API call
     *
     * @param array  $an          The accession number
     * @param string $start       The short database name
     *
     * @throws object             PEAR Error
     * @return array              An associative array of data
     * @access public
     */
    public function apiRetrieve($an, $db)
    {
        // Add the HTTP query params
        $params = array(
            'an'        => $an,
            'dbid'      => $db,
            'highlight' => 'n'
        );

        $result = $this->request('Retrieve', $params);
        return $result;
    }


    /**
     * Wrapper for info API call
     *
     * @return array              An associative array of data
     * @access public
     */
    public function apiInfo()
    {
        // The Info data can be cached , since it doesn't change
        if ($result = $this->read_session('info')) {
            return $result;
        }

        $result = $this->request('Info');
        return $result;
    }


    /**
     * Store the given object ubto session
     *
     * @param string $key    The key used for reading the value
     * @param object $value  The object stored in session
     *
     * @return none
     * @access protected
     */
    /*protected function write_session($key, $value)
    {
        if(!empty($key) && !empty($value)) {
            $_SESSION['EBSCO'][$key] = $value;
        }
    }


    /**
     * Read from session the object having the given key
     *
     * @param string $key    The key used for reading the object
     *
     * @return object
     * @access protected
     */
   /* protected function read_session($key)
    {
        $value = isset($_SESSION['EBSCO'][$key]) ? $_SESSION['EBSCO'][$key] : '';
        return $value;
    }*/

}


?>