    var json_journals_response = null;
    var journals_object = null;

function journals_query(search_string){


$(document).ready(function() {
    dataObject = new Object();
    dataObject.data_type = "xml2json";
    dataObject.encodedURL = 'http://elibrary.wayne.edu/xmlopac/t';
    dataObject.searchTerm = search_string;

$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "php/journals.php",
        data: dataObject,
        dataType: "json",
        success: Success,
        error: Error
            });
        });

function Success (response){
    //clear previous results
    $("#journals .box_results").empty();
    console.log(response);
    // hides loading animation
	$("#journals .box_loading_animation").hide();
            journals_object = new Object();    
    // populate journal_object global variable with bibnumbers
    for (var i = 0; i < 12; i++) {
        // console.log('title ' + i);
        // console.log(response.Heading[i].Title);
        if (response.Heading instanceof Array) {
            if (response.Heading[i].Title instanceof Array) {
                console.log("array");
                if (typeof response.Heading[i].Title[i] === "undefined"){
                    continue;
                }
                else {
                    journals_object['bib ' + i] = response.Heading[i].Title[0].RecordId.RecordKey;            
                    }
            }
            else {
                    if (typeof response.Heading[i].Title === "undefined"){
                        continue;
                    }
                    else {
                        journals_object['bib ' + i] = response.Heading[i].Title.RecordId.RecordKey;
                    }
                }
            }
        else {
            //if Heading is not an array
                console.log("not array");
                console.log("title " + i);
                if (response.Heading.Title instanceof Array) {
                    if (typeof response.Heading.Title[i] === "undefined"){
                        console.log("undefined title array");
                        continue;
                    }
                    else {
                        console.log("defined title array");
                        journals_object['bib ' + i] = response.Heading.Title[0].RecordId.RecordKey;            
                        }
                    }
                else{
                    
                    if (typeof response.Heading.Title === "undefined"){
                        console.log("undefined title");
                        continue;
                    }
                    else {
                        console.log("defined title");
                        journals_object['bib ' + i] = response.Heading.Title.RecordId.RecordKey;
                        }
                    }
            
                }
            }
	//json response
    // json_journals_response = jQuery.parseJSON(response);
        if (response.Heading.length > 1) {

    		for (var i = 0; i < 3; i++){
    			//make some shortened variables for the data you want to mess with
              	//check to make sure the title isn't broken down into multiple parts and is an array

    			if (response.Heading[i].Title instanceof Array) {
    				var title = response.Heading[i].Title[0].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
                    // console.log(title);
	               	var recNum = response.Heading[i].Title[0].RecordId.RecordKey;
	               	var image = response.Heading[i].Title[1].BibImage.BibImageThumb;
    			}
    			else {
    				var title = response.Heading[i].Title.TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
                    // console.log(title);
    				var recNum = response.Heading[i].Title.RecordId.RecordKey;
    				// if (typeof response.Heading[i].Title.BibImage.BibImageThumb == "undefined") {
    				// 	var image = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/Unknown/content' width='65'";
    				// }
    				// else {
	       //         	var image = response.Heading[i].Title.BibImage.BibImageThumb;
    				// }
    			}
    			var count = response.Heading.length;
               	var urlPrefix = "http://elibrary.wayne.edu/record=";
               	var url = urlPrefix+recNum;

	    		// check to see that there is a title
	    		if (typeof title === "undefined") {
	    			title = "Untitled";    			
	    		}
	    		//check to see that there is a link to send a user to
	    		if (typeof url === "undefined") {
	    			url = "";    			
	    		}

	    		//plunk the data into the journals box
	        	$("#journals .box_results").append("<div id='result"+i+"' class=result_div></div>");
				$("#journals .box_results").append("<a href='"+url+"' target='_blank'>"+title+"</a><br/>");
				// imageInsert(response, i);
		    // }
               	}
  //              	else {
  //              		// console.log("this result is not a journal");

		// }
		    //if there are more than 3 results, allow them to see all of the results with a link to the catalog
		    if (response.Heading.length > 3) {
        	$("#journals .box_results").append("<br/><span><a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"&searchscope=17' target='_blank'><em>View more results...("+count+")</em></a></span>");		    	
		    }
		}
		//if there is only one result, display it here
    	else if (response.Heading.length == 1) {
    		for (var i = 0; i < 1; i++){
    			//make some shortened variables for the data you want to mess with   
              	//check to make sure the title isn't broken down into multiple parts and is an array
    			if (response.Heading[i].Title instanceof Array) {
    				var title = response.Heading[i].Title[0].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
	               	var recNum = response.Heading[i].Title[0].RecordId.RecordKey;
	               	var image = response.Heading[i].Title[1].BibImage.BibImageThumb;
    			}
    			else {
    				var title = response.Heading[i].Title.TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
    				var recNum = response.Heading[i].Title.RecordId.RecordKey;
	               	var image = response.Heading[i].Title.BibImage.BibImageThumb;
    			}   		
				var count = response.Heading.HeadingSize;
               	var url1 = "http://elibrary.wayne.edu/record=";
               	var url = url1+recNum;	
               	// console.log(title);
	    		// check to see that there is a title
	    		if (typeof title == "undefined") {
	    			title = "Untitled";    			
	    		}
	    		//check to see that there is a link to send a user to
	    		if (typeof url == "undefined") {
	    			url = "";    			
	    		}
	        	$("#journals .box_results").append("<div id='result"+i+"' class=result_div></div>");
				$("#journals .box_results").append("<a href='"+url+"' target='_blank'>"+title+"</a><br/>");
				// imageInsert(response, i);		
               	}
    }
    	else {
        	$("#journals .box_results").append("<span>No Results Found.</span>");		
    	}
    }
function imageInsert (response, i) {
	//check to see that the cover exists; if not, put placehoder image from Fedora Commons
// if (response.Heading[i].Title.length > 1) {
   	var image = response.Heading[i].Title[1].BibImage.BibImageThumb;
// 	}
// else {
   	// var image = response.Heading[i].Title.BibImage.BibImageThumb;
	// }
	var width=0, height=0;
	$("<img/>")
	    .attr("src", "image")
	    .load(function() {
	        w = this.width;
	        h = this.height;
	        if (w == 1 && h == 1) {
			$("#result"+i).append("<img src='http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/Unknown/content' width='65'>");        	
	        }
	        else {
	        $("#result"+i).append("<img src='"+image+"'>");
	        }
	    }); 
}
function Error (response){
    console.log("Error");
    console.log(response);
    }

        });
}