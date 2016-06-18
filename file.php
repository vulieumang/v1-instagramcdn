<?php
	//read id
	$file = fopen("latest_id.txt", "r+") or die("Unable to open file!");	
	$latest_id = fgets($file);	
	fclose($file);
	echo $latest_id;
	
	
	//write new id
	$file = fopen("latest_id.txt", "w+") or die("Unable to open file!");
	fwrite($file,"ssv2");
	$latest_id2 = fgets($file);		
	fclose($file);
	echo $latest_id2;
	
	
	
	
?> 