//small function to return URL for icon
//expecting string as input (e.g. application/pdf)
	//MIME-type, single word

//global hash-table
var iconHash = {};
iconHash.fileTypes = [];

//MIME-types, strings, etc.
iconHash.fileTypes.push(["pdf","application/pdf"]);
iconHash.fileTypes.push(["powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation", "application/vnd.ms-powerpoint"]);
iconHash.fileTypes.push(["gen_video","video/mp4","video/x-ms-wmv"]);
iconHash.fileTypes.push(["gen_image","image/jpeg","image/pjpeg","image/png","image/gif"]);
iconHash.fileTypes.push(["gen_archive","application/zip", "application/tar"]);
iconHash.fileTypes.push(["html","text/html"]);
//Icon URL's for fileTypes
iconHash.URLs = [];
iconHash.URLs['pdf'] = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/PDF/content";
iconHash.URLs['powerpoint'] = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/MSPowerpoint/content";
iconHash.URLs['gen_video'] = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/Video/content";
iconHash.URLs['gen_image'] = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/Image/content";
iconHash.URLs['gen_archive'] = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/Archive/content";
iconHash.URLs['html'] = "http://silo.lib.wayne.edu/fedora/objects/wayne:WSUDORThumbnails/datastreams/HTML/content";

//global function
window.iconURL = function(type){

	// iterate through has, look in each one
	for (var i = 0; i < iconHash.fileTypes.length; ++i){
		if (iconHash.fileTypes[i].indexOf(type) > -1) {
			// alert(iconHash.fileTypes[i][0]) //should alert the type key
			return iconHash.URLs[iconHash.fileTypes[i][0]];
		}
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////