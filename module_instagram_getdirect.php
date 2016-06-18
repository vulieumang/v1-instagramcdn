<?php
	
	require_once 'InstagramDownload.class.php';
	
	
	function show_link_instagram($url){
		$client = new InstagramDownload($url);
		$url 	= $client->downloadUrl(); // returns download URL		
		return $url;
		print_r($client);
	}
	