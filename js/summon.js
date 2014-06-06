function summon_query(search_string){

  //create POST data object
  dataObject = new Object();

    dataObject.data_type = "html";
    dataObject.search_string = search_string;      
   url = "php/summon.php?q=" + search_string;

//&filter[2]=addlimiter(RV:y)
    //returns json
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: url,
      //  data: dataObject,
        dataType: "html",
        success: summonSuccess,
        error: summonError
      });
    });


  function summonSuccess(response){
    $("#summon .box_results").empty();

    $("#summon .box_results").append(response); 
    // hides loading animation
    $("#summon .box_loading_animation").hide();
  }
  function summonError(response){
    $("#summon .box_results").append("<p>Results could not be found.</p>"); 
  }
  

}