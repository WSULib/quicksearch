   // FILE:          lib_hours.js
   // TITLE:         Library Hours Module
   // CREATED:       September 2013
   //
   // PURPOSE:
   // When receiving a string that include hours and one of the words/phrases in the objects below, it makes an ajax call and then parses and appends the appropriate results to the lib_hours id.
   // it does not depend on any other files
   //
   // OVERALL METHOD:
   // 1. receives a string that includes hours and a word/phrase in the libSingleWord or libMultiWord objects below
   // 2. makes an ajax call to a php script called lib_hours.php for the cache daily hours
   // 3. appends results to the lib_hours id
   //
   // FUNCTIONS:
   // lib_hours_query
   // ajaxCall
   // processData
   // 
   // 
   // How To Update:
   // 1. update the libSingleWord and libMultiWord objects when you need to add or remove a building users might search for.  
   // 2. Add the search term/phrase as property and the matching 3 letter extension (which matches how the daily hours cache denotes them) as its value
   // 3. If adding or working shiffman hours, don't forget that Shiffman's hours are really a combination of maruzek and applebaum hours and if someone searches for shiffman, they want both (i.e. see why the designation med was added)
   // 4. Hash object contains the full names of each library/resource area and correspondes to the library hours caches 3 letter designation. Modify as needed.



//GLOBAL objects
var libHoursJSON = null;
var libSingleWord = {"pk": "pk", "p.k.": "pk", "purdy": "pk", "kresge": "pk", "oakland": "oak", "macomb": "mac", "undergraduate": "ugl", "undergrad": "ugl", "ugl": "ugl", "neef": "law", "law": "law", "commons": "maz", "maruzek": "maz", "applebaum": "app", "lrc": "app", "shiffman": "med", "medical": "med", "med": "med"};
var libMultiWord = {"purdy kresge": "pk", "p k": "pk", "p. k. ": "pk", "neef law": "law", "shiffman medical": "med", "law library": "law", "medical library": "med", "purdy kresge library": "pk", "ugl library": "ugl", "undergrad library": "ugl", "undergraduate library": "ugl"};
var Hash = {"pk": "Purdy Kresge Library", "ugl": "Undergraduate Library", "law": "Arthur Neef Law Library", "maz": "Shiffman/Maruzek Medical Education Commons", "app": "Shiffman/Applebaum LRC Pha/HS", "oak": "Oakland Center Library Resource Desk", "esc": "Extended Study Center", "mac": "Macomb Center Library Resource Desk"};
var combo = $.extend({},libSingleWord,libMultiWord);

//Step 1
function lib_hours_query(search_string){
	var search_string = search_string.toLowerCase();
	//clear previous results
     $("#lib_hours .box_results").empty();

    if (search_string.indexOf('hours') >= 0) {
    	// hides loading animation
		$("#lib_hours .box_loading_animation").hide(); 

 		var patt = /^library hours$/;
		if (patt.test(search_string) == true) {
				ajaxCall(search_string,"library");
				return;
    	}

    	else {
    		//If a multi-word, look at the whole string
    		var str = search_string;
    		str = str.replace(" hours", "");
    		for (var i = 0; i < 1; i++) {
				for (var key in libMultiWord) {
					if (str == key) {
						var terms = str;
						if (libMultiWord[key] == "med") {
							ajaxCall(terms,"med");
							return;
						} 
					else {
						ajaxCall(terms,"multi");
						return;
					}
					}
				}
				}

			//If not a multi-word, split according to whitespace
			var splitTerms = str.split(" ");
			for (var i = 0; i < splitTerms.length; i++) {
				for (var key in libSingleWord) {
					if (splitTerms[i] == key) {
						if (libSingleWord[key] == "med") {
							ajaxCall(key,"med");
							return;
						} 
					else {
						ajaxCall(key,"single");
						return;
					}
					}
				}
			}
    	}
	}
    // else { 
    // 	return;
    // }
}


//Step 2
function ajaxCall(libName,libDesignation) {

	$(document).ready(function(){
	     	$.ajax({
			type: "POST",
			cache: false,
			url: "php/lib_hours.php",
			dataType: "json",
			success: function(response) {
				processData(response, libName, libDesignation);
			}
			});
		});
}

//Step 3
function processData(response,libName, libDesignation) {
	libHoursJSON = response;
	if (libDesignation == "library") {
	for (var key in libHoursJSON) {
		$("#lib_hours .box_results").append("<h4>"+Hash[key]+"</h4><p>"+libHoursJSON[key]+"<p>");
	}
	}
	else {
		if (libDesignation == "med") {
			for (var key in combo) {
				if (combo[key] == "med") {
					$("#lib_hours .box_results").append("<h3>"+Hash['maz']+"</h3><p>"+libHoursJSON['maz']+"<p>");
					$("#lib_hours .box_results").append("<h3>"+Hash['app']+"</h3><p>"+libHoursJSON['app']+"<p>");
					return;
				}
			}
		}
		else {	
			if (libDesignation == "multi") {
				for (var key in libMultiWord) {
					if (libName == key) {
						$("#lib_hours .box_results").append("<h3>"+Hash[libMultiWord[key]]+"</h3><p>"+libHoursJSON[libMultiWord[key]]+"<p>");					
					}
				}
			}
			else if (libDesignation == "single") {
				for (var key in libSingleWord) {
					if (libName == key) {
						$("#lib_hours .box_results").append("<h3>"+Hash[libSingleWord[key]]+"</h3>"+"<p>"+libHoursJSON[libSingleWord[key]]+"</p>");
					}
				}
			}
			}
	}
}
