//grab search term(s), run box queries
function searchFunc(term){    

    //get search string
    var search_string = $('#search_string').val();    

    //clear previous results
    $(".box_results").empty();

    // turns on animation
    // $(".box_loading_animation").fadeToggle();
    $(".box_loading_animation").show();

    //run box queries
    lib_hours_query(search_string);
    articles_query(search_string);
    books_query(search_string);
    journals_query(search_string);
    databases_query(search_string);
    lib_guides_query(search_string);
    site_search_query(search_string);
    digi_collections_query(search_string);
    digi_commons_query(search_string);    

}

function searchCall(){
    setTimeout(function(){
        searchFunc();}, 250);
}
