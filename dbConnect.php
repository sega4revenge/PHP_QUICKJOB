<?php 

	define('HOST','localhost');
	define('USER','quickjobgaa1bb');
	define('PASS','');
	define('DB','android_js');
	
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('unable to connect to db');