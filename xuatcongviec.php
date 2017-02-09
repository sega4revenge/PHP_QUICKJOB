<?php

	$host='localhost';
	$uname='quickjobgaa1bb';
	$pwd='7c066c0f70c94c23';
	$db="quickjob_ga_a1bb";
    $mang =array();
	$con = mysqli_connect($host,$uname,$pwd, $db) or die("connection failed");
    mysqli_set_charset($con, 'utf8');
    
    if(isset($_POST['id'])) {
	  $id=$_POST['id'];
	
	 
       $qr="SELECT * FROM tintuyendung WHERE unique_id = '$id'";
	
        $r = mysqli_query($con, $qr);
		while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
		{
			$matd=$row['matd'];
			$rr = mysqli_query($con,"SELECT * FROM tintuyendung_vieclam WHERE matd = '$matd'");
			$rows = mysqli_fetch_array($rr, MYSQL_ASSOC);
			$macv=$rows["macv"];
			$rrr = mysqli_query($con,"SELECT * FROM hoso_ungtuyen_nhatuyendung WHERE macv = '$macv'");
			$count = mysqli_num_rows($rrr);
		
			$tong=$count;
			$mahs="";
			if($count>0)
			{
			 $rowss = mysqli_fetch_array($rrr, MYSQL_ASSOC);
			 $mahs=$rowss["mahs"];
			}
	
			array_push($mang, new congviec($rows["tencv"],$rows["chucdanh"],$rows["nganhNghe"],$rows["soluong"],$tong,$macv,$mahs));
		}
			 mysqli_close($con);
		echo json_encode($mang);
		} 
	 
	  
class congviec{
	var $tencongviec;
	var $chucdanh;
	var $nganhnghe;
	var $soluong;
	var $sohoso;
	var $macv;
	var $mahs;
	function congviec($tencongviec,$chucdanh,$nganhnghe,$soluong,$sohoso,$macv,$mahs){
		$this->tencongviec=$tencongviec;
		$this->chucdanh=$chucdanh;
		$this->nganhnghe=$nganhnghe;
		$this->soluong=$soluong;
		$this->sohoso=$sohoso;
		$this->macv=$macv;
		$this->mahs=$mahs;
    }
}