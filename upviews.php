<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['id'])) {
	   $matd=$_POST['id'];
	   $qr2="SELECT * FROM tintuyendung WHERE matd = '$matd'";
	   $r2 = mysqli_query($con, $qr2);
	   $row2 = mysqli_fetch_array($r2, MYSQL_ASSOC);
	   $views=$row2['views'];
	   $views=$views+1;
      	   $qr="UPDATE tintuyendung SET views = '$views' WHERE matd = '$matd'";
          $r = mysqli_query($con, $qr);
	   mysqli_close($con);
	  echo json_encode($mang);

} 


