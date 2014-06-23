function digi_collections_query(search_string){
	dataObject = new Object();  	   	    
    dataObject.q = search_string    
    dataObject.start = "0";
    dataObject.rows = "3"; //returns only three results
    dataObject.wt = "json"; //sets response to JSON   
    dataObject['functions[]'] = "solrSearch";
    
    $(document).ready(function(){
      var digi_collections_request = $.ajax({
        type: "POST",
        url: "http://digital.library.wayne.edu/WSUAPI?",
        data: dataObject,
        dataType: "json",
        success: SolrSuccess,
        error: SolrError
      });
    });

    function SolrSuccess(response){

        //clear previous results
        $("#digi_collections .box_results").empty();
        // hides loading animation
        $("#digi_collections .box_loading_animation").hide();

    	if ( response.solrSearch.response.docs.length > 0){
    		

    	for (var i = 0; i < response.solrSearch.response.docs.length; ++i){
        	// get PID and title
        	var PID = response.solrSearch.response.docs[i].id;
            if (typeof response.solrSearch.response.docs[i].dc_title === 'undefined'){
                var title = "[unknown title]";
            }
            else{
                var title = response.solrSearch.response.docs[i].dc_title[0];
            }
            // get content model as type
            var type = response.solrSearch.response.docs[i].rels_hasContentModel[0];
            type = type.substring(type.lastIndexOf(":") + 1, type.length);

            // append to DOM
            $("#digi_collections .box_results").append("<div id='digiCollections_"+i+"' class='indiv-result'></div>");
            $("#digiCollections_"+i).append("<div class='dc-img'><a href='http://digital.library.wayne.edu/digitalcollections/item?id="+PID+"'><img class='mime_icon' src='http://digital.library.wayne.edu/fedora/objects/"+PID+"/datastreams/THUMBNAIL/content' /></a></div>");
            $("#digiCollections_"+i).append("<a class='title' href='http://digital.library.wayne.edu/digitalcollections/item?id="+PID+"'>"+title+" ["+type+"]</a>");            
        }

        //more results
            $("#digi_collections .box_results").append("<p><a href='http://digital.library.wayne.edu/digitalcollections/search.php?q="+search_string+"'><em>View more results...("+response.solrSearch.response.numFound+")</em></a></p>");
        }

        else {
            $("#digi_collections .box_results").append("<p>No Results Found.</p>");
        }            
    }

    function SolrError(response){
	   console.log(response);
    }

}