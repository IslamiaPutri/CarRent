<?php
	include "koneksi.php";

	$gambar = $_FILES['gambar']['name'];
	$no_polisi = $_POST["no_polisi"];
	$merk = $_POST["merk"];
	$jenis = $_POST["jenis"];
	$warna = $_POST["warna"];
	$harga = $_POST["harga"];

	$eks_dibolehkan = ['png', 'jpg']; // ekstensi yang diperbolehkan
  $x = explode('.', $gambar); // memisahkan nama file dengan ekstensi
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];

  // cek ekstensi yang dibolehkan
  if(in_array($ekstensi, $eks_dibolehkan) === true) {
    move_uploaded_file($file_tmp, '../../assets/images/' . $gambar); // memindahkan file gambar

	$sql = "INSERT INTO `mobil` (`no_polisi`, `merek`, `jenis`, `warna`, `harga`,`gambar`) VALUES ('".$no_polisi."', '".$merk."', '".$jenis."', '".$warna."', '".$harga."', '".$gambar."')";

	$result = mysqli_query($kon, $sql) or die ("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");
  }
	if ($result)
		header("location: ../index.php?tab=mobil&jenis=tbh");

?>