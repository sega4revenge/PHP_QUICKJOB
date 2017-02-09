<?php

class DB_Functions {

    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
	
        // connecting to database
        $db = new Db_Connect();

        $this->conn = $db->connect();

    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password,$type) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at,type) VALUES(?, ?, ?, ?, ?, NOW(),?)");
        $stmt->bind_param("ssssss", $uuid, $name, $email, $encrypted_password, $salt,$type);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
	 public function storeUser3($status, $dayst,$timest,$dayfn,$timefn,$mod) {
    
		echo $status, $dayst,$timest,$dayfn,$timefn,$mod;
        $stmt = $this->conn->prepare("INSERT INTO schedule(trangthai,ngaybatdau,thoigianbatdau,ngayhoanthanh,thoigianhoanthanh,ketqua,update_at) VALUES(?,?,?,?,?,?,NOW())");
        $stmt->bind_param("ssssss",$status, $dayst,$timest,$dayfn,$timefn,$mod);
        $result = $stmt->execute();
        $stmt->close();
 
    }
 public function storeUser1($email, $password,$type,$company,$phone) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id,email,namecompany,phone,encrypted_password, salt, created_at,type) VALUES(?,?,?,?, ?, ?, NOW(),?)");
        $stmt->bind_param("sssssss", $uuid,$email,$company,$phone, $encrypted_password, $salt,$type);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
public function regfacebook($id,$name) {
	$s=0;
        $uuid = uniqid('', true);
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id,name,email,created_at,type) VALUES(?, ?, ?, NOW(),?)");
        $stmt->bind_param("ssss", $uuid,$name,$id,$s);
        $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
public function regfacebookavata($photo,$id) {

        $stmt = $this->conn->prepare("INSERT INTO volleyupload(photo,name) VALUES(?, ?)");
        $stmt->bind_param("ss",$photo,$id);
        $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
 public function getUserfacebook($id) {
        $s=0;
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND type= ?");
        $stmt->bind_param("ss", $id,$s);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
 $s=0;
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND type= ?");
 
        $stmt->bind_param("ss", $email,$s);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }else{return null;}
        } else {
            return NULL;
        }
    }
public function getUserByEmailAndPassword1($email, $password) {
 	$s=1;
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND type=?");
 
        $stmt->bind_param("ss", $email,$s);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }else{return null;}
        } else {
            return NULL;
        }
    }

	 public function getJob() {
 
        $stmt = $this->conn->prepare("SELECT * FROM tintuyendung_congviec");
 
        if ($stmt->execute()) {
            $job = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifying user password
            return $job;
        } else {
            return NULL;
        }
    }
	 public function checkpassword($pass,$uid) {
		
        $stmt = $this->conn->prepare("SELECT * from users WHERE unique_id = ?");
        $stmt->bind_param("s", $uid);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $pass);
            // check for password equality
            if ($encrypted_password == $hash) {
               
                return true;
            }else{return false;}
        } else {
            return false;
        }
 
    }
	 public function CheckProfileAddJob($macv, $mahs) {
 
        $stmt = $this->conn->prepare("SELECT * FROM hoso_ungtuyen WHERE mahs = ? AND macv = ?");
 
        $stmt->bind_param("ss", $mahs,$macv);
 
		$stmt->execute();
  
		$stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            //  existed 
            $stmt->close();
            return true;
        } else {
            //  not existed
            $stmt->close();
            return false;
        }
    }
	
	 public function CheckJobSave($id, $macv) {
 
        $stmt = $this->conn->prepare("SELECT * FROM luucv WHERE unique_id = ? AND macv = ?");
 
        $stmt->bind_param("ss", $id,$macv);
 
		$stmt->execute();
  
		$stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            //  existed 
            $stmt->close();
            return true;
        } else {
            //  not existed
            $stmt->close();
            return false;
        }
    }
	 public function CheckProfileSave($id, $mahs) {
 
        $stmt = $this->conn->prepare("SELECT * FROM luuhs WHERE unique_id = ? AND mahs = ?");
 
        $stmt->bind_param("ss", $id,$mahs);
 
		$stmt->execute();
  
		$stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            //  existed 
            $stmt->close();
            return true;
        } else {
            //  not existed
            $stmt->close();
            return false;
        }
    }
	 public function getchitiet_nhatuyendung($id) {
 
        $stmt = $this->conn->prepare("SELECT * FROM chitiet_nhatuyendung WHERE unique_id = ?");
 
        $stmt->bind_param("s", $id);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
	public function getchitiet_logo($id) {
 
        $stmt = $this->conn->prepare("SELECT * FROM volleyupload WHERE name = ?");
        $stmt->bind_param("s", $id);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
	 public function getchitiet_nguoitimviec($id) {
 
        $stmt = $this->conn->prepare("SELECT * FROM chitiet_nguoitimviec WHERE unique_id = ?");
 
        $stmt->bind_param("s", $id);
 
        if ($stmt->execute()) {
		
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }
	
	
    /**
     * Check user is existed or not
     */
	 function update_user($email,$mk) {
		$hash = $this->hashSSHA($mk);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
		$stmt = $this->conn->prepare("UPDATE users SET encrypted_password= ?,salt = ? WHERE email= ?");
		$stmt->bind_param("sss",$encrypted_password,$salt,$email);
        $result = $stmt->execute();
        $stmt->close();
	return $result;
}
 function update_user2($mk,$uid) {
	$hash = $this->hashSSHA($mk);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
	$stmt = $this->conn->prepare("UPDATE users SET encrypted_password= ?,salt = ? WHERE unique_id= ?");
	$stmt->bind_param("sss",$encrypted_password,$salt,$uid);
        $result = $stmt->execute();
        $stmt->close();
	return ;
}
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }
 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        return $hash;
    }
   function getinformation($namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem) 
{
	$qr="SELECT hoso_nguoitimviec.unique_id FROM chitiet_hoso INNER JOIN hoso_nguoitimviec ON  chitiet_hoso.mahs = hoso_nguoitimviec.mahs INNER JOIN registertoken ON hoso_nguoitimviec.unique_id = registertoken.unique_id WHERE chitiet_hoso.tencv LIKE '%$namejop%' AND chitiet_hoso.nganhnghe LIKE '$nganhNghe' ";
  
	/*while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
	{	
		 $tokenarray[]= $row['id_token'];		
	}*/
		
		return  $r = mysqli_query($this->conn, $qr);
}	
   function SetNotification($id,$macv)
 {
        $stmt1 = $this->conn->prepare("INSERT INTO notification(macv,unique_id) VALUES(?,?)");
        $stmt1->bind_param("ss",$macv,$id);
        $result1 = $stmt1->execute();
        $stmt1->close();
        return $uuid;
}
function taocongviec($uuid,$namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem,$motacongviec,$phucloi,$soluong,$hannophoso,$tuoiyeucau,$hocvan,$gioitinh,$ngoaingu,$yeucaukhac,$kynang) {
	$uid=uniqid('', true);
	$strTimeZone = "Asia/Ho_Chi_Minh";
	$objTimeZone = new DateTimeZone($strTimeZone);
    	$objDateTime = new DateTime();
    	
$stmt = $this->conn->prepare("INSERT INTO tintuyendung_vieclam(macv,matd,tencv,nganhNghe,chucdanh,mucluong,diadiem,motacv,phucloi,soluong,bangcap,dotuoi,ngoaingu,gioitinh,yeucaukhac,tenkynang,hannophoso,ngaydang) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssssssssssss",$uid,$uuid,$namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem,$motacongviec,$phucloi,$soluong,$hocvan,$tuoiyeucau,$ngoaingu,$gioitinh,$yeucaukhac,$kynang,$hannophoso,$objDateTime);
        $objDateTime->setTimezone($objTimeZone);
	$objDateTime= $objDateTime->format("Y-m-d H:i:s");
	$result = $stmt->execute();
        $stmt->close();
	return $uid;
}
function location($uuid,$lat,$lang) {
$stmt = $this->conn->prepare("INSERT INTO locations(macv,latitude,longitude) VALUES(?,?,?)");
        $stmt->bind_param("sss",$uuid,$lat,$lang);
        $result = $stmt->execute();
        $stmt->close();
	return $uuid;
}
  function taotintuyendung($uid) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("INSERT INTO tintuyendung(matd,unique_id) VALUES(?,?)");
        $stmt1->bind_param("ss",$uuid,$uid );
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}

/* function taotintuyendung_yeucau($macv,$age,$hocvan,$sex,$ngoaingu,$khac) {
	$uid=uniqid('', true);
$stmt = $this->conn->prepare("INSERT INTO tintuyendung_yeucau(mayc,macv,bangcap,dotuoi,ngoaingu,gioitinh,yeucaukhac) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss",$uid,$macv,$hocvan,$age,$ngoaingu,$sex,$khac);
        $result = $stmt->execute();
        $stmt->close();
	return $uid;
}
function taotintuyendung_yeucau_kynang($mayc,$tenkn) {
	$uid=uniqid('', true);
$stmt = $this->conn->prepare("INSERT INTO tintuyendung_yeucau_kynang(makn,mayc,tenkynang) VALUES(?,?,?)");
        $stmt->bind_param("sss",$uid,$mayc,$tenkn);
        $result = $stmt->execute();
        $stmt->close();
	return $uid;
} */
function chitiet_nhatuyendung($id,$tenct,$quymo,$diachi,$nganhnghe,$mota) {
	//$uid=uniqid('', true);
$stmt = $this->conn->prepare("INSERT INTO chitiet_nhatuyendung(unique_id,tencongty,quymo,diachi,nganhnghe,mota) VALUES(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss",$id,$tenct,$quymo,$diachi,$nganhnghe,$mota);
        $result = $stmt->execute();
        $stmt->close();
	return $uid;
}
function update_congviec($macv,$namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem,$motacongviec,$phucloi,$soluong,$hannophoso,$tuoiyeucau,$hocvan,$gioitinh,$ngoaingu,$yeucaukhac,$kynang) {
$stmt = $this->conn->prepare("UPDATE tintuyendung_vieclam SET tencv = ?,nganhNghe=  ?,chucdanh = ?,mucluong = ?,diadiem = ?,motacv = ?,phucloi = ?,soluong = ?,hannophoso = ?,bangcap =?,dotuoi=?,ngoaingu=?,gioitinh=?,yeucaukhac=?,tenkynang=? WHERE macv= ?");
		$stmt->bind_param("ssssssssssssssss",$namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem,$motacongviec,$phucloi,$soluong,$hannophoso,$hocvan,$tuoiyeucau,$ngoaingu,$gioitinh,$yeucaukhac,$kynang,$macv);
        $result = $stmt->execute();
        $stmt->close();
	return $result;
}
function chitiet_nguoitmviec($id,$ten,$gioitinh,$ngaysinh,$email,$sdt,$diachi,$quequan) {
	$uid=uniqid('', true);
$stmt = $this->conn->prepare("INSERT INTO chitiet_nguoitimviec(ID_user,unique_id,hoten,gioitinh,ngaysinh,email,sdt,diachi,quequan) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$uid,$id,$ten,$gioitinh,$ngaysinh,$email,$sdt,$diachi,$quequan);
        $result = $stmt->execute();
        $stmt->close();
	return $uid;
}
function chitiet_hoso($mahs,$tentruong,$chuyennganh,$xeploai,$thanhtuu,$namkn,$tencongty,$chucdanh,$motacv,$ngoaingu,$kynang,$tencv,$nganhnghe,$mucluong,$vitri,$diadiem) {
	$uid=uniqid('', true);
$stmt = $this->conn->prepare("INSERT INTO chitiet_hoso(id_mahs,mahs,tentruong,chuyennganh,xeploai,thanhtuu,namkn,tencongty,chucdanh,motacv,ngoaingu,kynang,tencv,nganhnghe,mucluong,vitri,diadiem,createdate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
        $stmt->bind_param("sssssssssssssssss",$uid,$mahs,$tentruong,$chuyennganh,$xeploai,$thanhtuu,$namkn,$tencongty,$chucdanh,$motacv,$ngoaingu,$kynang,$tencv,$nganhnghe,$mucluong,$vitri,$diadiem);
        $result = $stmt->execute();
        $stmt->close();
	return $uid;
}
function taohoso($id) {
	$uid=uniqid('', true);
$stmt = $this->conn->prepare("INSERT INTO hoso_nguoitimviec(mahs,unique_id) VALUES(?,?)");
        $stmt->bind_param("ss",$uid,$id);
        $result = $stmt->execute();
        $stmt->close();
	return $uid;
}
function checktintuyendung($uid) {
	
$stmt = $this->conn->prepare("SELECT COUNT(*) FROM tintuyendung WHERE unique_id = ?");
$stmt->bind_param("s",$uid);
        $stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
	return $result["COUNT(*)"];
}
function checkhoso($uid) {
	
$stmt = $this->conn->prepare("SELECT COUNT(*) FROM hoso_nguoitimviec WHERE unique_id = ?");
$stmt->bind_param("s",$uid);
        $stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
	return $result["COUNT(*)"];
}
function checkdata($uid) {
	
$stmt = $this->conn->prepare("SELECT COUNT(*) FROM chitiet_nguoitimviec WHERE unique_id = ?");
$stmt->bind_param("s",$uid);
        $stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
	return $result["COUNT(*)"];
}
function checkdata1($uid) {
	
$stmt = $this->conn->prepare("SELECT COUNT(*) FROM chitiet_nhatuyendung WHERE unique_id = ?");
 $stmt->bind_param("s",$uid);
        $stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
	return $result["COUNT(*)"];
}
function update_nguoitimviec($uniqueid,$ten,$gioitinh,$ngaysinh,$email,$sdt,$diachi,$quequan) {
$stmt = $this->conn->prepare("UPDATE chitiet_nguoitimviec SET hoten = ?,gioitinh=  ?,ngaysinh = ?,email = ?,sdt = ?,diachi = ?,quequan = ? WHERE unique_id= ?");
		$stmt->bind_param("ssssssss",$ten,$gioitinh,$ngaysinh,$email,$sdt,$diachi,$quequan,$uniqueid);
        $result = $stmt->execute();
        $stmt->close();
	return $result;
}
function update_nhatuyendung($uid,$tencongty,$quymo,$diachi,$nganhnghe,$gioithieucongty) {
$stmt = $this->conn->prepare("UPDATE chitiet_nhatuyendung SET tencongty = ?,quymo=  ?,diachi = ?,nganhnghe = ?,mota = ? WHERE unique_id= ?");
		$stmt->bind_param("ssssss",$tencongty,$quymo,$diachi,$nganhnghe,$gioithieucongty,$uid);
        $result = $stmt->execute();
        $stmt->close();
	return $result;
}
function update_hoso($mahs,$tentruong,$chuyennganh,$xeploai,$thanhtuu,$namkn,$tencongty,$chucdanh,$motacv,$ngoaingu,$kynang,$tencv,$nganhnghe,$mucluong,$vitri,$diadiem) {
$stmt = $this->conn->prepare("UPDATE chitiet_hoso SET tentruong = ?,chuyennganh=  ?,xeploai = ?,thanhtuu = ?,namkn = ?,tencongty = ?,chucdanh = ?,motacv = ?,ngoaingu = ?,kynang = ?,tencv = ?,nganhnghe = ?, mucluong = ?, vitri = ?, diadiem = ? WHERE mahs= ?");
		$stmt->bind_param("ssssssssssssssss",$tentruong,$chuyennganh,$xeploai,$thanhtuu,$namkn,$tencongty,$chucdanh,$motacv,$ngoaingu,$kynang,$tencv,$nganhnghe,$mucluong,$vitri,$diadiem,$mahs);
        $result = $stmt->execute();
        $stmt->close();
	return $result;
}
function update_yeucau($macv,$tuoiyeucau,$hocvan,$gioitinh,$ngoaingu,$yeucaukhac) {
$stmt = $this->conn->prepare("UPDATE tintuyendung_yeucau SET bangcap = ?,dotuoi=  ?,ngoaingu = ?,gioitinh = ?,yeucaukhac = ? WHERE macv= ?");
		$stmt->bind_param("ssssss",$hocvan,$tuoiyeucau,$ngoaingu,$gioitinh,$yeucaukhac,$macv);
        $result = $stmt->execute();
        $stmt->close();
	return $result;
}
function takemayc($macv) {
	
$stmt = $this->conn->prepare("SELECT * FROM tintuyendung_yeucau WHERE macv = ?");
$stmt->bind_param("s",$macv);
        $stmt->execute();
	$result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
	return $result["mayc"];
}
function deleteDatayeucau($mayc) {
	$uuid=uniqid('', true);
	$stmt1 = $this->conn->prepare("DELETE FROM tintuyendung_yeucau_kynang WHERE mayc = ?");
        $stmt1->bind_param("s",$mayc);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function updatekynang($macv,$tuoiyeucau,$hocvan,$gioitinh,$ngoaingu,$yeucaukhac) {
$stmt = $this->conn->prepare("UPDATE tintuyendung_yeucau_kynang SET bangcap = ?,dotuoi=  ?,ngoaingu = ?,gioitinh = ?,yeucaukhac = ? WHERE macv= ?");
		$stmt->bind_param("sssssssssss",$hocvan,$tuoiyeucau,$ngoaingu,$gioitinh,$yeucaukhac,$macv);
        $result = $stmt->execute();
        $stmt->close();
	return $result;
}
function nophoso($mahs,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("INSERT INTO hoso_ungtuyen(id_ungtuyen,mahs,macv) VALUES(?,?,?)");
        $stmt1->bind_param("sss",$uuid,$mahs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function nophoso_nhatuyendung($mahs,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("INSERT INTO hoso_ungtuyen_nhatuyendung(id_ut,macv,mahs) VALUES(?,?,?)");
        $stmt1->bind_param("sss",$uuid,$macv,$mahs);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function luucv($id,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("INSERT INTO luucv(id_luucv,macv,unique_id) VALUES(?,?,?)");
        $stmt1->bind_param("sss",$uuid,$macv,$id);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function notification($id,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("INSERT INTO notification(macv,unique_id) VALUES(?,?)");
        $stmt1->bind_param("ss",$macv,$id);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function gettoken($namejop,$nganhNghe,$chucdanh,$mucluong,$diadiem) {
	
	$qr="SELECT id_token FROM chitiet_hoso INNER JOIN hoso_nguoitimviec ON  chitiet_hoso.mahs = hoso_nguoitimviec.mahs INNER JOIN registertoken ON hoso_nguoitimviec.unique_id = registertoken.unique_id WHERE chitiet_hoso.tencv LIKE '%$namejop%' AND chitiet_hoso.nganhnghe LIKE '%$nganhNghe%' ";//AND chitiet_hoso.diadiem LIKE '%$diadiem'
   
	$tokenarray = array();
	/*while($row = mysqli_fetch_array($r, MYSQL_ASSOC))
	{	
		 $tokenarray[]= $row['id_token'];		
	}*/
		
		return  $r = mysqli_query($this->conn, $qr);
}	
function checktoken($uid) {
	$stmt = $this->conn->prepare("SELECT * FROM registertoken WHERE unique_id = ?");
	$stmt->bind_param("s",$uid);
       
 	if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
}
function inserttoken($uid,$token) {
	$stmt1 = $this->conn->prepare("INSERT INTO registertoken(unique_id,id_token) VALUES(?,?)");
        $stmt1->bind_param("ss",$uid,$token);
        $result1 = $stmt1->execute();
        $stmt1->close();
return true;
}
function UpdateToken($id,$token) {
	
$stmt1 = $this->conn->prepare("UPDATE registertoken SET id_token= ? WHERE unique_id= ?");
        $stmt1->bind_param("ss",$token,$id);
        $result1 = $stmt1->execute();
        $stmt1->close();
}
function luuhs($id,$mahs) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("INSERT INTO luuhs(id_luuhs,mahs,unique_id) VALUES(?,?,?)");
        $stmt1->bind_param("sss",$uuid,$mahs,$id);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteData($hs,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("DELETE FROM hoso_ungtuyen WHERE mahs = ? AND macv = ?");
        $stmt1->bind_param("ss",$hs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataSaveJob($id,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("DELETE FROM luucv WHERE unique_id = ? AND macv = ?");
        $stmt1->bind_param("ss",$id,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataJobRecruitmente($mahs,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("DELETE FROM hoso_ungtuyen WHERE mahs = ? AND macv = ?");
        $stmt1->bind_param("ss",$mahs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataSaveProfile($id,$mahs) {

$stmt1 = $this->conn->prepare("DELETE FROM luuhs WHERE unique_id = ? AND mahs = ?");
        $stmt1->bind_param("ss",$id,$mahs);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataProfile($id,$mahs) {

	$stmt1 = $this->conn->prepare("DELETE FROM hoso_nguoitimviec WHERE unique_id = ? AND mahs = ?");
        $stmt1->bind_param("ss",$id,$mahs);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataProfile_Detail($mahs) {
	$stmt1 = $this->conn->prepare("DELETE FROM chitiet_hoso WHERE mahs = ?");
        $stmt1->bind_param("s",$mahs);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataProfile_Company($mahs) {
	$stmt1 = $this->conn->prepare("DELETE FROM hoso_ungtuyen_nhatuyendung WHERE mahs = ?");
        $stmt1->bind_param("s",$mahs);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteProfile($mahs) {
	$stmt1 = $this->conn->prepare("DELETE FROM hoso_ungtuyen WHERE mahs = ?");
        $stmt1->bind_param("s",$mahs);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataJob($uid,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("DELETE FROM tintuyendung WHERE unique_id = ? AND matd = ?");
        $stmt1->bind_param("ss",$uid,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function deleteDataJob2($uid,$macv) {
	$uuid=uniqid('', true);
$stmt1 = $this->conn->prepare("DELETE FROM tintuyendung_vieclam WHERE macv = ?");
        $stmt1->bind_param("s",$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
return $uuid;
}
function gettoken2($macv) {
	$token="";
$stmt = $this->conn->prepare("SELECT * FROM tintuyendung_vieclam WHERE macv = ?");
$stmt->bind_param("s",$macv);
       
	if($stmt->execute()){
	  $result = $stmt->get_result()->fetch_assoc();
	  $matd=$result["matd"];
	  $stmt2 = $this->conn->prepare("SELECT * FROM tintuyendung WHERE matd = ?");
	  $stmt2->bind_param("s",$matd);
		if($stmt2->execute())
		{	
			  $result2 = $stmt2->get_result()->fetch_assoc();
	 		  $uid=$result2["unique_id"];
			  $stmt3 = $this->conn->prepare("SELECT * FROM registertoken WHERE unique_id = ?");
	  		  $stmt3->bind_param("s",$uid);
				if($stmt3->execute()){
 				$result3 = $stmt3->get_result()->fetch_assoc();
				$token=$result3['id_token'];
				}

		}
	}
	
        $stmt->close();
	
	return $token;
}
function takematd($macv) {
	
$stmt = $this->conn->prepare("SELECT * FROM tintuyendung_vieclam WHERE macv = ?");
$stmt->bind_param("s",$macv);
        $stmt->execute();
	$result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
	return $result["matd"];
}
function UpdateData($hs,$macv) {
	
$stmt1 = $this->conn->prepare("UPDATE hoso_ungtuyen_nhatuyendung SET status = 1 WHERE mahs= ? AND macv = ?");
        $stmt1->bind_param("ss",$hs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
}
function UpdateData2($hs,$macv) {
	
$stmt1 = $this->conn->prepare("DELETE FROM hoso_ungtuyen_nhatuyendung WHERE mahs = ? AND macv= ?");
        $stmt1->bind_param("ss",$hs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
}
/*function UpdateData2($hs,$macv) {
	
$stmt1 = $this->conn->prepare("UPDATE hoso_ungtuyen_nhatuyendung SET status = 2 WHERE mahs= ? AND macv = ?");
        $stmt1->bind_param("ss",$hs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
} */
function UpdateData_nguoitimviec($hs,$macv) {
	
$stmt1 = $this->conn->prepare("UPDATE hoso_ungtuyen SET status = 1 WHERE mahs= ? AND macv = ?");
        $stmt1->bind_param("ss",$hs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
}
function UpdateData_nguoitimviec2($hs,$macv) {
	
$stmt1 = $this->conn->prepare("UPDATE hoso_ungtuyen SET status = 2 WHERE mahs= ? AND macv = ?");
        $stmt1->bind_param("ss",$hs,$macv);
        $result1 = $stmt1->execute();
        $stmt1->close();
}
}
?>