function articles_query(search_string){

	//create POST data object
	dataObject = new Object();

    dataObject.data_type = "html";
    dataObject.search_string = search_string;      
    url = "php/ep-BentoBoxDemo/ep-results.php?lookfor=" + search_string + "&filter[1]=addlimiter(FT1:y)&filter[2]=addlimiter(RV:y)";
//&filter[2]=addlimiter(RV:y)
    //returns json
    $(document).ready(function(){
      $.ajax({
        type: "GET",
        url: url,
      //  data: dataObject,
        dataType: "html",
        success: articlesSuccess,
        error: articlesError
      });
    });


	function articlesSuccess(response){
    //clear previous results
        $("#articles .box_results").empty(); 
		$("#articles .box_results").append(response);	
    // hides loading animation
    $("#articles .box_loading_animation").hide();
	}
	function articlesError(response){
		$("#articles .box_results").append("<p>Results could not be had.</p>");	
	}
	

}