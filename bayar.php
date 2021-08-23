<!DOCTYPE html>
<html lang="en">
<?php
include "database/koneksi.php";

session_start();
if(isset($_SESSION["status"])){
$id=$_GET['id_mobil'];
$id_user = $_SESSION['id'];
}
else
{
  header("location: index.php");
}
$tgl_ambil = $_POST['tgl_ambil'];
$tgl_kembali = $_POST['tgl_kembali'];

$ambil = new DateTime($tgl_ambil);
$kembali = new DateTime($tgl_kembali);

$mobil = $kon->query("SELECT * from mobil where id_mobil= $id");
$user = $kon->query("SELECT * from penyewa where id_penyewa = $id_user");
  ?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>PT. Setia Jadi | Rental Mobil</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <!-- <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>   -->
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>PT <em>SETIA</em>JADI</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 

                <li class="nav-item"><a class="nav-link" href="cars.php">Mobil</a></li>
                <li class="nav-item"><a class="nav-link" href="kembali.php">pengembalian</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Profil</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
              </li>
                
              <li class="nav-item"><a class="nav-link" href="about-us.php">Tentang</a></li>
              <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
              <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

        <!-- Page Content -->
        <div class="page-heading about-heading header-text" style="background-image: url(assets/images/heading-1-1920x500.jpg);">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                      <div class="container my-5">
                        <div class="row">
                          <div class="col-6">
                          <?php
                            while($mb = $mobil->fetch_array(MYSQLI_ASSOC)) {
                          ?>
                            <div class="product-item">
                              <a href="#"><img src="assets/images/<?=$mb['gambar']?>" alt=""></a>
                              <div class="down-content">
                                <a href="#"><h4><?=$mb['merek']?></h4></a>

                                <h6><small></small>Rp. <?=$mb['harga']?> / hari</h6>

                                <small>
                                  <strong title="Author"><i class="fa fa-cube"></i> <?=$mb['warna']?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                  <strong title="Views"><i class="fa fa-cog"></i><?=$mb['jenis']?></strong>
                                </small>
                              </div>
                            </div>
                          <?php

                          $hari = date_diff($ambil ,$kembali);
                          $harga = (int)$mb['harga'];
                          
                          $total = $harga * $hari->days;
                            }
                            ?>
                          </div>
                          <div class="col-6">
                          <div class="card">
                          <?php
                            while($us = $user->fetch_array(MYSQLI_ASSOC)) {
                          ?>
                            <h4>
                              <b>Nama Pemesan</b> : <?=$us['nama_penyewa'];?> <br><br>
                             <b>Email</b>: <?=$us['email'];?>  <br><br>
                             <b>No hp</b>: <?=$us['notlp_penyewa'];?> <br><br>
                             <b>Alamat</b> : <?=$us['alamat_penyewa'];?> <br><br>
                             <b>Tanggal Penyewaan</b>: <?=$tgl_ambil?> <br><br>
                             <b>Tanggal Pengembalian</b> : <?=$tgl_kembali?> <br><br>
                            </h4>
                            <?php } ?>
                          </div>
                          </div>
                        </div>
                        <?php
                        
                        ?>
                        <div class="card">
                          <h3>Jumlah Hari : <?php echo $ambil->diff($kembali)->format("%d");?></h3>
                            <h3>Total : Rp. <?php echo $total?></h3>
                        <h4>
                            Kirim Total Pembayaran ke rekening di bawah ini
                        </h4><br>
                        <h6>No Rekening : 5327392373844</h6>
                        <h6>Bank : BCA</h6>
                        <h6>Atas Nama : Maulana</h6>
                        </div>
                        <h2 class="mt-5">Upload Bukti Pembayaran</h2>
                          <form action="database/bayar.php?id_mobil=<?=$id?>?id_user=<?=$id_user?>" method="post" enctype="multipart/form-data">
                          <div class="form-row">
                              <input type="file" class="form-control" name="bukti" placeholder="Email" required>
                          </div>
                              <input type="number" name="total" value="<?=$total?>" hidden>
                              <input type="text" name="id_user" value="<?=$_SESSION['id']?>" hidden>
                              <input type="date" class="form-control" hidden value="<?=$tgl_ambil?>" name="tgl_ambil" placeholder="Email" required min="<?=date('d/m/Y')?>">
                              <input type="date" class="form-control" hidden value="<?=$tgl_kembali?>" name="tgl_kembali" placeholder="Password" min="<?=date('d/m/Y')?>" required>

                          <button type="submit" class="mt-3 btn filled-button btn-lg btn-danger text-white">Kirim</button>
                        </form>

                      </div>
                      </div>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>


    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright © 2020  PT SETIAJADI  -     </p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>


                        
                      