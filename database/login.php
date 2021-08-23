<?php
  include "koneksi.php";

$email = isset($_POST["Email"]) ? $_POST["Email"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

$login = mysqli_query($kon , "select * from penyewa where email='$email' and password='$password'");
$cek = mysqli_num_rows($login);
 
while($log = $login->fetch_array(MYSQLI_ASSOC)) {

    $id = $log['id_penyewa'];
    $nama = $log['nama_penyewa'];
    $alamat = $log['alamat_penyewa'];
    $tlp = $log['notlp_penyewa'];

}
if($cek > 0){
	session_start();
	$_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    $_SESSION['nama'] = $nama;
    $_SESSION['alamat'] = $alamat;
    $_SESSION['tlp'] = $tlp;
	$_SESSION['status'] = "login";
	header("location: ../index.php");
}else{
	header("location:../login.php");	
}

?>