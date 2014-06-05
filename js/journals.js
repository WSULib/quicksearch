    var json_journals_response = null;
    var journals_object = null;

function journals_query(search_string){
  search_string = search_string.replace(/:|\]|\[/g,'');


$(document).ready(function() {
    dataObject = new Object();
    dataObject.data_type = "xml2json";
    dataObject.encodedURL = 'http://elibrary.wayne.edu/xmlopac/X';
    dataObject.searchTerm = search_string;

$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "../resources/quicksearch/php/journals.php",
        data: dataObject,
        dataType: "json",
        success: Success,
        error: Error
            });
        });

function Success (response){
    //clear previous results
    $("#journals .box_results").empty();
  //  console.log(response);
    // hides loading animation
	$("#journals .box_loading_animation").hide();
    journal_object = new Object();    
    // populate journal_object global variable with bibnumbers

  journal_object = response;
    
function isEmpty(ob){
    for(var i in ob){ return false;}
    return true;
    }

if (journal_object.PAGEINFO.ENTRYCOUNT !== '0') {

  if (journal_object.PAGEINFO.ENTRYCOUNT === '1') {
  count = journal_object.Heading.HeadingSize;
  if ( isEmpty(journal_object.Heading.Title.TitleField) === true) {
    title = "eResource - Click For Title";
  }
  else {         
  title = journal_object.Heading.Title.TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
  }
  var urlPrefix = "http://elibrary.wayne.edu/record=";
  if (typeof journal_object.Heading.Title.RecordId.RecordKey === "undefined") {
  var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
  }
  else {
  var recNum = journal_object.Heading.Title.RecordId.RecordKey;
  var url = urlPrefix+recNum;
  }
  $("#journals .box_results").append("<a href='"+url+"'>"+title+"</a><br/><br/>");
  $("#journals .box_results").append("<br/><span><a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"&searchscope=17'><em>View more results...("+count+")</em></a></span>");  

}

else if (journal_object.PAGEINFO.ENTRYCOUNT === '2'){
    for (var i = 0; i < 2; i++) {
  //make some shortened variables for the data you want to mess with
                count = journal_object.Heading.HeadingSize;
              if (typeof journal_object.Heading.Title[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm === "undefined") {
                  title = "Untitled";         
                }
               else {                
                  title = journal_object.Heading.Title[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
                }
                var urlPrefix = "http://elibrary.wayne.edu/record=";
              if (typeof journal_object.Heading.Title[i].RecordId.RecordKey === "undefined") {
                var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
                }
                else {
               var recNum = journal_object.Heading.Title[i].RecordId.RecordKey;
               var url = urlPrefix+recNum;
              }
        $("#journals .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
        }
        
        $("#journals .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"&searchscope=17'><em>View more results...("+count+")</em></a>");
}

else {
  for (var i = 0; i < 3; i++) {
         //make some shortened variables for the data you want to mess with
                count = journal_object.Heading.HeadingSize;
              if (typeof journal_object.Heading.Title[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm === "undefined") {
                  title = "Untitled";         
                }
               else {                
                  title = journal_object.Heading.Title[i].TitleField.VARFLDPRIMARYALTERNATEPAIR.VARFLDPRIMARY.VARFLD.DisplayForm;
                }
                var urlPrefix = "http://elibrary.wayne.edu/record=";
              if (typeof journal_object.Heading.Title[i].RecordId.RecordKey === "undefined") {
                var url = "http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string;         
                }
                else {
               var recNum = journal_object.Heading.Title[i].RecordId.RecordKey;
               var url = urlPrefix+recNum;
              }
        $("#journals .box_results").append("<div class='indiv-result'><p class='title'><a href='"+url+"'>"+title+"</a></p></div>");
        }
        
        $("#journals .box_results").append("<a href='http://elibrary.wayne.edu/search~/?searchtype=X&searcharg="+search_string+"&searchscope=17'><em>View more results...("+count+")</em></a>");  
    }
  }
//If no results, then display no results found
           if (journal_object.PAGEINFO.ENTRYCOUNT === '0') {  

          $("#journals .box_results").append("<span class=\"no-res\">No Journal results were found.  Please try another search in the <a href='http://elibrary.wayne.edu/search~S17'>Catalog</a></span>");    
      }
}

function Error (response){
    console.log("Error");
    console.log(response);
    }

        });
}