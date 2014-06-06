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

//make a global variable with the books' ajax response
    books_object = response;

    //function to test if object is empty
    function isEmpty(ob){
    for(var i in ob){ return false;}
    return true;
    }


if (books_object.PAGEINFO.ENTRYCOUNT !== '0') {


if (books_object.PAGEINFO.ENTRYCOUNT === '1') {
  count = books_object.Heading.HeadingSize;
  if ( isEmpty(books_object.Heading.Title.TitleField) === true) {
    title = "eResource - Click For Title";
  }
  else {         
  title = books_object.Heading.Title.TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
  }
  var urlPrefix = "http://elibrary.wayne.edu/search~S47?/X"+search_string+"&searchscope=47&SORT=D/X"+search_string+"&searchscope=47&SORT=D&SUBKEY="+search_string+"/1%2C"+count+"%2C"+count+"%2CB/frameset&FF=X"+search_string+"&searchscope=47&SORT=D&SUBKEY="+search_string+"&"
  if (typeof books_object.Heading.Title.RecordId.RecordKey === "undefined") {
  var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
  }
  else {
  var recNum = books_object.Heading.Title.RecordId.RecordKey;
  var recAdd = i+1;
  var rec =  recAdd+"%2C"+recAdd+"%2C";
  var url = urlPrefix+rec;
 // var url = urlPrefix+recNum;
  }
  $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
  $("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");  

}

else if (books_object.PAGEINFO.ENTRYCOUNT === '2'){

for (var i = 0; i < 2; i++) {
         //make some shortened variables for the data you want to mess with
              
              count = books_object.Heading.HeadingSize;
              if ( isEmpty(books_object.Heading.Title[i].TitleField) === true) {
                  title = "eResource - Click For Title";
                }
               else {         
                title = books_object.Heading.Title[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
                }
                var urlPrefix = "http://elibrary.wayne.edu/search~S47?/X"+search_string+"&searchscope=47&SORT=D/X"+search_string+"&searchscope=47&SORT=D&SUBKEY="+search_string+"/1%2C"+count+"%2C"+count+"%2CB/frameset&FF=X"+search_string+"&searchscope=47&SORT=D&SUBKEY="+search_string+"&"
              if (typeof books_object.Heading.Title[i].RecordId.RecordKey === "undefined") {
                var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
                }
                else {
               var recNum = books_object.Heading.Title[i].RecordId.RecordKey;
               var recAdd = i+1;
               var rec =  recAdd+"%2C"+recAdd+"%2C";
               var url = urlPrefix+rec;
             //  var url = urlPrefix+recNum;
              }
        $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
}
        $("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");  

}
else {
for (var i = 0; i < 3; i++) {
         //make some shortened variables for the data you want to mess with
              
              count = books_object.Heading.HeadingSize;
              if ( isEmpty(books_object.Heading.Title[i].TitleField) === true) {
                  title = "eResource - Click For Title";
                }
               else {         
                title = books_object.Heading.Title[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;

                }
                //http://elibrary.wayne.edu/search~S47?/Xgreen+technology&searchscope=47&SORT=D/Xgreen+technology&searchscope=47&SORT=D&SUBKEY=green+technology/1%2C513%2C513%2CB/frameset&FF=Xgreen+technology&searchscope=47&SORT=D&SUBKEY=green+technology&1%2C1%2C
                var urlPrefix = "http://elibrary.wayne.edu/search~S47?/X"+search_string+"&searchscope=47&SORT=D/X"+search_string+"&searchscope=47&SORT=D&SUBKEY="+search_string+"/1%2C"+count+"%2C"+count+"%2CB/frameset&FF=X"+search_string+"&searchscope=47&SORT=D&SUBKEY="+search_string+"&"
                //var urlPrefix = "http://elibrary.wayne.edu/record=";
              if (typeof books_object.Heading.Title[i].RecordId.RecordKey === "undefined") {
                var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
                }
                else {
               var recNum = books_object.Heading.Title[i].RecordId.RecordKey;
               //1%2C1%2C
               var recAdd = i+1;
               var rec =  recAdd+"%2C"+recAdd+"%2C";
               var url = urlPrefix+rec;
              }
        $("#books .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
        }
      
        $("#books .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' onclick=\"javascript:_paq.push(['trackPageView', 'View More']);\"><em>View more results...("+count+")</em></a></span>");  
    }
}
//If no results, then display no results found
      if (books_object.PAGEINFO.ENTRYCOUNT === '0') {  
          $("#books .box_results").append("<span class=\"no-res\">No material results were found.  Please try another search in the <a href='http://elibrary.wayne.edu'>Catalog</a></span>");    
      }
}

function Error (response){
    console.log("Error");
    console.log(response);
    }

        });
}
