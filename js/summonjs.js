var summonjs_object = null;
var summonData = null;


// simple function to update summonjs_query when holdings box checked
function update_summonjs_query(){
	//clear previous results
    $("#summonjs .box_results").empty();
    // hides loading animation
    $("#summonjs .box_loading_animation").show(); 
	// used saved search term for update search
	summonjs_query(search_string_global);
	// reveal / hide ILL message
	$(".summon_still_missing").slideToggle();	
}

function summonjs_query(search_string){

	// encode search string
	var search_string_encoded = encodeURI(search_string);

	/*
	Function expects a secondary parameter "holdings", as determined by checkbox on index.php
	This true / false is propogated to the summon query, returning items ONLY in holdings, or all of summon
	*/

	// determine holdings status, re-check box if previously set
	if ($("#holdings_checkbox:checked").length > 0){
		// box IS checked
		var holdings = false;
		var view_more_search_flag = "f";
		
	}
	else {
		// box IS NOT checked
		var holdings = true;
		var view_more_search_flag = "t";		
	}

    // create POST json data sting.
    summonData =  {
	    terms: search_string,
	    holdings: holdings
    };
    summonData = JSON.stringify(summonData);

    //returns dirty json
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: "php/summonjs.php",
        dataType: "json", 
        data: {myJson: summonData},
        success: summonjs_Success,
        error: summonjs_Error
      });
    });

    function summonjs_Success(response){
        //clear previous results
        $("#summonjs .box_results").empty();
        // hides loading animation
        $("#summonjs .box_loading_animation").hide();              
        summonjs_object = response;
        //function to test if object is empty
        $("#reference .box_results").empty();
        $("#reference .box_loading_animation").hide();   


        function isEmpty(ob){
        for(var i in ob){ return false;}
        return true;
        }


        if (isEmpty(summonjs_object.documents) === true) {

          $("#summonjs .box_results").append("<span>No material results were found.  Please try another search in <a href='http://wayne.summon.serialssolutions.com'>Summon</a></span>");

        }

        else {
          for (var i = 0; i < 3; i++) {
            count = summonjs_object.recordCount;

            if (summonjs_object.documents[i].Title != undefined)  {
                title = summonjs_object.documents[i].Title;
                url = summonjs_object.documents[i].link;
               $("#summonjs .box_results").append("<p class='summonjs-title'><a href='"+url+"'>"+title+"</a></p>");
            if (summonjs_object.documents[i].Author != undefined)  {
                author = summonjs_object.documents[i].Author[0];
               $("#summonjs .box_results").append("Authors: "+author+"</br>");
                }
            if (summonjs_object.documents[i].PublicationDate_xml[0] != undefined)  {
                $("#summonjs .box_results").append("Date: "); 
                  if (summonjs_object.documents[i].PublicationDate_xml[0]['month'] != undefined)  {
                  $("#summonjs .box_results").append(summonjs_object.documents[i].PublicationDate_xml[0]['month']+"/"); 
                  }
                  if (summonjs_object.documents[i].PublicationDate_xml[0]['day'] != undefined)  {
                  $("#summonjs .box_results").append(summonjs_object.documents[i].PublicationDate_xml[0]['day']+"/"); 
                  }
                  if (summonjs_object.documents[i].PublicationDate_xml[0]['year'] != undefined)  {
                  $("#summonjs .box_results").append(summonjs_object.documents[i].PublicationDate_xml[0]['year']+"</br>"); 
                  }                  
                }
            if (summonjs_object.documents[i].PublicationTitle != undefined)  {
                $("#summonjs .box_results").append(summonjs_object.documents[i].PublicationTitle[0]); 
                }
                else {
                $("#summonjs .box_results").append("</br>"); 
                } 

            if (summonjs_object.documents[i].Volume != undefined)  {
                $("#summonjs .box_results").append(", "+summonjs_object.documents[i].Volume[0]);
                }
                else {
                $("#summonjs .box_results").append(" "); 
                }   
            if (summonjs_object.documents[i].Issue != undefined)  {
                $("#summonjs .box_results").append("("+summonjs_object.documents[i].Issue[0]+")"); 
                }
                else {
                $("#summonjs .box_results").append("</br>"); 
                }             
            }
            $("#summonjs .box_results").append("<hr>"); 
    
        }
        	   var view_more_link = "<a href='http://wayne.summon.serialssolutions.com/#!/search?q="+search_string_encoded+"&ho="+view_more_search_flag+"&fvf=ContentType,Journal Article,f' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>";
               $("#summonjs .box_results").append(view_more_link);

        }

        //reference box
        if (summonjs_object.topicRecommendations != undefined) { 

          $("#reference .box_results").append("<p class='ref-from'>From "+summonjs_object.topicRecommendations[0].sourceName+":</p>");          
          $("#reference .box_results").append("<p>"+summonjs_object.topicRecommendations[0].snippet);
          $("#reference .box_results").append("</p><hr><a href='"+summonjs_object.topicRecommendations[0].sourceLink+"''><em>Read more about "+search_string+"...</em></a>");
          $("#reference").show();
        }

    }

    function summonjs_Error(response){
        // console.log(response);
    }
}