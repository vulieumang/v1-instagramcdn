<?php
	ini_set('display_errors', 1);
    use Alorel\Dropbox\Operation\Files\SaveUrl\CheckJobStatus;
    use Alorel\Dropbox\Operation\Files\SaveUrl\SaveURL;
	
	################################
	# INCLUDE THE AUTOLOADER BELOW #
	################################
    require_once 'vendor/autoload.php'; 
	##################
	# IT'S IMPORTANT #
	##################
	
    SaveURL::setDefaultToken('EXDuL6Bkvc4AAAAAAAAACnIQ_NPQ9YRKzzLCKVgaofiI4Tr9Th_LDt-7MbkANZLe');
    SaveURL::setDefaultAsync(false);
	
    $saveURL = new SaveURL();
    $resp = json_decode($saveURL->raw('/Instagram/a.jpg', 'https://igcdn-photos-e-a.akamaihd.net/hphotos-ak-xat1/t51.2885-15/e15/13398575_977722398990188_1841788166_n.jpg')->getBody()->getContents(), true);
	
	
	try {
		$resp = json_decode($saveURL->raw('/Instagram/a.jpg', 'https://igcdn-photos-e-a.akamaihd.net/hphotos-ak-xat1/t51.2885-15/e15/13398575_977722398990188_1841788166_n.jpg')->getBody()->getContents(), true);
		} catch (Exception $e) {
		print_r($e);
	}
	
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
	print_r($resp['async_job_id'] );
	
	
