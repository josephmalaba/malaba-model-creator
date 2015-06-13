<?php
	$files = glob('./ClassCreator/*'); //get all files
	foreach($files as $file){
		if(is_file($file)){
			unlink($file);
		}
	}
	
	header('location: ./');
?>