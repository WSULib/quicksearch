<?php

   	// FILE:          lib_hours.php
   	// TITLE:         Library Hours Cache Retrieval
   	// CREATED:       September 2013
  	//
  	// PURPOSE:
   	// When triggered by lib_hours.js via an ajax call, it returns the cache of the day's library hours in JSON form.
   	// it does not depend on any other files
   	//
   	// OVERALL METHOD:
   	// 1. receives a request via ajax from lib_hours.js
	// 2. returns cache of the day's library hours
   	//
   	// FUNCTIONS:
	// None
 





	// Code in section below from /global/live/sites/lib/info/hours/index.php////
	/////////////////////////////////////////////////////////////////////////////
	//// THIS SECTION CHECKS THE CACHE TO SEE IF THE HOURS AJAX NEEDS FIRING ////
	/////////////////////////////////////////////////////////////////////////////
	
	require_once('Cache/Lite.php');
	
	//SET INITIAL VALUES
	$basepath 	= "/global/live/"."cache/lib/hours/";
	$cacheFile	= "{$basepath}cached_hours.php";
	$cacheTime 	= 6 * 60 * 60; // 6 hours
	$cacheGroup	= "DayHours"; // Same as /info/hours/	
	
	// Set Cache_Lite options
    $options = array(
        'cacheDir' => $basepath,
        'lifeTime' => $cacheTime
	);

    // Create the Cache_Lite object
    $Cache_Lite = new Cache_Lite($options);

    // Serve from the cache if it is younger than $cacheTime, or not forced to reload
    if ($cached_data = $Cache_Lite->get($cacheFile, $cacheGroup)) {
		//UNSERIALIZE SINCE WE'VE BEEN STORING AN ARRAY
    	$hours_array = unserialize($cached_data); $cacheTest = "yes"; } else { $cacheTest = "no"; }
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////		

echo(json_encode($hours_array));
		
?>