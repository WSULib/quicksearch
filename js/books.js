var books_object = null;
var books_removed = null;
var books_sorted = null;
var count = null;
var z = null;

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

    //function to test if object is empty
    function isEmpty(ob){
    for(var i in ob){ return false;}
    return true;
    }


if (books_object.bookTotal !== 0) {
  count = books_object.bookTotalComplete;

if (books_object.bookTotal === 1) {
  var title = books_object.title[0];
  var urlPrefix = "http://elibrary.wayne.edu/record=";
 
  if (!books_object.bibNum[0]) {
    var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
    $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
  }
  else {
          var recNum = books_object.bibNum[0];
          var url = urlPrefix+recNum;
          var hasMultipleHoldings = $.isArray(books_object.holdings_info[0].holding) ? true : false;
          var TypeofHoldingStatus = (hasMultipleHoldings) ? books_object.holdings_info[0].holding[0].publicNote : books_object.holdings_info[0].holding.publicNote;
          var holdingStatus = (isEmpty(TypeofHoldingStatus)) ? "" : TypeofHoldingStatus;
          var stackviewLink = (books_object.MatType[0] == "PRINT" && books_object.lc[i] !== null) ? "<a href='http://www.lib.wayne.edu/resources/stackview/?q="+books_object.lc[0]+"' target='_blank'> <b>See on Shelf</b> <i class='glyphicon glyphicon-share-alt'></i></a><br/>": " <br/>";
          var lc = (books_object.lc[i] == null) ? "" : "<br/>"+books_object.lc[i]+"";
          $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a>"+stackviewLink+holdingStatus+lc+"</p></div>");
  }
  $("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");  

}

else if (books_object.bookTotal === 2){

for (var i = 0; i < 2; i++) {
      var title = books_object.title[i];
      var urlPrefix = "http://elibrary.wayne.edu/record=";

      if (!books_object.bibNum[i]) {
        var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;
        $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
        }
      else {
          var recNum = books_object.bibNum[i];
          var url = urlPrefix+recNum;
          var hasMultipleHoldings = $.isArray(books_object.holdings_info[i].holding) ? true : false;
          var TypeofHoldingStatus = (hasMultipleHoldings) ? books_object.holdings_info[i].holding[0].publicNote : books_object.holdings_info[i].holding.publicNote;
          var holdingStatus = (isEmpty(TypeofHoldingStatus)) ? "" : TypeofHoldingStatus;
          var stackviewLink = (books_object.MatType[i] == "PRINT" && books_object.lc[i] !== null) ? "<a href='http://www.lib.wayne.edu/resources/stackview/?q="+books_object.lc[i]+"' target='_blank'> <b>See on Shelf</b> <i class='glyphicon glyphicon-share-alt'></i></a><br/>": " <br/>";
          var lc = (books_object.lc[i] == null) ? "" : "<br/>"+books_object.lc[i]+"";
          $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a>"+stackviewLink+holdingStatus+lc+"</p></div>");
        }
      }
        $("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");  

}
else {
for (var i = 0; i < 3; i++) {
      var title = books_object.title[i];
      var urlPrefix = "http://elibrary.wayne.edu/record=";

      if (!books_object.bibNum[i]) {
        var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
        $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
        }
        else {
          var recNum = books_object.bibNum[i];
          var url = urlPrefix+recNum;
          var hasMultipleHoldings = $.isArray(books_object.holdings_info[i].holding) ? true : false;
          var TypeofHoldingStatus = (hasMultipleHoldings) ? books_object.holdings_info[i].holding[0].publicNote : books_object.holdings_info[i].holding.publicNote;
          var holdingStatus = (isEmpty(TypeofHoldingStatus)) ? "" : TypeofHoldingStatus;
          var stackviewLink = (books_object.MatType[i] == "PRINT" && books_object.lc[i] !== null) ? "<a href='http://www.lib.wayne.edu/resources/stackview/?q="+books_object.lc[i]+"' target='_blank'> <b>See on Shelf</b> <i class='glyphicon glyphicon-share-alt'></i></a><br/>": " <br/>";
          var lc = (books_object.lc[i] == null) ? "" : "<br/>"+books_object.lc[i]+"";
          $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a>"+stackviewLink+holdingStatus+lc+"</p></div>");
         }
      }
        $("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");  
    }
}
//If no results, then display no results found
      if (books_object.bookTotal === 0) {  
          $("#books .box_results").append("<span class=\"no-res\">No material results were found.  Please try another search in the <a href='http://elibrary.wayne.edu'>Catalog</a></span>");    
      }
}

function Error (response){
    console.log("Error");
    console.log(response);
    //clear previous results
    $("#books .box_results").empty();
    // hides loading animation
    $("#books .box_loading_animation").hide();
    $("#books .box_results").append("<span class=\"no-res\">No material results were found.  Please try another search in the <a href='http://elibrary.wayne.edu'>Catalog</a></span>");
    }

        });
}
