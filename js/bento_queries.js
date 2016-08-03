var local_load = false;
var sessionID=document.cookie.split(";")[0].split("=")[1];
// determine localstorage capabilities
function lsTest(){
    var test = 'test';
    try {
        localStorage.setItem(test, test);
        localStorage.removeItem(test);
        return true;
    } catch(e) {
        return false; 
    }
}


function updatePage(origin){
    // trigger local_load when index.php is loaded
    if (origin == "local"){
        local_load = true;
    }

    if(window.location.hash) {
        // grab query string from URL hash
        var search_string = decodeURIComponent(window.location.hash.split("#")[1].split("=")[1]);
        // tidy up for search box
        search_string = search_string.replace(/%27/g,"'");
        search_string = search_string.replace(/%E9/g,"é");  
        // set input box to query string
        $('#search_string').val(search_string);  
        //$('#search_string').val(search_string).trigger('change');  
        searchPlaceholder();


        // if localStorage available AND cached results exist, queries match, load:                
        if (lsTest() === true && localStorage.getItem("qsCache") !== null && localStorage.getItem("qsQuery") == search_string) {                          
            $("#main.container").html(localStorage.getItem("qsCache"));                        
        }

        // else, perform search
        else {                    
            // unhide and run search on string
            $("#search-results").show();
            searchCall("page_load",origin);
        }
    }            
}

//grab search term(s), run box queries
function searchFunc(type,origin){   

    // blows away cached version
    if(lsTest() === true){ 
        localStorage.clear();
    }
       
    $("#reference").hide();
    $("#lib_hours").hide();
   
    //get search string
    var search_string = $('#search_string').val();

    // encode single quotes with %27
    search_string = search_string.replace(/'/g,"%27");  
    search_string = search_string.replace(/é/g,"%E9");
    //search_string = search_string.replace(/:|\]|\[/g,'');

// set URL - redirect based on origin
     /* 
     UPDATE 12/2014
     Now that lib website header is showing up on other pages (e.g. LibGuides),
     needed to have javascript redirect to library.wayne.edu when NOT on library.wayne
     or library2.wayne.  This checks host, if not equal, rewrites.
     */
     var host = window.location.hostname;    
     if (host != "library.wayne.edu" && host != "library2.wayne.edu"){
         host = "library.wayne.edu";
     }
     host = libraryHost;
     if (local_load == true){
         var redirect_path = ".#q="+encodeURIComponent(search_string);    
     } 
     else {
         //var redirect_path = "http://"+host+"/quicksearch/#q="+encodeURIComponent(search_string);
         var redirect_path = "http://"+host+"/?search="+encodeURIComponent(search_string);
     }
     window.location.href = redirect_path; 
     window.location.hash = "#q="+encodeURIComponent(search_string);

    // push query to Piwik
    if (type != "page_load"){
        Piwik.getAsyncTracker()['trackSiteSearch'](search_string);    
    }    

    //clear previous results
 //   $("#some_content .my_results").empty();

 //   $("#some_content .my_results").append(search_string);

    $(".box_results").empty();

    // turns on animation    
    $(".box_loading_animation").show();

    //run box queries
    lib_hours_query(search_string);
    books_query(search_string);
    journals_query(search_string);
    databases_query(search_string);
    lib_guides_query(search_string);
    site_search_query(search_string);
    digi_collections_query(search_string);
    digi_commons_query(search_string);
    summonjs_query(search_string);
    // other_links();
    spellcheck(search_string);
    bestbet(search_string);
    //relatedSearches(search_string);
}

function searchCall(type,origin){
    setTimeout(function(){
        searchFunc(type,origin);}, 250);
}   

//Utility to pull hrefs from links clicked and push to Piwik
var flag=0, flag_load=0;
var resourceURL,url_search,searchTerm,linkText,category='-1';
$(document).ready(function(){
    // To restrict the page to load only once
    if(flag_load===0)
    {
        // jquery "on" function binds actions to parent (e.g. document), but reacts to children (e.g. anchor tags)
        $('#search-results').on('mousedown', $("a"), function(event){      
            
                // To get the category of the clicked link
                category=$(event.target).closest('div[class^="row-fluid"]').attr('id');
                
                linkText=$(event.target).text();
                searchTerm = decodeURIComponent(window.location.hash.split("#")[1].split("=")[1]);
                dummy_URL = decodeURIComponent(event.target.href);
                var pos = dummy_URL.search("lg.php")

                //If URL is already rewritten then set target href to current URL
                // if(!(pos===63))
                if( dummy_URL.indexOf("lg.php") < 0 )
                {
                    resourceURL=dummy_URL;
                    /*
                    If current host == "library.wayne.edu", then make the host below "quicksearch.library.wayne.edu"
                    */
                    if (location.host == "library.wayne.edu" && location.pathname == "/quicksearch/"){
                        var url_prefix = "http://quicksearch.library.wayne.edu";
                    }
                    else if (location.host == "library2.wayne.edu" && location.pathname == "/quicksearch/"){
                        var url_prefix = "http://quicksearch2.library.wayne.edu";
                    }
                    else {
                        var url_prefix = "php";   
                    }
                    
                    url_search=url_prefix+"/lg.php?url="+resourceURL+"&linkText=\'"+linkText+"\'&searchTerm=\'"+searchTerm+"\'&category="+category;

                    if (category == 'databases') {
                        // alert(searchTerm);
                        url_search=url_prefix+"/lg.php?url="+resourceURL.replace('https://library.wayne.edu/quicksearch/', '')+"&linkText=\'"+linkText+"\'&searchTerm=\'"+searchTerm+"\'&category="+category;
                    }

                    getClicked1(url_search,event);
                }
                else
                {
                    getClicked1(dummy_URL,event);
                }
            
            if (resourceURL != undefined)
            {
                // Manually log a click from the code
                Piwik.getAsyncTracker()['trackLink'](resourceURL,'link');  
            }
        });
        flag_load++;
    }
});

function getClicked1(new_URL,event)
{
    event.target.href=new_URL;
}

// Cache results on click-out IF localStorage available
if(lsTest() === true){
    $(document).ready(function(){
        // jquery "on" function binds actions to parent (e.g. document), but reacts to children (e.g. anchor tags)
        $(document).on('click', $("#main .container a"), function(){                     
            var pageHTML = $("#main.container").html();
            localStorage.setItem('qsCache',pageHTML);
            if (window.location.hash != ""){
                localStorage.setItem('qsQuery',decodeURIComponent(window.location.hash.split("#")[1].split("=")[1]))                    
            }
        });
    });
}




