<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
   	$mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');   

if (true) {

    // receiving the post params
    $uniqueid = $_POST['uniqueid'];
    $hoten = $_POST['hoten'];
    $gioitinh = $_POST['gioitinh'];
    $birtdate = $_POST['birtdate'];
    $mail =$_POST['mail'];
    $sdt =$_POST['sdt'];
    $diachi =$_POST['diachi'];
    $quequan =$_POST['quequan'];
    $tentruong =$_POST['tentruong'];
    $chuyennganh =$_POST['chuyennganh'];
    $xeploai =$_POST['xeploai'];
    $thanhtuu =$_POST['thanhtuu'];
    $namkn =$_POST['namkn'];
    $tencongty =$_POST['tencongty'];
    $chucdanh =$_POST['chucdanh'];
    $motacv =$_POST['motacv'];
    $ngoaiNgu = $_POST['ngoaiNgu'];
    $kyNang =$_POST['kyNang'];
    $tencv=$_POST['tencv'];
    $nganhnghe =$_POST['nganhnghe'];
    $mucluong =$_POST['mucluong'];
    $vitri =$_POST['vitri'];
    $diadiem =$_POST['diadiem'];
        $qr="SELECT COUNT(*) AS sl FROM chitiet_nguoitimviec WHERE unique_id = '$uniqueid'";
        $r = mysqli_query($con, $qr);
	$row = mysqli_fetch_array($r, MYSQL_ASSOC);
	if($row['sl']>0)
	{
		$uid=uniqid('', true);
		$qr1="UPDATE chitiet_nguoitimviec SET hoten = '$hoten',gioitinh=  '$gioitinh',ngaysinh = '$birtdate',email = '$mail',sdt = '$sdt',diachi = '$diachi',quequan = '$quequan' WHERE unique_id= '$uniqueid'";
        $r1 = mysqli_query($con, $qr1);
	}else{
		$uid=uniqid('', true);
		$qr1="INSERT INTO chitiet_nguoitimviec(ID_user,unique_id,hoten,gioitinh,ngaysinh,email,sdt,diachi,quequan) VALUES('$uid','$uniqueid','$hoten','$gioitinh','$birtdate','$mail','$sdt','$diachi','$quequan')";
        $r1 = mysqli_query($con, $qr1);
	}
	
		$uid1=uniqid('', true);
		$qr2="INSERT INTO hoso_nguoitimviec(mahs,unique_id) VALUES('$uid1','$uniqueid')";
        $r2 = mysqli_query($con, $qr2);
		$uid2=uniqid('', true);																																														 
		$qr3="INSERT INTO chitiet_hoso(id_mahs,mahs,tentruong,chuyennganh,xeploai,thanhtuu,namkn,tencongty,chucdanh,motacv,ngoaingu,kynang,tencv,nganhnghe,mucluong,vitri,diadiem,createdate) VALUES('$uid2','$uid1','$tentruong','$chuyennganh','$xeploai','$thanhtuu','$namkn','$tencongty','$chucdanh','$motacv','$ngoaiNgu','$kyNang','$tencv','$nganhnghe','$mucluong','$vitri','$diadiem',NOW())";
        $r3 = mysqli_query($con, $qr3);
		
		$count=0;
		
	    $qr6="SELECT macv FROM tintuyendung_vieclam WHERE tencv LIKE '%$tencv%' AND nganhNghe LIKE '$nganhnghe'"; //AND diadiem LIKE '$diadiem'
       	    $r6 = mysqli_query($con, $qr6);
		 while($ro = mysqli_fetch_array($r6, MYSQL_ASSOC))
		{	
				$macv = $ro['macv'];
				$qr7="INSERT INTO notification(macv,unique_id) VALUES('$macv','$uniqueid')";
				$r7 = mysqli_query($con, $qr7);
				$count=$count+1;
			
		} 
	if( $count>0)
	{
		$qr7="SELECT * FROM registertoken WHERE unique_id = '$uniqueid'";
        	$r7 = mysqli_query($con, $qr7);
	      while($row7 = mysqli_fetch_array($r7, MYSQL_ASSOC))
		{
			$tokens[] = $row7["id_token"];
			
		}
		
		$message = "Da tim thay $count cong viec phu hop voi ban.";
		$message_status = send_notification($tokens,$message);
		//echo $message_status;
		
	}
	
         $response["success"] =1;
	echo json_encode($response);
} else {
    $response["error"] = TRUE;
    $response["success"] =0;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			'notification' => array(
			'body' => $message,
			'title' => 'QUICKJOB Thong bao:'
			)
			);
		$headers = array(
			'Authorization:key = AIzaSyD-65l9tiEycOMYGGPPEr_owLQiQ1HcXRk',
			'Content-Type: application/json'
			);
	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}
	
