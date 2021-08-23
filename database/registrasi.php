<?php
	include "koneksi.php";

	$nama = $_POST["nama"];
	$alamat = $_POST["alamat"];
	$notelp = $_POST["notelp"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$noktp = $_POST["noktp"];
	$gambar = $_FILES['gambar']['name'];
    
	$eks_dibolehkan = ['png', 'jpg','jpeg']; // ekstensi yang diperbolehkan
  $x = explode('.', $gambar); // memisahkan nama file dengan ekstensi
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];

  // cek ekstensi yang dibolehkan
  if(in_array($ekstensi, $eks_dibolehkan) === true) {
	move_uploaded_file($file_tmp, '../assets/ktp/' . $gambar); // memindahkan file gambar
	
  }else{
	die ("<script type='text/javascript'>alert('Foto belum masuk');</script>");
  }
  
	$sql = "INSERT INTO `penyewa` (`nama_penyewa`, `alamat_penyewa`, `notlp_penyewa`, `email`, `password`, `KTP`, `no_ktp`) VALUES ('".$nama."', '".$alamat."', '".$notelp."', '".$email."', '".$password."', '".$gambar."', '".$noktp."')";

	$result = mysqli_query($kon, $sql) or die ("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");
	if ($result)
		header("location: ../login.php");

?>