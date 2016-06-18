<?php
	// save_to_dropbox_via_url($path,$name,$ext,$url_image);
	
	use Alorel\Dropbox\Operation\Files\SaveUrl\CheckJobStatus;
    use Alorel\Dropbox\Operation\Files\SaveUrl\SaveURL;
	
	require_once 'vendor/autoload.php';
	
	
    SaveURL::setDefaultToken('EXDuL6Bkvc4AAAAAAAAACnIQ_NPQ9YRKzzLCKVgaofiI4Tr9Th_LDt-7MbkANZLe');
    SaveURL::setDefaultAsync(false);
	
	$path = '/Instagram/';
	$name = 'default';
	$ext = '.jpg';	
	$caption = 'default';
	
	$url_image ='https://scontent-hkg3-1.cdninstagram.com/t51.2885-15/e15/13423545_262829714077156_1067019568_n.jpg';
	
	
	
	function save_to_dropbox_via_url($path,$name,$caption,$ext,$url_image){
		$saveURL = new SaveURL();
		$resp = json_decode($saveURL->raw($path.$name.'_'.$caption.$ext, $url_image)->getBody()->getContents(), true);
		
		if (isset($resp['async_job_id'])) {
			$check = new CheckJobStatus();
			
			do {
				echo 'Not saved yet - waiting for 3 seconds before checking for the job status' . PHP_EOL;
				sleep(3); //Wait a bit
				$r = json_decode($check->raw($resp['async_job_id'])->getBody()->getContents(), true);
			} while (isset($r['.tag']) && $r['.tag'] == 'in_progress');
			
			echo 'URL saved';
			} else {
			echo 'URL saved';
			
		}	
		
	}		
