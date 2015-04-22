function lib_guides_query(search_string){

	//create POST data object
	dataObject = new Object();

    dataObject.data_type = "html";
    dataObject.search_string = search_string;
    search_string = search_string.replace(/%27/g,'');
    url = "php/lib_guides.php?search_string=" + search_string;

    //returns json
    $(document).ready(function(){
      $.ajax({
        type: "GET",
        url: url,
      //  data: dataObject,
        dataType: "html",
        success: libguideSuccess,
        error: libguideError
      });
    });


	function libguideSuccess(response){
		$("#lib_guides .box_results").append(response);

        $("#lib_guides .box_results li").append("<hr>");
        $("#lib_guides .box_results hr").last().remove();

        // hides loading animation
        $("#lib_guides .box_loading_animation").hide();
	}
	function libguideError(response){
		$("#lib_guides .box_results").append("<p>Results could not be had.</p>");
	}

}
