var books_object = null;
var books_removed = null;
var books_sorted = null;
var count = null;

function books_query(search_string){


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
//compare books_object against journals_object to look for duplicate bibnumbers
//1)look only at bibnumber in books_object and make sure to avoid titles that are arrays
//2)when it's set, then compare these bibnumbers
//3)delete in the books_object array entries that match and push this to a new books_object array that has the validated results

//credit for array comparison goes to gits on bytes.com
//for full code and his excellent article, please see http://bytes.com/topic/javascript/insights/699379-optimize-loops-compare-two-arrays
for (var i = 0; i < 12; i++) {
var journals = journals_object;
// if (books_object.Heading.Title instanceof Array) {
var books = [books_object.Heading.Title[i].RecordId.RecordKey];
// }
// else {
// var books = [books_object.Heading.Title.RecordId.RecordKey];  
// }
var lookup = {};
 
for (var j in journals) {
    lookup[journals[j]] = journals[j];
}
 
for (var b in books) {
    if (typeof lookup[books[b]] != 'undefined') {
        // var books_lookup = books[b];
        // alert('found ' + books[b] + ' in both lists');
        bibmatches(i);

function bibmatches(i) {
  //i is what needs to tell it to be deleted
books_removed = delete books_object.Heading.Title[i];
// books_reordered =
}
        break;
    } 
}

}
for (var i = 0; i < 12; i++) {
  if (typeof books_object.Heading.Title[i] == 'undefined') {
  }
  else {
if (books_object.Heading.Title[i].MatType.MatTypeLong == "E-JOURNAL") {
  var books_ejournal_remove = delete books_object.Heading.Title[i];
}
else {
  continue;
}
}
}

books_sorted = books_object.Heading.Title.sort();
for (var i = 0; i < 2; i++) {
//           //make some shortened variables for the data you want to mess with
                count = books_object.Heading.HeadingSize;
                if (typeof books_sorted[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm === "undefined") {
                  title = "Untitled";         
                }
                else {                
                  title = books_sorted[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
                }
                var urlPrefix = "http://elibrary.wayne.edu/record=";
               if (typeof books_sorted[i].RecordId.RecordKey === "undefined") {
                var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
                }
                else {
               var recNum = books_sorted[i].RecordId.RecordKey;
               var url = urlPrefix+recNum;
              }

                // if (typeof books_sorted[i].BibImage.BibImageThumb === "undefined") {
                // alert ("a");                  
                //   var image = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/WSUebook/content";
                // }
                // else {
                // var image = books_sorted[i].BibImage.BibImageThumb;
                // }
                //                 console.log(image);
          // check to see that there is a title

          //check to see that there is a link to send a user to

          //plunk the data into the books box
        $("#books .box_results").append("<div id='result"+i+"' class=result_div></div>");
        $("#books .box_results").append("<a href='"+url+"' target='_blank'>"+title+"</a><br/>");
        // imageInsert(response, i);
        }
        $("#books .box_results").append("<br/><span><a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"' target='_blank'><em>View more results...("+count+")</em></a></span>");  
//If no results, then display no results found
      if (count = 0) {  
          $("#books .box_results").append("<span>No Results Found.</span>");    
      }
}
function imageInsert (books_sorted, i) {
//check to see that the cover exists; if not, put placehoder image from Fedora Commons
// if (response.Heading.Title.length > 1) {
   	// var image = response.Heading.Title[1].BibImage.BibImageThumb;
	// }
// else {
   	// var image = response.Heading.Title.BibImage.BibImageThumb;
	// }

                if (typeof books_sorted[i].BibImage.BibImageThumb == "undefined") {                  
                  var image = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/WSUebook/content";
                }
                else {
                var image = books_sorted[i].BibImage.BibImageThumb;
                } 

var width=0, height=0;
$("<img/>")
    .attr("src", "image")
    .load(function() {
        w = this.width;
        h = this.height;
        if (w == 1 && h == 1) {
		$("#result"+i).append("<img src='http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/WSUebook/content' width='65'>");        	
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
