var books_object = null;
var count = null;

function books_query(search_string){
	search_string = search_string.replace(/:|\]|\[/g,'');
	var json_books_response = null;

$(document).ready(function(){
		dataObject = new Object();
		dataObject.data_type = "xml2json";
		dataObject.encodedURL = 'http://elibrary.wayne.edu/xmlopac/X';
		dataObject.searchTerm = search_string;

		$.ajax({
				type: "POST",
				url: "php/books.php",
				data: dataObject,
				dataType: "json",
				success: Success,
				error: Error
						});
				});

function Success (response){
		//clear previous results
		$("#books .box_results").empty();
		// hides loading animation
		$("#books .box_loading_animation").hide();
		books_object = response;


	if (books_object.bookTotal !== 0) {
		count = books_object.bookTotalComplete;

		for (var i = 0; i < books_object.bookTotal; i++) {

			var book_url = makeLink(books_object, i);
			var holdingStatus = (!books_object.status[i]) ? "" : "<br/>"+books_object.status[i]+"<br/>";
			var location = (!books_object.location[i]) ? "" : books_object.location[i];
			var lc = (!books_object.lc[i]) ? "" : books_object.lc[i]+"<br/>";
			var book_title = (!books_object.title[i]) ? "Untitled" : books_object.title[i];

			if (books_object.showStackView[i] == "no") {
				$("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+book_url+"'>"+book_title+"</a>"+holdingStatus+lc+" "+location+"</p></div>");

			}
			else {
				var uri = "http://library.wayne.edu/resources/stackview/?q="+books_object.lc[i];
				var stackviewLink = "<br/><a href='"+encodeURI(uri)+"' target='_blank'> <b>See on Shelf</b> <span class='icon-forward'></span></a>";
				$("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+book_url+"'>"+book_title+"</a>"+stackviewLink+holdingStatus+lc+" "+location+"</p></div>");
			}
		}  //for
		$("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");

	}
	//If no results, then display no results found
	if (books_object.bookTotal === 0) {
			$("#books .box_results").append("<span class=\"no-res\">No material results were found.  Please try another search in the <a href='http://elibrary.wayne.edu'>Catalog</a> or search <a href='http://wild.worldcat.org/search?q="+search_string+"&qt=results_page&dblist=638' target='_blank'>WorldCat<a/> or <a href='http://elibrary.mel.org/search/a?searchtype=X&searcharg="+search_string+"&SORT=D' target='_blank'>MeLCat</a></span>");
	}
}

function Error (response){
		//clear previous results
		$("#books .box_results").empty();
		// hides loading animation
		$("#books .box_loading_animation").hide();
		$("#books .box_results").append("<span class=\"no-res\">No material results were found.  Please try another search in the <a href='http://elibrary.wayne.edu'>Catalog</a> or search <a href='http://wild.worldcat.org/search?q="+search_string+"&qt=results_page&dblist=638' target='_blank'>WorldCat<a/> or <a href='http://elibrary.mel.org/search/a?searchtype=X&searcharg="+search_string+"&SORT=D' target='_blank'>MeLCat</a></span>");
		}

}


// function to construct item link
function makeLink(books_object, i) {
	if (!books_object.bibNum[i]) {
		var book_url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;
		$("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+book_url+"'>"+books_object.title[i]+"</a></p></div>");
	}
	else {
		var recNum = books_object.bibNum[i];
		return "http://elibrary.wayne.edu/record="+recNum;
	}
}

//function to test if object is empty
function isEmpty(ob){
	for(var i in ob){ return false;}
	return true;
}