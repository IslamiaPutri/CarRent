<?php
    session_start();
    $root = "http://localhost/sewa-mobil/";
    if(!isset($_SESSION["admin"])){
        header("location: login.php");
    }else{
        $nama = $_SESSION['nama'];

    }
    include_once "database/koneksi.php";
    $jenis = null;
    $tab = "mobil";
    if(isset($_GET["tab"])){
        $tab = $_GET["tab"];
        if(isset($_GET['jenis']))
            $jenis = $_GET["jenis"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="asset/js/jquery.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.js"></script>
    <script src="asset/sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/sweetalert/sweetalert.css">
    <script type="text/javascript">
        function hapus(a,b,c,d) {
            var href = document.getElementById(d).href;
          	swal({
          	  title: "Apakah Anda Yakin Untuk Menghapus?",
          	  text: c+" dengan nama "+b+" ("+a+")",
          	  type: "warning",
          	  showCancelButton: true,
          	  confirmButtonColor: "#DD6B55",
          	  confirmButtonText: "Ya",
          	  cancelButtonText: "Batal",
          	  closeOnConfirm: false,
          	  closeOnCancel: false
          	},
          		function(isConfirm){
          		  if (isConfirm) {
                  swal({
                    title: "Berhasil Hapus!",
                    type: "success",
                    timer: 1200,
                    showConfirmButton: false},
                  function(){
                        window.location = href;
                    }
                  );
          		    return true;
          		  } else {
          			swal("Batal", "Anda Membatalkan Penghapusan", "error");
          		  }
          	});
            return false;
        }
        function lunasi(a,b,c,d){
            var href = document.getElementById(d).href;
            swal({
              title: "Apakah Anda Yakin Untuk Melunasi?",
              text: "Penyewaan "+a+" dengan no plat : "+b+" dengan nilai kurang : Rp. "+c,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya",
              cancelButtonText: "Batal",
              closeOnConfirm: false,
              closeOnCancel: false
            },
              function(isConfirm){
                if (isConfirm) {
                  swal({
                    title: "Berhasil Dilunasi!",
                    type: "success",
                    timer: 1200,
                    showConfirmButton: false},
                  function(){
                        window.location = href;
                    }
                  );
          		    return true;
                } else {
                swal("Batal", "Anda Membatalkan Pelunasan", "error");
                }
            });
            return false;
        }
        function Kembalikan(a,b,c,d){
          var href = document.getElementById(d).href;
          swal({
            title: "Penyewaan Mobil Akan Dikembalikan!!",
            text: "Mobil "+b+" Dengan No Polisi : "+c+" oleh "+a+" Akan Dikembalikan!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
          },
            function(isConfirm){
              if (isConfirm) {
                swal({
                  title: "Berhasil Dikembalikan!",
                  type: "success",
                  timer: 1200,
                  showConfirmButton: false},
                function(){
                      window.location = href;
                  }
                );
                return true;
              } else {
              swal("Batal", "Anda Membatalkan Pengembalian", "error");
              }
          });
            return false;
        }

    </script>
</head>
<body class="bg-dark">
<div id="error"> </div>
<div role="tabpanel">

        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <a class="navbar-brand" href="#">PT.MOBILINDO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item text-dark m-3 <?php if($tab=="mobil") echo "active" ?>"  >
                <a href="#mobil" aria-controls="mobil" class="text-dark" role="tab" data-toggle="tab">Mobil</a>
            </li>
            <li class="nav-item text-dark m-3 <?php if($tab=="penyewa") echo "active" ?>"  >
                <a href="#penyewa" aria-controls="penyewa" class="text-dark" role="tab" data-toggle="tab">Penyewa</a>
            </li>
            <li class="nav-item text-dark m-3 <?php if($tab=="sewa") echo "active" ?>" >
                <a href="#sewaa" aria-controls="a" class="text-dark" role="tab" data-toggle="tab">Sewa</a>
            </li>
            <li class="nav-item text-dark m-3 <?php if($tab=="bayar") echo "active" ?>"  >
                <a href="#bayar" aria-controls="bayar" class="text-dark" role="tab" data-toggle="tab">Pembayaran</a>
            </li>
            <li class="nav-item text-dark m-3 <?php if($tab=="kembali") echo "active" ?>" >
                <a href="#kembali" aria-controls="kembali" class="text-dark" role="tab" data-toggle="tab">Pengembalian</a>
            </li>
            <span  class="navbar-brand text-right float-right ml-auto"><i></i></b>  <a href="logout.php" class="btn btn-danger btn-xs">Logout</a></span>
        </div>
        </nav>
        <?php
            if($jenis!=null){
                $pesan = "null";
                if($tab=="mobil" AND $jenis=="tbh")
                    $pesan = "Data Mobil Berhasil Ditambahkan";
                elseif($tab=="mobil" AND $jenis=="hapus")
                    $pesan = "Data Mobil Berhasil Dihapus";
                elseif($tab=="sopir" AND $jenis=="tbh")
                    $pesan = "Data Sopir Berhasil Ditambahkan";
                elseif($tab=="sopir" AND $jenis=="hapus")
                    $pesan = "Data Sopir Berhasil Dihapus";
                elseif($tab=="penyewa" AND $jenis=="tbh")
                    $pesan = "Data Penyewa Berhasil Ditambahkan";
                elseif($tab=="sewa" AND $jenis=="tbh")
                    $pesan = "Data Sewa Berhasil Ditambahkan";
                elseif($tab=="bayar" AND $jenis=="lunas")
                    $pesan = "Penyewaan Berhasil Dilunasi";
                elseif($tab=="kembali" AND $jenis!=null)
                    $pesan = "Sewa Berhasil dikembalikan dengan denda Rp. ".$jenis;

        ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p align="center"><?php echo $pesan?></p>
        </div>
        <?php }?>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- MOBIL -->
        <div role="tabpanel" class="tab-pane p-5 <?php if($tab=="mobil") echo "active" ?>" id="mobil">
            <h2 align="center" class="text-light">Daftar Mobil</h2>
                 <?php include_once "database/tampilMobil.php";?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tbhMobil">
                Tambah Mobil
            </button>
        </div>

        <!-- Penyewa -->
        <div role="tabpanel" class="tab-pane p-5 <?php if($tab=="penyewa") echo "active" ?>" id="penyewa">
            <h2 align="center" class="text-light">Daftar Penyewa</h2>
                 <div id="cetak"><?php include "database/tampilPenyewa.php";?></div>
        </div>

        <!-- Sewa -->
        <div role="tabpanel" class="tab-pane p-5 <?php if($tab=="sewa") echo "active" ?>" id="sewaa">
            <h2 align="center" class="text-light">Daftar Sewa</h2>
                 <?php include_once "database/tampilSewa.php";?>

        </div>
        <div role="tabpanel" class="tab-pane p-5  <?php if($tab=="bayar") echo "active" ?>" id="bayar">
            <h2 align="center" class="text-light">Daftar Bayar</h2>
                 <?php include_once "database/tampilBayar.php";?>

        </div>
        <div role="tabpanel" class="tab-pane p-5 <?php if($tab=="kembali") echo "active" ?>" id="kembali">
            <h2 align="center" class="text-light">Pengembalian</h2>
                 <?php include_once "database/tampilKembali.php";?>
        </div>
    </div>
</div>
<!-- Modal Mobil -->
    <div class="modal fade" id="tbhMobil" tabindex="-1" role="dialog" aria-labelledby="modalMobil" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modalMobil">Tambah Data Mobil</h4>
            </div>
            <div class="modal-body">
                <form name="tbhMobil" method="POST" action="database/simpanMobil.php" enctype="multipart/form-data">
                    <table width="100%" style="margin: 10px; padding-bottom: 20px;">
                        <tr>
                            <td>Nomor Polisi</td>
                            <td>
                                <input type="text" class="form-control" name="no_polisi" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>
                                <input type="text" class="form-control" name="merk" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis</td>
                            <td>
                                <input type="radio" name="jenis" value="Manual" checked> Manual
                                <input type="radio" name="jenis" value="Matic"> Matic
                            </td>
                        </tr>
                        <tr>
                            <td>Warna</td>
                            <td>
                                <input type="text" class="form-control" name="warna" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>
                                <input type="text" class="form-control" name="harga" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Gambar</td>
                            <td>
                                <input type="file" class="form-control" name="gambar" required>
                            </td>
                        </tr>
                    </table>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" value="Tambah Mobil" class="btn btn-primary">
                     </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
