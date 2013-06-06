//TODO
// sometimes no title?  breaks finishing of script

function databases_query(search_string){	

	// construct query	
	// var baseURL = "http://www.lib.wayne.edu/tmp/BB_graham_testing/rest/resource_database.php?q=";
	var baseURL = "php/databases.php?search_string=";
	var queryURL = baseURL + search_string;

	//returns json	
	$.ajax({
	  type: "GET",
	  url: queryURL,
	  dataType: "json",
	  success: databasesSuccess,
	  error: databasesError
	});
	

	function databasesSuccess(response){		
		//clear previous results
    	$("#databases .box_results").empty();

		// console.log(response);
		// NOTE: when displaying these, grab the little lock image for the locked ones "http://www.lib.wayne.edu/inc/img/icons/lock_paper.gif"

		if (response.resources != null){
			if ( response.resources.length < 3 ){
				var result_count = response.resources.length;
			}
			else {
				var result_count = 3;
			}
			for (var i = 0; i < result_count; ++i){		    	
				$("#databases .box_results").append("<div id='resource_"+i+"' class='result_div'></div>");
				$("#resource_"+i).append("<a target='_blank' href='"+response.resources[i].url+"'>"+response.resources[i].title+"</a></br>");
				$("#resource_"+i).append("<span><em>"+response.resources[i].description.substr(0,100)+"...</em></span></br>");
			}

			//more results everytime
			$("#databases .box_results").append("<span><a target='_blank' href='http://www.lib.wayne.edu/resources/databases/search.php?q="+search_string+"&b=Search'><em>View more results...</em></a></span");
		}

		else{
			$("#databases .box_results").append("<div id='no_results' class='db_result'><p>No results found.</p></div>");
		}
			
		// hides loading animation
		$("#databases .box_loading_animation").hide(); 

	}

	function databasesError(response){
		// console.log('no dice for databases');
	}
                
}