function site_search_query(search_string){

    // encode the string
    encoded_search_string = search_string.replace(/ /g,"%20");

    // create POST data object
    dataObject = new Object();
    dataObject.data_type = "html";
    dataObject.search_string = encoded_search_string;
    // console.log("site search string: ",encoded_search_string);

    //returns dirty json
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: "php/site_search.php",
        dataType: "json", //with no callback
        data: dataObject,
        success: site_searchSuccess,
        error: site_searchError
      });
    });

	function site_searchSuccess(response){
        //clear previous results
        $("#site_search .box_results").empty();    

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//scoop json from results - where callback
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // var front_stripped = response.replace("google.search.WebSearch.RawCompletion('1', ", "");
        // cleanJSON_string = front_stripped.replace(", 200, null, 200)","");
        // var site_searchJSON = jQuery.parseJSON(cleanJSON_string);

        // if (site_searchJSON.results.length === 0){
        //     $("#site_search .box_results").append("<div id='no_results' class='db_result'><p>No results found.</p></div>");
        // }

        // else {
        //     //iterate through results, push to search page
        //     for (var i = 0; i < 3; ++i){            
        //         $("#site_search .box_results").append("<div id='siteSearch_"+i+"' class='result_div'></div>");
        //         $("#siteSearch_"+i).append("<a href='"+decodeURIComponent(site_searchJSON.results[i].url)+"'>"+site_searchJSON.results[i].title+"</a></br>");           
                
        //     }
        // }


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //no callback
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        var site_searchJSON = response;

        if (site_searchJSON.responseData.results.length === 0){
            $("#site_search .box_results").append("<div id='no_results' class='db_result'><p>No results found.</p></div>");
        }        

        else {
            //set icon
          //  var icon = window.iconURL('text/html');            
            //iterate through results, push to search page
            for (var i = 0; i < site_searchJSON.responseData.results.length && i < 3; ++i){            
                $("#site_search .box_results").append("<div id='siteSearch_"+i+"' class='result_div indiv-result'></div>");
                //$("#siteSearch_"+i).append("<img class='mime_icon' src='http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/HTML/content' width=30 />");
                $("#siteSearch_"+i).append("<p class='title'><a href='"+decodeURIComponent(site_searchJSON.responseData.results[i].url)+"'>"+site_searchJSON.responseData.results[i].title+"</a></p>");           
                
            }
            var moreResultsURL = "http://wayne.edu/search/?q=biology#site:lib.wayne.edu " + search_string; 
            $("#site_search .box_results").append("<a href='"+moreResultsURL+"'><em>View more results...</em></a>");
        }        

        //turns off animation
        $("#site_search .box_loading_animation").hide();        
	}

	function site_searchError(response){
		$("#site_search .box_results").append("<p>Results are working somewhat, but need to double-check okay to use wayne.edu Google API search.</p>");	
	}
	

}