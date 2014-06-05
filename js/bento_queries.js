function updatePage(){
    if(window.location.hash) {
        // grab query string from URL hash
        var search_string = decodeURIComponent(window.location.hash.split("#")[1].split("=")[1]);
        // tidy up for search box
        search_string = search_string.replace(/%27/g,"'");
        search_string = search_string.replace(/%E9/g,"é");

        // set input box to query string
        $('#search_string').val(search_string);
        // unhide and run search on string
        $("#search-results").show();
        searchCall("page_load");
    }
    else {
  //    console.log('no hash, loading blank');
    }
    
}

//grab search term(s), run box queries
function searchFunc(type){
       
   $("#reference").hide();
   $("#lib_hours").hide();

   
    //get search string
    var search_string = $('#search_string').val();

    // encode single quotes with %27
    search_string = search_string.replace(/'/g,"%27");  
    search_string = search_string.replace(/é/g,"%E9");
    //search_string = search_string.replace(/:|\]|\[/g,'');

    // set URL has to query string
    window.location.href = "/quicksearch#q="+encodeURIComponent(search_string); // for library.wayne
    window.location.hash = "#q="+encodeURIComponent(search_string);

    // push query to Piwik
    if (type != "page_load"){
        Piwik.getAsyncTracker()['trackSiteSearch'](search_string);    
    }
    

    //clear previous results
    $(".box_results").empty();

    // turns on animation
    // $(".box_loading_animation").fadeToggle();
    $(".box_loading_animation").show();

    //run box queries
    lib_hours_query(search_string);
    books_query(search_string);
    journals_query(search_string);
    databases_query(search_string);
    lib_guides_query(search_string);
    site_search_query(search_string);
   // digi_collections_query(search_string);
    digi_commons_query(search_string);
    summonjs_query(search_string);

}

function searchCall(type){
    setTimeout(function(){
        searchFunc(type);}, 250);

}
   

//Utility to pull hrefs from links clicked and push to Piwik
$(document).ready(function(){
    // jquery "on" function binds actions to parent (e.g. document), but reacts to children (e.g. anchor tags)
    $(document).on('click', $("a"), function(event){            
        var resourceURL = event.target.href;
        // push to Piwik
        if (resourceURL != undefined){
            Piwik.getAsyncTracker()['trackLink'](resourceURL,'link');    
        }        
    });
});