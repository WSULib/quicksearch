function digi_commons_query(search_string){
    
    
	// ajax attempt
    var dataObject = {};
    dataObject = new Object();  	   	    
    dataObject.q = search_string    
    dataObject.q = "dc_subject:"+search_string+"^2+"+encoded_search_string;
    dataObject.start = "0";
    dataObject.rows = "3"; //returns only three results
    dataObject.wt = "json"; //sets response to JSON   
    dataObject['solrCore'] = "DCOAI"
    dataObject['functions[]'] = "solrCoreGeneric";
    
    $(document).ready(function(){
      var digi_collections_request = $.ajax({
        type: "POST",
        url: "http://digital.library.wayne.edu/WSUAPI",
        data: dataObject,
        dataType: "json",
        success: digi_commons_success,
        error: digi_commons_ajax_error
      });
    });

    

	function digi_commons_success(response){		

        //clear previous results
        $("#digi_commons .box_results").empty();        
        // hides loading animation
        $("#digi_commons .box_loading_animation").hide(); 

        if ( response.solrCoreGeneric.response.docs.length > 0){
            // console.log(response);

            for (var i = 0; i < response.solrCoreGeneric.response.docs.length; ++i){
                //get PID and title
                var docURL = response.solrCoreGeneric.response.docs[i].dc_identifier[0];

                //get title
                if (typeof response.solrCoreGeneric.response.docs[i].dc_title === 'undefined'){                
                    var title = "[unknown title]";                
                }
                else{                
                    var title = response.solrCoreGeneric.response.docs[i].dc_title[0];
                }

                //get icon if available
                if (typeof response.solrCoreGeneric.response.docs[i].dc_format === 'undefined'){                
                    var icon = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/Unknown/content";
                }
                else{ 
                    var format = response.solrCoreGeneric.response.docs[i].dc_format[0];                    
                 //   var icon = window.iconURL(format);
                }                                                                      

                $("#digi_commons .box_results").append("<div id='digi_commons"+i+"' class='result_div indiv-result'></div>");                
                //$("#digi_commons"+i).append("<img class='mime_icon' src='"+icon+"' width=30 />");
                $("#digi_commons"+i).append("<p class='title'><a href='"+docURL+"'>"+title+"</a></p>");
                if (typeof response.solrCoreGeneric.response.docs[i].dc_description !== 'undefined'){
                    $("#digi_commons"+i).append("<p class='result-details'>"+response.solrCoreGeneric.response.docs[i].dc_description[0].substr(0,100)+"...</p>");
                }
                
            }

            //more results
            $("#digi_commons .box_results").append("<a href='http://digitalcommons.wayne.edu/do/search/?q="+search_string+"&start=0&context=87433'><em>View more results...</em></a></br>");
        }

        else{
            $("#digi_commons .box_results").append("<p>No Results Found.</p>");
        }              
        
	}

	function digi_commons_ajax_error(response){		
		// attempt PHP tunnel for when cross-domain ajax fails (< IE8)

        // ajax with PHP tunnel 
        var dataObject = {};
        dataObject = new Object();              
        dataObject.q = search_string    
        dataObject.q = "dc_subject:"+search_string+"^2+"+encoded_search_string;
        dataObject.start = "0";
        dataObject.rows = "3"; //returns only three results
        dataObject.wt = "json"; //sets response to JSON   
        dataObject['solrCore'] = "DCOAI";
        dataObject['function'] = "solrCoreGeneric";
        dataObject['baseURL'] = "http://digital.library.wayne.edu/WSUAPI?";
        
        $(document).ready(function(){
          $.ajax({
            type: "POST",
            url: "php/digital_library_tunnel.php",
            data: dataObject,
            dataType: "json",
            success: digi_commons_success,
            error: digi_commons_critical_error
          });
        });
	}

    function digi_commons_critical_error(){
        console.log("Digital Collections Critical Error, fallback method unsuccessful.");
    }
	

}