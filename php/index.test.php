<?php
	/////////////////////////////////////////////////////////////////////////////
	//// THIS SECTION CHECKS THE CACHE TO SEE IF THE HOURS AJAX NEEDS FIRING ////
	/////////////////////////////////////////////////////////////////////////////
	
	require_once('Cache/Lite.php');
	
	//SET INITIAL VALUES
	$basepath 	= "/global/live/"."cache/lib/hours/";
	$cacheFile	= "{$basepath}cached_hours.php";
	print_r($cacheFile);
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
print_r($hours_array);
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////		
		
?>