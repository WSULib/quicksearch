//GLOBAL VARIABLES/////////////////////////////////////////////////////////////////////////////////////////////////////
//set global object of PIDS
var uploadStatusObj = new Object();
var PIDsObj = new Object();
PIDsObj.selected = new Array();
PIDsObj.selected_tmp = new Array();
PIDsObj.batchUpload = new Array();
toRun = null;
repo_baseURL = "http://141.217.172.153";

//POST-LAUNCH/////////////////////////////////////////////////////////////////////////////////////////////////////
//load PIDsObj from cookie, repopulate selected list
$(document).ready(function(){

    // console.log("Cookie Objects params:",$.cookie('PIDsObjSelected'));

    //check for PIDsObj cookie
    //should check if NOT containing the lists...
    if ($.cookie('PIDsObjSelected') === undefined) { 
        // PIDsObj = new Object();
        // PIDsObj.selected = new Array();
        // PIDsObj.batchUpload = new Array();        
        $.cookie('PIDsObjSelected', JSON.stringify(PIDsObj.selected));
        console.log('created new cookie');
    }

    else{
        console.log('loading previously constructed PIDsObjSelected cookie');
        // console.log("cooke obj:",$.cookie("PIDsObj"))        
        PIDsObj.selected = $.parseJSON($.cookie("PIDsObjSelected"));
        // console.log(PIDsObj);              
        if (PIDsObj.selected.length > 0){
            for (var i = 0; i < PIDsObj.selected.length; ++i){
                $("#currSelect").append("<li><a href='http://141.217.172.153/fedora/objects/"+PIDsObj.selected[i]+"/' target='_blank'>"+PIDsObj.selected[i]+"</a></li>");
            }
        }
    }    
})



//FUNCTIONS/////////////////////////////////////////////////////////////////////////////////////////////////////
//repo description table extract
function repoDescribe(){
    var postData = new Object();
      var HTMLcatch = null;
      var elements = null;
      postData.encodedURL = 'http://localhost/fedora/describe';
      postData.data_type = 'html';
      console.log(postData);

      $(document).ready(function(){
        $.ajax({
          type: "POST",
          url: "php/ajax_tunnel.php",
          data: postData,
          dataType: "html",
          success: function(response){
            HTMLcatch = response;
            elements = $(HTMLcatch);
            var HTMLtables = $("table",elements[5]);
            var describeTable = HTMLtables[1];
            $("#dashboard").append(describeTable);
          }
        });
      });
}

//load view
function loadView(view,dest,clear){
    //clear top and bottom views based on "toClear" parameter
    if (clear == 'both'){
        $("#topView, #bottomView").empty();
    }
    if (clear == 'topView'){
        $("#topView").empty();
    }
    if (clear == 'bottomView'){
        $("#bottomView").empty();
    }


    //relative to index.htm
    var viewLocation = "views/"+view+".htm";

    //load view based on destination
    if (dest == "topView"){
        $("#topView").load(viewLocation);
    }
    if (dest == "bottomView"){
        $("#bottomView").load(viewLocation);    
    }
}

//returns PIDs
function RDFQuery(){

    //empty selected_tmp array
    PIDsObj.selected_tmp = [];

    //reveal results first, for dramatic effect
    // $("#selected").hide();
    $("#results").fadeIn();
    $("#results_list").empty();

    var itql_predicate = $('#itql_predicate').val();
    var itql_object = $('#itql_object').val();

    // console.log(itql_predicate,itql_object);

    $(document).ready(function() {
        // test url
        dataObject = new Object();

        dataObject.data_type = "json";
        var baseURL = "http://localhost/fedora/risearch?";
        var queryOptions = "type=tuples&lang=itql&format=json&dt=on&stream=on&query=";
        var baseQuery = "select $subject from <#ri> where $subject <fedora-rels-ext:"+itql_predicate+"> <info:fedora/"+itql_object+">;";
        dataObject.encodedURL = baseURL + queryOptions + encodeURIComponent(baseQuery);    
        console.log(dataObject.encodedURL);    

        //returns json
        $(document).ready(function(){
          $.ajax({
            type: "POST",
            url: "php/ajax_tunnel.php",
            data: dataObject,
            dataType: "json",
            success: pull_PIDsSuccess,
            error: pull_PIDsError
          });
        });

        function pull_PIDsSuccess(response){
            
            // pushses PIDs to PIDsObj
            PIDsObj.queryResults = response;
            
            //iterates through and creates checkboxes to select PIDs
            for (var i = 0; i < PIDsObj.queryResults.results.length; ++i){                
                var PID = PIDsObj.queryResults.results[i].subject
                var PIDpretty = $.trim(PIDsObj.queryResults.results[i].subject.split('/')[1]);                
                $("#results_list").append("<li><input class='result_checkbox' type='checkbox' name='PIDcheckbox[]' value='"+PIDpretty+"'><a target='_blank' href='http://141.217.172.153/fedora/objects/"+PIDpretty+"'>"+PIDpretty+"</a></input></li>");
            }
            
        }

        function pull_PIDsError(){
            alert('there was an error');
        }

    });
}

//Extended PID(s) query
function extended_RDFQuery(type){

    //empty results
    // $("#selected").hide();
    // $("#results").fadeIn();
    // $("#results_list").empty();

    //drill-down
    if (type === 'drilldown'){        
        var to_query = $('#ext_results_list input:checked')
        $("#ext_results_list").empty();        
    }

    //first extended query
    else {
        var to_query = $('#results_list input:checked')
        $("#ext_results_list").empty();
    }

    //first extended, get all currently selected PIDs from primary query results
    $(to_query).each(function() {

        var itql_predicate = $('#extended_predicate').val();
        //this should be the checked PID in the iteration
        var itql_object = $(this).val($(this).val())[0].value;
        console.log("Extended search PID:",itql_object);

        $(document).ready(function() {
            // test url
            console.log("running extended query");
            dataObject = new Object();

            dataObject.data_type = "json";
            var baseURL = "http://localhost/fedora/risearch?";
            var queryOptions = "type=tuples&lang=itql&format=json&dt=on&stream=on&query=";
            var baseQuery = "select $subject from <#ri> where $subject <fedora-rels-ext:"+itql_predicate+"> <info:fedora/"+itql_object+">;";
            dataObject.encodedURL = baseURL + queryOptions + encodeURIComponent(baseQuery);    
            console.log(dataObject.encodedURL);    

            //returns json
            $(document).ready(function(){
              $.ajax({
                type: "POST",
                url: "php/ajax_tunnel.php",
                data: dataObject,
                dataType: "json",
                success: pull_PIDsSuccess,
                error: pull_PIDsError
              });
            });

            function pull_PIDsSuccess(response){
                
                // pushses PIDs to PIDsObj
                PIDsObj.queryResults = response;
                
                //iterates through and creates checkboxes to select PIDs
                for (var i = 0; i < PIDsObj.queryResults.results.length; ++i){                
                    var PID = PIDsObj.queryResults.results[i].subject
                    var PIDpretty = $.trim(PIDsObj.queryResults.results[i].subject.split('/')[1]);                
                    $("#ext_results_list").append("<li><input class='result_checkbox' type='checkbox' name='PIDcheckbox[]' value='"+PIDpretty+"'><a target='_blank' href='http://141.217.172.153/fedora/objects/"+PIDpretty+"'>"+PIDpretty+"</a></input></li>");
                }                
            }

            function pull_PIDsError(){
                alert('there was an error');
            }
        
        });
    }); //closes iteration through selected_tmp
}

function solrQuery(){

    //empty selected_tmp array
    PIDsObj.selected_tmp = [];

    //reveal results first, for dramatic effect
    $("#selected").hide();
    $("#results").fadeIn();
    $("#results_list").empty();

    dataObject = new Object();
    //get values from form
    dataObject.GETparams = new Object();
    dataObject.GETparams.core = $('#core').val();
    dataObject.GETparams.q = $('#q').val();
    dataObject.GETparams.fq = $('#fq').val();
    dataObject.GETparams.fl = $('#fl').val();
    dataObject.GETparams.start = $('#start').val();
    dataObject.GETparams.rows = $('#rows').val();
    dataObject.GETparams.wt = "json"; //sets response to JSON    
    //datatype, request
    dataObject.data_type = "unfiltered"; //json expected, unfiltered
    dataObject.request_type = "GET";
    //assemble URL
    dataObject.baseURL = "http://localhost/solr4/"+dataObject.GETparams.core+"/select?";        
    
    // console.log(dataObject);
    
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: "php/ajax_tunnel_v2.php",
        data: dataObject,
        dataType: "json",
        success: SolrSuccess,
        error: SolrError
      });
    });

    function SolrSuccess(response){
        //console.log(response);
        PIDsObj.queryResults = response;

        //add conditional for NO responses

        for (var i = 0; i < PIDsObj.queryResults.response.docs.length; ++i){                
            var PID = PIDsObj.queryResults.response.docs[i].id;
            if (typeof PIDsObj.queryResults.response.docs[i].mods_title_ms === 'undefined'){                
                var title = "[unknown title]";                
            }
            else{                
                var title = PIDsObj.queryResults.response.docs[i].mods_title_ms[0];
            }            
            $("#results_list").append("<li><input class='result_checkbox' type='checkbox' name='PIDcheckbox[]' value='"+PID+"'><a target='_blank' href='http://141.217.172.153/fedora/objects/"+PID+"'>"+PID+" - "+title+"</a></input></li>");
        }

    }

    function SolrError(response){
        console.log('no dice');
    }
}

//purge object
function selectPIDs(locale){    
    
    //some selection
    if ($('#'+locale+' input:checked').length > 0){
        
        // $("#results").hide();
        // $("#selected_list").empty();
        $("#selected").fadeIn();
        //each
        $('#'+locale+' input:checked').each(function() {
            // To pass this value to its nearby hidden input
            var eachPID = $(this).val($(this).val())[0].value;
            eachPID = $.trim(eachPID);            
            PIDsObj.selected.push(eachPID);
            PIDsObj.selected_tmp.push(eachPID);

            //then push to selected_list
            $("#selected_list").append("<li>"+eachPID+"</li>");
            $("#currSelect").append("<li>"+eachPID+"</li>");
        });    

        //show extended_selection (SHOULD HAPPEN AFTER SELECTION)
        $("#extended_selection").fadeIn();
    }
    //no selection
    else{
        alert('nothing selected!');
    }
}

function purgePIDs(type){

    //global variable
    PIDsObj.purgedPIDs = [];

    //success function
    function purgePIDSuccess(response,status){
        console.log(response);
        $("#export_results").append("<p>Object Purged!</p>");
    }

    //failure function
    function purgePIDError(response,status){
        $("#export_results").append("<p>Could not purge, errors were had.</p>");
    }

    if (type == "all"){

        var count = 0;
        for (var i = 0; i < PIDsObj.selected.length; ++i){

            $(document).ready(function() {
                
                dataObject = new Object();

                var baseURL = "http://localhost/fedora/objects/";
                var queryOptions = PIDsObj.selected[i];
                PIDsObj.purgedPIDs.push(PIDsObj.selected[i]);
                dataObject.encodedURL = baseURL + queryOptions
                console.log(dataObject.encodedURL);    

                //purges object
                $(document).ready(function(){
                  $.ajax({
                    type: "POST",                    
                    url: "php/purgeObject.php",
                    data: dataObject,
                    dataType: "html",
                    success: purgePIDSuccess,
                    error: purgePIDError
                  });
                });
            });

            //remove PIDs from currently selected
            if(i == PIDsObj.selected.length - 1 ) {                
                deselectPIDs();
            }
        }
    }

    if (type == "selected"){
        var toPurge = [];
        //iterate through and remove from PIDsObj, then populate at left
        $('input:checked').each(function() {
            // To pass this value to its nearby hidden input

            var eachPID = $(this).val($(this).val())[0].value;
            eachPID = $.trim(eachPID);            
            toPurge.push(eachPID);

            //create dataObject for Ajax call
            dataObject = new Object();

            var baseURL = "http://localhost/fedora/objects/";
            var queryOptions = eachPID;
            PIDsObj.purgedPIDs.push(eachPID);
            dataObject.encodedURL = baseURL + queryOptions
            console.log(dataObject.encodedURL);    

            //purges object
            $(document).ready(function(){
              $.ajax({
                type: "POST",
                // url: "ajax_tunnel.php",
                url: "php/purgeObject.php",
                data: dataObject,
                dataType: "html",
                success: purgePIDSuccess,
                error: purgePIDError
              });
            });

            //remove PIDs from currently selected
            //THIS WILL BE TRICKIER, NEED TO CHECK THE ACTUAL PID TO REMOVE, NOT ALL OF THEM
            
        });
    }
}

function exportPIDs(type){

    //global variable
    PIDsObj.exportedPIDs = [];

    //get export type
    var e = document.getElementById("export_type");
    var export_type = e.options[e.selectedIndex].value;

    //success function
    function exportPIDSuccess(response,status){
        $("#export_results").append("<p>Great Success!</p>");

    }

    //failure function
    function exportPIDError(response,status){
        $("#export_results").append("<p>Could not export, errors were had.  See below</p>");

    }

    // if (type == "all"){

    //     var count = 0;
    //     for (var i = 0; i < PIDsObj.selected.length; ++i){

    //         $(document).ready(function() {
                
    //             dataObject = new Object();

    //             dataObject.data_type = "xml";
    //             var baseURL = "http://localhost/fedora/objects/"+PIDsObj.selected[i]+"/export?";
    //             PIDsObj.exportedPIDs.push(PIDsObj.selected[i]);
    //             var queryOptions = "context="+export_type;
    //             dataObject.encodedURL = baseURL + queryOptions;
    //             dataObject.PID = PIDsObj.selected[i];    
    //             console.log(dataObject.encodedURL);    

    //             //returns json
    //             $(document).ready(function(){
    //               $.ajax({
    //                 type: "POST",
    //                 url: "php/exportObject.php",
    //                 data: dataObject,
    //                 dataType: dataObject.data_type,
    //                 success: exportPIDSuccess,
    //                 error: exportPIDError

    //               });
    //             });               

    //         });
    //     }
    // }

    if (type == "selected"){
        var toExport = [];
        //iterate through and remove from PIDsObj, then populate at left
        $('input:checked').each(function() {
            // To pass this value to its nearby hidden input

            var eachPID = $(this).val($(this).val())[0].value;
            eachPID = $.trim(eachPID);            
            toExport.push(eachPID);

            //create dataObject for Ajax call
            dataObject = new Object();

            dataObject.data_type = "xml";
            var baseURL = "http://localhost/fedora/objects/"+eachPID+"/export?";
            PIDsObj.exportedPIDs.push(eachPID);
            var queryOptions = "context="+export_type;
            dataObject.encodedURL = baseURL + queryOptions;
            dataObject.PID = eachPID;

            //exports object, returns json
            $(document).ready(function(){
              $.ajax({
                type: "POST",
                url: "php/exportObject.php",
                data: dataObject,
                dataType: dataObject.data_type,
                success: exportPIDSuccess,
                error: exportPIDError
              });
            });

            //update exported list at left
        });
    }
}

//generic upload form helper
//REMOVE, OR MAKE GENERIC, THE UN-DISABLING OF BUTTONS...
function uploadForm(){

    //clear previously uploaded item list
    PIDsObj.batchUpload = [];
        
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#upload_status');
       
    $('form').ajaxForm({
        beforeSend: function() {
            $("#uploaded_batch").empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
            //console.log(percentVal, position, total);
        },
        complete: function(xhr) {
            uploadStatusObj = JSON.parse(xhr.responseText);
            for (var i = 0; i < uploadStatusObj.myfile.name.length; ++i){
                var filename = uploadStatusObj.myfile.name[i];
                $("#uploaded_batch").append("<li>"+filename+"</li>");
                PIDsObj.batchUpload.push(filename);
            }            
            $("#batchIngestButton").removeClass('disabled');
            $("#batchIngestButton").addClass('btn-success');
        }
    });    
}

function ingestBatch(e){ //where e is the button

    if (e.hasClass('disabled') == true){
        alert('batch upload incomplete or not issued, nothing to ingest.');
        return;
    }

    else{
        function ingested(response){
            console.log(response);
            $("#status").append("<span>"+response+"</span></br></br>");
        }

        dataObject = new Object();
        console.log(PIDsObj.batchUpload);

        for (var i = 0; i < PIDsObj.batchUpload.length; ++i){

            // console.log(PIDsObj.batchUpload[i]);    
            var baseURL = "http://localhost/fedora/objects/new";        
            dataObject.filename = PIDsObj.batchUpload[i];
            dataObject.encodedURL = baseURL;
            dataObject.sourceDir = 'uploads/FOXML';
            console.log(dataObject.encodedURL, dataObject.filename);    

            //ingest object
            $(document).ready(function(){
              $.ajax({
                type: "POST",
                // url: "ajax_tunnel.php",
                url: "php/ingestObject.php",
                data: dataObject,
                // dataType: "html",
                success: ingested
              });
            });
            
        }
    }
}

function ingestAllUploads(){
    function ingested(response){
        console.log(response);
        $("#status").append("<span>"+response+"</span></br></br>");
    }

    //create new array in PIDsObj with list of uploaded files
    PIDsObj.allUpload = [];    
    var upload_items = $("#currUpload li");

    if (upload_items.length > 0){

        for (var i = 0; i < upload_items.length; ++i){
            PIDsObj.allUpload.push( $("#upload"+i).html() );
        }

        dataObject = new Object();    

        for (var i = 0; i < PIDsObj.allUpload.length; ++i){
            
            var baseURL = "http://localhost/fedora/objects/new";
            dataObject.sourceDir = 'uploads/FOXML';        
            dataObject.filename = PIDsObj.allUpload[i];
            dataObject.encodedURL = baseURL;
            console.log(dataObject.encodedURL, dataObject.filename);    

            //ingest object
            $(document).ready(function(){
              $.ajax({
                type: "POST",
                // url: "ajax_tunnel.php",
                url: "php/ingestObject.php",
                data: dataObject,
                // dataType: "html",
                success: ingested
              });
            });        
        }
    }
    else{
        // alert('nothing to ingest, upload directory empty (or refresh');
        $("#status").append("<span style='color:red;'>nothing to ingest, upload directory empty (or try refreshing the page)</span>");
    }
}

function ingestAllExports(){
    function ingested(response){
        console.log(response);
        $("#status").append("<span>"+response+"</span></br></br>");
    }

    //create new array in PIDsObj with list of uploaded files
    PIDsObj.allExports = [];    
    var upload_items = $("#currExport li");
    console.log(upload_items);

    if (upload_items.length > 0){

        for (var i = 0; i < upload_items.length; ++i){
            PIDsObj.allExports.push( $("#uploadExport"+i).html() );
        }

        dataObject = new Object();    

        for (var i = 0; i < PIDsObj.allExports.length; ++i){
            
            var baseURL = "http://localhost/fedora/objects/new";
            dataObject.sourceDir = 'exports/FOXML';        
            dataObject.filename = PIDsObj.allExports[i];
            dataObject.encodedURL = baseURL;
            console.log(dataObject.encodedURL, dataObject.filename);    

            //ingest object
            $(document).ready(function(){
              $.ajax({
                type: "POST",
                // url: "ajax_tunnel.php",
                url: "php/ingestObject.php",
                data: dataObject,
                // dataType: "html",
                success: ingested
              });
            });        
        }
    }
    else{
        // alert('nothing to ingest, upload directory empty (or refresh');
        $("#status").append("<span style='color:red;'>nothing to ingest, export directory empty (or try refreshing the page)</span>");
    }
}


function ingestSelected(){
    console.log('this should allow you to pick from the exports AND uploads directory');
}

function deselectPIDs(){
    //delete cookie
    $.removeCookie('PIDsObj');
    //wipe selected list from PIDsObj object
    PIDsObj.selected = [];    
    //clear list
    $("#currSelect").empty();
    //reset empty cookie
    $.cookie('PIDsObj', JSON.stringify(PIDsObj));
    console.log('PIDsObj selected list cookie cleared.');
    //clear selected table if visible
    $("#selected_table").find("tr:gt(0)").remove();
}

function populateSelectedTable(){
    if (PIDsObj.selected.length < 1){
        $("#selected_actions button").addClass('disabled');
        $("#selected_table").append("<tr><td>No Objects Selected, please rectify.</td><td></td></tr>");
    }
    else {        
        for (var i = 0; i < PIDsObj.selected.length; ++i){
            $("#selected_table").append("<tr><td>"+PIDsObj.selected[i]+"</td><td><input class='selected_checkbox' type='checkbox' name='selected_checkboxes[]' value='"+PIDsObj.selected[i]+"'/></td></tr>");
        }
        

    }


}

function removeSelectedPIDs(){
    //empty selected list at left
    $("#currSelect").empty();

    //iterate through and remove from PIDsObj, then populate at left
    $('input:checked').each(function() {
        // To pass this value to its nearby hidden input

        var eachPID = $(this).val($(this).val())[0].value;
        eachPID = $.trim(eachPID);
        console.log(eachPID);

        removeValue(PIDsObj.selected,eachPID);

        //update lists
        $(this).parent().parent().remove();
        for (var i = 0; i < PIDsObj.selected.length; ++i){
            $("#currSelect").append("<li>"+PIDsObj.selected[i]+"</li>");            
        }        
    });
}

function addDatastream(type){

    if ($('#DSid').val() === ""){
        alert('please enter an ID for this datastream');
        return;
    }

    function addDSsuccess(response){
        $("#status").append("<span>"+response+"</span></br></br>");
    }

    function addDSerror(response){
        alert('an error was had.');
        console.log(response);
    }

    //unconditional variables
    dataObject = new Object();
    dataObject.DSname = $('#DSid').val();
    dataObject.DSdatatype = $('#pasteDSdatatype').val();
    dataObject.DSlabel = $('#DSlabel').val();

    //paste or upload
    if (DStype == "paste"){

        //get datastream content
        var DScontent = $('#pasteDScontent').val();
        //prepare POST data        
        dataObject.addDStype = "paste";
        dataObject.DScontent = DScontent;
        // console.log(dataObject);
    }

    if (DStype == "upload"){      
      
        //prepare POST data
        dataObject.addDStype = "upload";        
        dataObject.sourceDir = "uploads/DS";
        dataObject.filename = PIDsObj.batchUpload[0];
        // console.log(dataObject);        
    }

    if (DStype == "select"){
        //create dataObject properties from previously uploaded DS
    }

    //Actually add, button selection
    //selected
    if (type == "selected"){
        
        //list of PIDs to add datastream to
        var toAddDS = [];

        //iterates through all checked
        $('input:checked').each(function() {            
            var eachPID = $(this).val($(this).val())[0].value;
            eachPID = $.trim(eachPID);            
            toAddDS.push(eachPID);

            //ingest object
            $(document).ready(function(){
              dataObject.PID = eachPID;
              $.ajax({
                type: "POST",
                url: "php/addDatastream.php",
                data: dataObject,
                success: addDSsuccess
              });
            });
        });
    }

    //all
    if (type == "all"){
        alert('not yet!');
    }
    
}

//runs the validatechecksum query
function checksumCall(pid, dsid){

        function Success(response){
        console.log("success");
        console.log(response);
        var pid = response["@attributes"].pid;
        var checksumType = response.dsChecksumType;
        var checksumValid = response.dsChecksumValid;
    var objectLabel = response.dsLabel;

        if (checksumType == "DISABLED" && checksumValid == "true") {
            console.log("this one does not have an enabled checksum");
            $("#results_list_disabled").append("<li><a href='http://141.217.172.153/fedora/objects/"+pid+"/datastreams/"+dsid+"?format=xml&valideChecksum=true' target='_blank'>"+pid+"-"+objectLabel+"</a></input></li>")
            // $("#results_lists").append("<li><a href='http://141.217.172.153/fedora/objects/'"+pid+"'>"+pid+"</a></li>");
        }

        else if ((checksumType == "MD5" || "SHA-1" || "SHA-256" || "SHA-512") && checksumValid == "true") {
            console.log("this one does have an enabled and valid checksum");
          $("#results_list_enabled").append("<li><a target='_blank' href='http://141.217.172.153/fedora/objects/"+pid+"/datastreams/"+dsid+"?format=xml&valideChecksum=true' target='_blank'>"+pid+"-"+objectLabel+"</a></input></li>")
        }

        else if (checksumType == "ENABLED" && checksumValid == "false") {
            console.log("this one have an enabled checksum, but it is not valid");
          $("#results_list_invalid").append("<li><a href='http://141.217.172.153/fedora/objects/"+pid+"/datastreams/"+dsid+"?format=xml&valideChecksum=true' target='_blank'>"+pid+"-"+objectLabel+"</a></input></li>")
        }

        else {
            console.log("You got some errors here cause checksums aren't passing the conditions above");
        }
    }

        function Error(response){
        console.log("error");
        console.log(response);
    }


        $(document).ready(function() {
            dataObject = new Object();
            dataObject.data_type = "checksum";
            dataObject.encodedURL = 'http://localhost/fedora/objects/'+pid+'/datastreams/'+dsid+'?format=xml&validateChecksum=true';    

            $(document).ready(function(){
              $.ajax({
                type: "POST",
                url: "php/ajax_tunnel.php",
                data: dataObject,
                dataType: "json",
                success: Success,
                error: Error
              });
            });
});
        
}
//begins the whole checksum process then passes on to the function right above (ajaxCall)
function checksumPIDs(type){
        $("#results_enabled").slideDown();
        $("#results_list_enabled").empty();
        $("#results_disabled").slideDown();
        $("#results_list_disabled").empty();
        $("#results_invalid").slideDown();
        $("#results_list_invalid").empty();

    function Success(response){
        console.log(response);
        //for each object
        for (var i = 0; i < response.datastream.length; ++i) {
                var pid = response['@attributes'].pid;
                    //for each disd datastream
                    for (var i = 0; i < response.datastream.length; ++i) {
                        var dsid = response.datastream[i]['@attributes'].dsid;
                        // console.log(dsid);
                        // console.log(pid);
 
                        //call function checksumCall
                        checksumCall(pid, dsid);
                    }
 
}          

    }
        function Error(response){
        console.log(response);
    }

 if (type == "all"){

    for (var i = 0; i < PIDsObj.selected.length; ++i){

        $(document).ready(function() {
            dataObject = new Object();
            dataObject.data_type = "xml2json";
            dataObject.encodedURL = 'http://localhost/fedora/listDatastreams/'+PIDsObj.selected[i]+'?xml=true';    

            $(document).ready(function(){
              $.ajax({
                type: "POST",
                url: "php/ajax_tunnel.php",
                data: dataObject,
                dataType: "json",
                success: Success,
                error: Error
              });
            });
});

}
}

if (type == "selected"){

     $('input:checked').each(function() {
        //grab each selected PID, so it can be passed on
        var eachPID = $(this).val($(this).val())[0].value;

        $(document).ready(function() {
            dataObject = new Object();
            dataObject.data_type = "xml2json";
            dataObject.encodedURL = 'http://localhost/fedora/listDatastreams/'+eachPID+'?xml=true';    
            console.log(dataObject.encodedURL);    

            $(document).ready(function(){
              $.ajax({
                type: "POST",
                url: "php/ajax_tunnel.php",
                data: dataObject,
                dataType: "json",
                success: Success,
                error: Error
              });
            });
});

});    
}

}

//function to index datastreams in Solr - single record mode
// function indexDS(type){
//     //run python script, iterating through PID's
//         //indexDS.php
//     $('input:checked').each(function() {

//         function Success(response){
//             $("#index_results_list").append("<li>"+response+"</li></br>");
//         }

//         //grab each selected PID, so it can be passed on
//         var eachPID = $(this).val($(this).val())[0].value;

//         dataObject = new Object();                    
//         dataObject.PID = eachPID;
        
//         $.ajax({
//             type: "POST",
//             url: "php/indexDS.php",
//             data: dataObject,
//             dataType: "html",
//             success: Success,
//             error: Error
//         });        

//     });
// }

//function to index datastreams in Solr - array record mode
function indexDS(type){

    if (type === "fg"){  

        $("#index_results_list").append("<li>Running each PID individually, results should populate as they roll in.</li></br>");
        
        $('input:checked').each(function() {

            function Success(response){
                $("#index_results_list").append("<li>"+response+"</li></br>");
            }

            //grab each selected PID, so it can be passed on
            var eachPID = $(this).val($(this).val())[0].value;

            dataObject = new Object();                    
            dataObject.PID = eachPID;
            dataObject.mode = "fg";
        
            $.ajax({
                type: "POST",
                url: "php/indexDS.php",
                data: dataObject,
                dataType: "html",
                success: Success,
                error: Error
            });        

        });
    }
    
    if (type === "bg"){

        $("#index_results_list").append("<li>Sending PIDs batch to Python script for execution, this process will continue to run even if this page is closed.</li></br>");
    
        PIDsArray = [];
        //push to array    
        $('input:checked').each(function() {
            var eachPID = $(this).val($(this).val())[0].value;
            PIDsArray.push(eachPID);

        });

        //show results
        function Success(response){
            $("#index_results_list").append("<li>"+response+"</li></br>");
        }    

        dataObject = new Object();                    
        dataObject.PIDsArray = PIDsArray;   
        dataObject.mode = "bg"; 
        
        $.ajax({
            type: "POST",
            url: "php/indexDS.php",
            data: dataObject,
            dataType: "html",
            success: Success,
            error: Error
        });
    }

    
}

// SANDBOX FUNCTIONS
function facetSearch(){


    dataObject = new Object();
    //get values from form
    dataObject.GETparams = new Object();
    // dataObject.GETparams.core = $('#core').val();
    dataObject.GETparams.core = "mods"; //explicitly set to "mods" for testing
    // dataObject.GETparams.q = $('#q').val();
    dataObject.GETparams.q = "*:*";
    dataObject.GETparams.fq = $('#fq').val();
    dataObject.GETparams.fl = $('#fl').val();
    // dataObject.GETparams.start = $('#start').val();
    dataObject.GETparams.start = "1";
    // dataObject.GETparams.rows = $('#rows').val();
    dataObject.GETparams.rows = "10";
    dataObject.GETparams.wt = "json"; //sets response to JSON 
    //facet params
    dataObject.GETparams.facet="true";
    //set facet params, extra set required because solr has period in facet params, e.g. "facet.field"
    //these will be added in PHP tunnel, maybe not optimal?...
    dataObject.facetFields=["mods_subject_geographic_ms","mods_subject_topic_ms"];
    //datatype, request
    dataObject.data_type = "unfiltered"; //json expected, unfiltered
    dataObject.request_type = "GET";
    //assemble URL
    dataObject.baseURL = "http://localhost/solr4/"+dataObject.GETparams.core+"/select?";        
    
    // console.log(dataObject);
    
    $(document).ready(function(){
      $.ajax({
        type: "POST",
        url: "php/ajax_tunnel_v2.php",
        data: dataObject,
        dataType: "json",
        success: SolrSuccess,
        error: SolrError
      });
    });

    function SolrSuccess(response){
        console.log(response);
        
        //POPULATE FACETS
        //iterate through facets - would use facet field name for display on site, but not meaningful
        //might make sense to use it, but use some kind of conversion table
        var facetGeo = response.facet_counts.facet_fields.mods_subject_geographic_ms;
        for (var i = 0; i < facetGeo.length; i = i + 2){ //set to 10, limits to top 8 results
            $("#facetGeo").append("<li>"+facetGeo[i]+" <span class='pull-right'>["+facetGeo[i+1]+"]</span></li>");
        }
        var facetSubject = response.facet_counts.facet_fields.mods_subject_topic_ms;
        for (var i = 0; i < 16; i = i + 2){ //set to 10, limits to top 8 results
            $("#facetSubject").append("<li>"+facetSubject[i]+" <span class='pull-right'>["+facetSubject[i+1]+"]</span></li>");
        }

        //DISPLAY RESULTS / THUMBS
        var docs = response.response.docs;
        for (var i = 0; i < docs.length; i++){
            $("#resultsContainer").append("<div id='result"+i+"' class='span10 result_record'></div>");                    
            $("#result"+i).append("<div class='result_image'><img src='"+repo_baseURL+"/fedora/objects/"+docs[i].id+"/datastreams/THUMBNAIL/content'/></div>");
            $("#result"+i).append("<p><strong>"+docs[i].mods_title_ms[0]+"</strong></p>");            
        }
    }

    function SolrError(response){
        console.log('no dice');
    }
}

//UTILITIES/////////////////////////////////////////////////////////////////////////////////////////////////////
//function for last of array
Array.prototype.last = function() {return this[this.length-1];}

//function to remove values from array - array,string
function removeValue(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}

//get URL parameter
function getURLParameter(name) {
  return decodeURI(
      (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
  );
}

$(document).ready(function(){
    window.onbeforeunload = function() {
      //push object to cookie
      
      //remove query results
      // PIDsObj.queryResults = {};
      // PIDsObj.batchUpload = [];

      $.cookie("PIDsObjSelected", JSON.stringify(PIDsObj.selected));
      console.log('sent');
    }
});

//sandbox selector listener
$(document).ready( function(){
    $("#sandboxSelect").change(function(){                             
        // console.log(this.options[this.selectedIndex].value);
        var sandboxDest = this.options[this.selectedIndex].value;
        if (sandboxDest != "null"){
            loadView(sandboxDest, 'topView', 'both');
        }
    })
});














