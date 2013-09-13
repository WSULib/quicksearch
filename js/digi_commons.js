function digi_commons_query(search_string){

    // encode the string
    encoded_search_string = search_string.replace(" ","+");

    // create POST data object
    dataObject = {};
    dataObject.GETparams = {};    
    dataObject.search_string = encoded_search_string;    
    dataObject.GETparams.q = "dc_subject:"+encoded_search_string+"^2+"+encoded_search_string;
    dataObject.GETparams.wt = "json";    
    dataObject.GETparams.start = "0";
    dataObject.GETparams.rows = "3"; //returns only three results    

    //returns dirty json
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: "php/digi_commons.php",
        dataType: "json", 
        data: dataObject,
        success: digi_commonsSuccess,
        error: digi_commonsError
      });
    });

	function digi_commonsSuccess(response){
        //clear previous results
        $("#digi_commons .box_results").empty();
        // console.log(response);
        // hides loading animation
        $("#digi_commons .box_loading_animation").hide(); 

        if ( response.response.docs.length > 0){
            // console.log(response);

            for (var i = 0; i < response.response.docs.length; ++i){
                //get PID and title
                var docURL = response.response.docs[i].dc_identifier[0];

                //get title
                if (typeof response.response.docs[i].dc_title === 'undefined'){                
                    var title = "[unknown title]";                
                }
                else{                
                    var title = response.response.docs[i].dc_title[0];
                }

                //get icon if available
                if (typeof response.response.docs[i].dc_format === 'undefined'){                
                    var icon = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/Unknown/content";
                }
                else{ 
                    var format = response.response.docs[i].dc_format[0];                    
                 //   var icon = window.iconURL(format);
                }                                                                      

                $("#digi_commons .box_results").append("<div id='digi_commons"+i+"' class='result_div indiv-result'></div>");                
                //$("#digi_commons"+i).append("<img class='mime_icon' src='"+icon+"' width=30 />");
                $("#digi_commons"+i).append("<p class='title'><a target='_blank' href='"+docURL+"'>"+title+"</a></p>");
                if (typeof response.response.docs[i].dc_description !== 'undefined'){
                    $("#digi_commons"+i).append("<p class='result-details'>"+response.response.docs[i].dc_description[0].substr(0,100)+"...</p>");
                }
                
            }

            //more results
            $("#digi_commons .box_results").append("<a target='_blank' href='http://digitalcommons.wayne.edu/do/search/?q="+search_string+"&start=0&context=87433'><em>View more results...</em></a></br>");
        }

        else{
            $("#digi_commons .box_results").append("<p>No Results Found.</p>");
        }              
        
	}

	function digi_commonsError(response){
		// console.log(response);
	}
	

}