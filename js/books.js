var books_object = null;
var count = null;

function books_query(search_string){
	search_string = search_string.replace(/:|\]|\[/g,'');
	var json_books_response = null;

$(document).ready(function() {
		dataObject = new Object();
		dataObject.data_type = "xml2json";
		dataObject.encodedURL = 'http://elibrary.wayne.edu/xmlopac/X';
		dataObject.searchTerm = search_string;

$(document).ready(function(){
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
	
					if (typeof books_object.holdings_info[i].holding[0] !== 'undefined') {
						var holdingStatus = (isEmpty(books_object.holdings_info[i].holding[0].publicNote)) ? "" : books_object.holdings_info[i].holding[0].publicNote;
						if (!books_object.lc) {
							lc = "";
						}
						else {
							var lc = (books_object.lc[i] === null) ? "" : "<br/>"+books_object.lc[i]+"";
						}
						var stackviewLink = (books_object.MatType[i] == "PRINT" && books_object.lc[i] !== null) ? "<a href='http://www.lib.wayne.edu/resources/stackview/?q="+books_object.lc[i]+"' target='_blank'> <b>See on Shelf</b> <span class='icon-forward'></span></a><br/>": " <br/>";
						$("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+book_url+"'>"+books_object.title[i]+"</a>"+stackviewLink+holdingStatus+lc+"</p></div>");
					}
					else {
						$("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+book_url+"'>"+books_object.title[i]+"</a></p></div>");
					}
			}  //for
				$("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");  

}
//If no results, then display no results found
			if (books_object.bookTotal === 0) {  
					$("#books .box_results").append("<span class=\"no-res\">No material results were found.  Please try another search in the <a href='http://elibrary.wayne.edu'>Catalog</a></span>");    
			}
}

function Error (response){
		//clear previous results
		$("#books .box_results").empty();
		// hides loading animation
		$("#books .box_loading_animation").hide();
		$("#books .box_results").append("<span class=\"no-res\">No material results were found.  Please try another search in the <a href='http://elibrary.wayne.edu'>Catalog</a></span>");
		}

				});
}


//function to test if object is empty
function isEmpty(ob){
	for(var i in ob){ return false;}
	return true;
}


// function to construct item link
function makeLink(books_object, i) {
	if (!books_object.bibNum[i]) {
		var book_url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;
		$("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+book_url+"'>"+book_title+"</a></p></div>");
	}
	else {
		var recNum = books_object.bibNum[i];
		return "http://elibrary.wayne.edu/record="+recNum;
	}
}
