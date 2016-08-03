function digi_collections_query(search_string) {

    // ajax attempt
    dataObject = new Object();
    dataObject.q = search_string
    dataObject.start = "0";
    dataObject.rows = "3"; //returns only three results
    dataObject.wt = "json"; //sets response to JSON   
    dataObject['functions[]'] = "solrSearch";

    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "https://digital.library.wayne.edu/WSUAPI?",
            data: dataObject,
            dataType: "json",
            success: digi_collections_success,
            error: digi_collections_ajax_error
        });
    });

    function digi_collections_success(response) {

        //clear previous results
        $("#digi_collections .box_results").empty();
        // hides loading animation
        $("#digi_collections .box_loading_animation").hide();


        /*&& response.solrSearch.error == undefined*/



        // if (
        //     (response.solrSearch.response != undefined || response.solrCoreGeneric.response != undefined)
        //     &&
        //     (response.solrSearch.response.docs.length > 0 || response.solrCoreGeneric.response.docs.length > 0)
        //     ) {

        if (response.solrSearch != undefined) {
            var responseSolrType = 'solrSearch';
        } else {
            var responseSolrType = 'solrCoreGeneric';
        }

        if (response[responseSolrType].response != undefined && response[responseSolrType].response.docs.length > 0) {

            for (var i = 0; i < response.solrSearch.response.docs.length; ++i) {
                // get PID and title
                var PID = response.solrSearch.response.docs[i].id;
                if (typeof response.solrSearch.response.docs[i].dc_title === 'undefined') {
                    var title = "[unknown title]";
                } else {
                    var title = response.solrSearch.response.docs[i].dc_title[0];
                }
                // get content model as type
                var type = response.solrSearch.response.docs[i].rels_hasContentModel[0];
                type = type.substring(type.lastIndexOf(":") + 1, type.length);



                //var collection = response.solrSearch.response.docs[i].rels_isMemberOfCollection[0];

                // append to DOM
                $("#digi_collections .box_results").append("<div id='digiCollections_" + i + "' class='indiv-result'></div>");
                $("#digiCollections_" + i).append("<div class='dc-img'><a href='https://digital.library.wayne.edu/digitalcollections/item?id=" + PID + "'><img class='mime_icon' style='width:100%' src='https://digital.library.wayne.edu/loris/fedora:" + PID + "%7CTHUMBNAIL/full/full/0/default.jpg' /></a></div>");
                $("#digiCollections_" + i).append('<div class="dc-left" style="margin-right:50%;"></div>');
                $("#digiCollections_" + i + " .dc-left").append("<a class='title' href='https://digital.library.wayne.edu/digitalcollections/item?id=" + PID + "'>" + title + " [" + type + "]</a>");
                if (response.solrSearch.response.docs[i].mods_abstract_ms !== undefined) {
                    var abstract = response.solrSearch.response.docs[i].mods_abstract_ms[0];
                    abstract = abstract.length > 200 ? abstract.substring(0, 200) + '...' : abstract;
                    $("#digiCollections_" + i + " .dc-left").append('<div style="word-wrap: break-word;">' + abstract + '</div>');
                }
                if (response.solrSearch.response.docs[i].rels_isMemberOfCollection !== undefined && response.solrSearch.response.docs[i].mods_host_title_ms !== undefined) {
                    var collection = response.solrSearch.response.docs[i].rels_isMemberOfCollection[0];
                    collection = collection.replace('info:fedora/', '');
                    //alert(collection);
                    var collectionFull = response.solrSearch.response.docs[i].mods_host_title_ms[0];
                    $("#digiCollections_" + i + " .dc-left").append('<div style="word-wrap: break-word;"><span style="display:inline-block;width:80px;color:#888;">Collection: </span><a href="https://digital.library.wayne.edu/digitalcollections/item?id=' + collection + '">' + collectionFull + '</a></div>');
                }
                if (response.solrSearch.response.docs[i].mods_key_date_year !== undefined) {
                    var dateMain = response.solrSearch.response.docs[i].mods_key_date_year[0];
                    $("#digiCollections_" + i + " .dc-left").append('<div style="word-wrap: break-word;"><span style="display:inline-block;width:80px;color:#888;">Date: </span>' + dateMain + '</div>');
                }
                if (response.solrSearch.response.docs[i].dc_type != undefined) {
                    var contentType = response.solrSearch.response.docs[i].dc_type[0];
                    $("#digiCollections_" + i + " .dc-left").append('<div style="word-wrap: break-word;"><span style="display:inline-block;width:80px;color:#888;">Type: </span>' + contentType + '</div>');
                }
                //$("#digiCollections_"+i).append('<div style="word-wrap: break-word;">' + collection + '</div>');
            }

            //more results
            $("#digi_collections .box_results").append("<p><a href='https://digital.library.wayne.edu/digitalcollections/search.php?q=" + search_string + "'><em>View more results... <span style='font-style:normal;'>(" + response.solrSearch.response.numFound + ")<span></em></a></p>");
        } else {
            //$("#digi_collections .box_results").append('<div class="no-res">No results found. Try another search in <a href="http://elibrary.wayne.edu/search~S5">Catalog</a></div>');
            //$("#digi_collections .box_results").append('<div class="no-res">No results found. Try another search in <a href="http://elibrary.wayne.edu/search~/?searchtype=X&searcharg=' +search_string+ '&searchscope=5&SORT=D&submit=Search">Catalog</a></div>');
            $("#digi_collections .box_results").append('<div class="no-res">No results found. Try another search in <a href="https://digital.library.wayne.edu/digitalcollections/search.php?q=' +search_string+ '">Digital Collections</a></div>');

        }
    }

    function digi_collections_ajax_error(response) {
        // attempt PHP tunnel for when cross-domain ajax fails (< IE8)

        // ajax with PHP tunnel        
        dataObject = new Object();
        dataObject.q = search_string
        dataObject.start = "0";
        dataObject.rows = "3"; //returns only three results
        dataObject.wt = "json"; //sets response to JSON
        dataObject['function'] = "solrSearch";
        dataObject['baseURL'] = "https://digital.library.wayne.edu/WSUAPI?";

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "php/digital_library_tunnel.php",
                data: dataObject,
                dataType: "json",
                success: digi_collections_success,
                error: digi_collections_critical_error
            });
        });
    }

    function digi_collections_critical_error() {
        console.log("Digital Collections Critical Error, fallback method unsuccessful.");
    }

}