<?php
	ini_set('display_errors', 1);
	ini_set('max_execution_time', 100); //300 seconds = 5 minutes
	// ini_set("precision",25);
	
	require_once 'module_twitter_get.php';
	require_once 'module_instagram_getdirect.php';
	require_once 'module_dropbox_saveurl.php';
	//save_to_dropbox_via_url('/Instagram/','default','default','.jpg','https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e15/13423545_262829714077156_1067019568_n.jpg');
	
	//List obj twitter have link instagram
	$obj = json_decode($json_twitter, true);
	
	
	//Get lastest id to stack, id before run
	$file = fopen("latest_id.txt", "r+") or die("Unable to open file!");	
	$latest_id = fgets($file);	
	fclose($file);
	$latest_id_temp = null;
	
	foreach ($obj as $tweet) {
		
		//filter  link instagram from twitter
		if(isset($tweet['entities']['urls'][1]['expanded_url']))
		{$url_image=$tweet['entities']['urls'][1]['expanded_url'];}
		else
		{$url_image=$tweet['entities']['urls'][0]['expanded_url'];}
		
		echo $url_image.'</br>';
		
		
		//if link have download, break out loop
		$id = $url_image;
		if($id==$latest_id) break;
		
		//assigned frist id aka lastest to temp
		if($latest_id_temp==null) $latest_id_temp = $id;
		
		
		//get direct link image instagram		
		$client = new InstagramDownload($url_image);
		$url_image_link 	= $client->downloadUrl(); // returns download URL	
		$name =  $client->name; // returns name		
		$caption = $client->caption;// returns caption
		$id = $client->input_url;// returns id
		
		//if link error break once
		if(null==$url_image_link) continue;
			
		// remove slash on caption
		$caption = str_replace(array('\\n','\\')," ",$caption);
		
		//check type
		if($client->type=='image') {$ext='.jpg';} else{$ext='.mp4';}
		
		//remove https in link
		$url_image_link = str_replace('https','http',$url_image_link);
		
	
		
		
		//send to dropbox
		save_to_dropbox_via_url($path,$name,$caption,$ext,$url_image_link);
		
		// if(null!==$url_image_link) {		
			// echo "<br/>";
			
			// echo $url_image_link;
			// echo "<br/>";
			// save_to_dropbox_via_url($path,'default','default','.jpg',$url_image_link);			
		// }
	}
	//$latest_id_temp;
	//write new id
	$file = fopen("latest_id.txt", "w+") or die("Unable to open file!");
	fwrite($file,$latest_id_temp);
	$latest_id2 = fgets($file);		
	fclose($file);
	
