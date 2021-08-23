<?php
		include "koneksi.php";

        $id_penyewa = $_POST['id_user'];
        $id_mobil = $_GET['id_mobil'];
        $tgl_ambil = $_POST['tgl_ambil'];
        $tgl_kembali = $_POST['tgl_kembali'];
        $harga = $_POST['total'];
        $bukti = $_FILES['bukti']['name'];
    
        $eks_dibolehkan = ['png', 'jpg','jpeg']; // ekstensi yang diperbolehkan
      $x = explode('.', $bukti); // memisahkan nama file dengan ekstensi
      $ekstensi = strtolower(end($x));
      $file_tmp = $_FILES['bukti']['tmp_name'];
    
      // cek ekstensi yang dibolehkan
      if(in_array($ekstensi, $eks_dibolehkan) === true) {
        move_uploaded_file($file_tmp, '../assets/bukti/' . $bukti); // memindahkan file gambar
        
      }else{
        die ("<script type='text/javascript'>alert('Foto belum masuk');</script>");
      }
    
	

	$sqlmobil = "select * from mobil where id_mobil='".$id_mobil."'";
	$rsmobil = mysqli_query($kon, $sqlmobil);
	$rs = $rsmobil->fetch_array(MYSQLI_ASSOC);

	$sqlsewa = "INSERT INTO sewa (id_penyewa, id_mobil, tgl_sewa, tgl_kembali) VALUES('".$id_penyewa."','".$id_mobil."','".$tgl_ambil."','".$tgl_kembali."')";

	$result = mysqli_query($kon, $sqlsewa) or die ("<script type='text/javascript'>alert('QUERY Belum Benar');</script>");

	$sqlsewa = "select id_sewa from sewa order by id_sewa DESC";
	$rssewa = mysqli_query($kon, $sqlsewa);
	$rs = $rssewa->fetch_array(MYSQLI_ASSOC);
	$id_sewa = $rs['id_sewa'];
      $tanggal = date('Y-m-d');

	$status_bayar = "Lunas";

	$sqlbayar = "INSERT INTO bayar (id_sewa, tgl_bayar, status_bayar, total_bayar,bukti ) VALUES('".$id_sewa."', '".$tanggal."', '".$status_bayar."','".$harga."','".$bukti."')";
	$rs = mysqli_query($kon, $sqlbayar);

	if ($result)
		$updateMobil = "UPDATE mobil set status_mobil='Disewa' where id_mobil='".$id_mobil."'";
		$rs = mysqli_query($kon, $updateMobil);
		header("location: ../kembali.php");

?>