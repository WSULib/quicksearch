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
        dataType: "json", 
        data: dataObject,
        success: site_searchSuccess,
        error: site_searchError
      });
    });

	function site_searchSuccess(response){
        //clear previous results
        $("#site_search .box_results").empty();    
        
        var site_searchJSON = response;
        console.log(site_searchJSON);

        if (site_searchJSON.results.length === 0){
            $("#site_search .box_results").append("<div id='no_results' class='db_result'><p>No results found.</p></div>");
        }        

        else {
            //set icon
          //  var icon = window.iconURL('text/html');            
            //iterate through results, push to search page
            for (var i = 0; i < site_searchJSON.results.length && i < 3; ++i){            
                $("#site_search .box_results").append("<div id='siteSearch_"+i+"' class='result_div indiv-result'></div>");
                //$("#siteSearch_"+i).append("<img class='mime_icon' src='http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/HTML/content' width=30 />");
                $("#siteSearch_"+i).append("<p class='title'><a href='"+decodeURIComponent(site_searchJSON.results[i].url)+"'>"+site_searchJSON.results[i].title+"</a></p>");           
                
            }
            var moreResultsURL = "http://wayne.edu/search/?type=all&q=" + search_string; 
            $("#site_search .box_results").append("<a href='"+moreResultsURL+"'><em>View more results...</em></a>");
        }        

        //turns off animation
        $("#site_search .box_loading_animation").hide();        
	}

	function site_searchError(response){
		console.log(response);
		//turns off animation
        $("#site_search .box_loading_animation").hide();   
		$("#site_search .box_results").append("<p>Site Search is temporarily unavailable.</p>");	
	}
	

}