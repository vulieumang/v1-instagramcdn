<?php
	
	require_once('TwitterAPIExchange.php');
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	$settings = array(
    'oauth_access_token' => "742950770568531968-I5ifKzHSYcvSZAP8Tucwh9mrmGWd3HX",
    'oauth_access_token_secret' => "29pX36h8LhopquMYRsqQmoY4DoLUL0RmEmjmNucmU74Lr",
    'consumer_key' => "XSR629AsnHnkNFlcNvRGGmdHZ",
    'consumer_secret' => "85ZZTfxvOhIF1ZpqUCb7ovb0Z4fBh5ktgHzRyL7P9kTDA1oqGG"
	);
	
	/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
	//$url = 'https://api.twitter.com/1.1/blocks/create.json';
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?count=2';
	$requestMethod = 'POST';
	
	/** POST fields required by the URL above. See relevant docs as above **/
	$postfields = array(
    'screen_name' => 'vulieumang4', 
    'skip_status' => '1'
	);
	
	/** Perform a POST request and echo the response **/
	// $twitter = new TwitterAPIExchange($settings);
	// echo $twitter->buildOauth($url, $requestMethod)
	// ->setPostfields($postfields)
	// ->performRequest();
	
	/** Perform a GET request and echo the response **/
	/** Note: Set the GET field BEFORE calling buildOauth(); **/
	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?count=10';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$json_twitter = $twitter->setGetfield($getfield)
	->buildOauth($url, $requestMethod)
	->performRequest();
	
