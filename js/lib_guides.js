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
        $("#lib_guides .box_results").html('');

        if (response == '<div id="libGuideWidget"><div id="api_search_guides_iid692"><div class="s-lg-guide-list-info"><i>No results match the request.</i></div></div></div>'
            || response == '<div id="libGuideWidget"><div id="api_search_guides_iid692"></div></div>') {
            //$("#lib_guides .box_results").append('<div class="no-res">No results found. See <a href="http://guides.lib.wayne.edu/">All Guides</a>');
            $("#lib_guides .box_results").append('<div class="no-res">No results found. Try another search in <a href="http://guides.lib.wayne.edu/srch.php?q='+search_string+'">Guides</a>');
        } else {
            response = response.replace('View more results', '<span style="font-weight:300;font-style: italic;">View more results...</span>');
            $("#lib_guides .box_results").append(response);
        }

        $("#lib_guides .box_results li").append("<hr>");
        $("#lib_guides .box_results hr").last().remove();

        // hides loading animation
        $("#lib_guides .box_loading_animation").hide();
	}
	function libguideError(response){
		$("#lib_guides .box_results").append("<p>Results could not be had.</p>");
	}

}
