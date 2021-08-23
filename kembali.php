<!DOCTYPE html>
<html lang="en">
<?php
include "database/koneksi.php";
session_start();
if(isset($_SESSION['id'])){
    $id_user = $_SESSION['id'];
    }
    else
    {
      header("location: index.php");
    }
$sewa = $kon->query("SELECT mobil.merek ,mobil.no_polisi , sewa.tgl_sewa , sewa.tgl_kembali FROM sewa LEFT JOIN pengembalian ON sewa.id_sewa = pengembalian.id_sewa , penyewa , mobil WHERE pengembalian.id_sewa IS NULL AND sewa.id_penyewa = penyewa.id_penyewa AND sewa.id_mobil = mobil.id_mobil AND penyewa.id_penyewa = $id_user");
$kembali = $kon->query("SELECT mobil.merek ,mobil.no_polisi , sewa.tgl_sewa , sewa.tgl_kembali FROM sewa RIGHT JOIN pengembalian ON sewa.id_sewa = pengembalian.id_sewa , penyewa , mobil WHERE sewa.id_penyewa = penyewa.id_penyewa AND sewa.id_mobil = mobil.id_mobil AND penyewa.id_penyewa = $id_user");
?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

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
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
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
              <?php
              if(isset($_SESSION["status"])){
              ?>
                <li class="nav-item active"><a class="nav-link" href="kembali.php">pengembalian</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Profil</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="database/logout.php">Logout</a>
                  </div>
              </li>
                <?php
              } else {
              ?>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
              <?php } ?>
                <li class="nav-item"><a class="nav-link" href="about-us.php">Tentang</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <div class="page-heading about-heading header-text"
        style="background-image: url(assets/images/heading-1-1920x500.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h1 class="mt-5">Status Pengembalian</h1>
                        <div class=" container">
                            <div class="row my-5">
                            <?php
                                while($sw = $sewa->fetch_array(MYSQLI_ASSOC)) {
                            ?>
                                <div class="col-3">
                                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Belum Dikembalikan</div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$sw['merek']?></h5>
                                        <h4 class="card-title"><?=$sw['no_polisi']?></h4>
                                        <p class="card-text"><?=$sw['tgl_sewa']?> / <?=$sw['tgl_kembali']?></p>
                                    </div>
                                    </div>
                                </div>
                            <?php
                                }
                                ?>
                            <?php
                                while($km = $kembali->fetch_array(MYSQLI_ASSOC)) {
                            ?>
                                <div class="col-3">
                                    <div class="card bg-success text-white mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Sudah Dikembalikan</div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$km['merek']?></h5>
                                        <h4 class="card-title"><?=$km['no_polisi']?></h4>
                                        <p class="card-text"><?=$km['tgl_sewa']?> / <?=$km['tgl_kembali']?></p>
                                    </div>
                                </div>
                                </div>
                                <?php
                                }
                                ?>
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
                        <p>Copyright © 2020 PT SETIAJADI - </p>
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