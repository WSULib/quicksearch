function digi_collections_query(search_string){        

	dataObject = new Object();
    //get values from form
    dataObject.GETparams = new Object();
    dataObject.GETparams.core = "mods";
    dataObject.GETparams.q = search_string;    
    dataObject.GETparams.start = "0";
    dataObject.GETparams.rows = "3"; //returns only three results
    dataObject.GETparams.wt = "json"; //sets response to JSON
    // dataObject.GETparams.fq = $('#fq').val();
    // dataObject.GETparams.fl = $('#fl').val();

    //assemble URL
    dataObject.baseURL = "http://silo.lib.wayne.edu/solr4/"+dataObject.GETparams.core+"/select?";        
    
    // console.log(dataObject);
    
    $(document).ready(function(){
      var digi_collections_request = $.ajax({
        type: "POST",
        url: "php/digi_collections.php",
        data: dataObject,
        dataType: "json",
        success: SolrSuccess,
        error: SolrError
      });
    });

    function SolrSuccess(response){

        //clear previous results
        $("#digi_collections .box_results").empty();

    	if ( response.response.docs.length > 0){
    		console.log(response);

	    	for (var i = 0; i < response.response.docs.length; ++i){
	    		//get PID and title
	    		var PID = response.response.docs[i].id;
	            if (typeof response.response.docs[i].mods_title_ms === 'undefined'){                
	                var title = "[unknown title]";                
	            }
	            else{                
	                var title = response.response.docs[i].mods_title_ms[0];
	            }

	            $("#digi_collections .box_results").append("<div id='digiCollections_"+i+"' class='result_div'></div>");
	            $("#digiCollections_"+i).append("<img class='mime_icon' src='http://silo.lib.wayne.edu/fedora/objects/"+PID+"/datastreams/THUMBNAIL/content' width=45  />");
	            $("#digiCollections_"+i).append("<a target='_blank' href='http://silo.lib.wayne.edu/fedora/objects/"+PID+"'>"+title+"</a></br>");            
	        }

            //more results
            $("#digi_collections .box_results").append("<p><em>View More Results (soon)...</em></p>");
        }

        else{
        	$("#digi_collections .box_results").append("<p>No Results Found.</p>");
        }

        // hides loading animation
		$("#digi_collections .box_loading_animation").hide(); 
    }

    function SolrError(response){
    	console.log(response);
    }

}