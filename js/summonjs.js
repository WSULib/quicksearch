var summonjs_object = null;
var author = null;

function summonjs_query(search_string){



    // create POST data object

    dataObject.search_string = search_string;    
   
    //returns dirty json
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: "../resources/quicksearch/php/summonjs.php",
        dataType: "json", 
        data: dataObject,
        success: summonjs_Success,
        error: summonjs_Error
      });
    });

    function summonjs_Success(response){
      //  console.log(response);
        //clear previous results
        $("#summonjs .box_results").empty();
        // console.log(response);
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
               $("#summonjs .box_results").append("<a href='http://wayne.summon.serialssolutions.com/#!/search?ho=t&fvf=ContentType,Journal Article,f&q="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");

        }

        //reference box
        if (summonjs_object.topicRecommendations != undefined) { 

          $("#reference .box_results").append("<p class='ref-from'>From "+summonjs_object.topicRecommendations[0].sourceName+":</p>");          
          $("#reference .box_results").append("<p>"+summonjs_object.topicRecommendations[0].snippet);
          $("#reference .box_results").append("</p><hr><a href='"+summonjs_object.topicRecommendations[0].sourceLink+"''><em>Read more about "+search_string+"...</em></a>");
          $("#reference").show();
        }

        // else {
        //  $('#reference').hide()
        //  // alert("stuff");
        // }



    }

    function summonjs_Error(response){
        // console.log(response);
    }
}