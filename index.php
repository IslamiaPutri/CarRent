<!DOCTYPE php>
<php lang="en">
<?php
include "database/koneksi.php";

$mobil = $kon->query("SELECT * from mobil where status_mobil='Tidak Disewa' LIMIT 6");
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
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 

                <li class="nav-item"><a class="nav-link" href="cars.php">Mobil</a></li>
              <?php
              session_start();
              if(isset($_SESSION["status"])){
              ?>
                <li class="nav-item"><a class="nav-link" href="kembali.php">pengembalian</a></li>
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
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <h4>Registrasi Sekarang juga</h4>
            <h2> Dapatkan Pinjaman Mobil Terbaik Disini!</h2>
            <a href="register.php" class="btn btn-danger btn-lg">Sewa Mobil</a>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>Registrasi Sekarang juga</h4>
            <h2>Mobil Aman Nyaman Hanya Disini</h2>
            <a href="register.php" class="btn btn-danger btn-lg">Sewa Mobil</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Mobil Yang Tersedia</h2>
              <a href="cars.php">Lihat Lebih banyak <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          <?php
            while($mb = $mobil->fetch_array(MYSQLI_ASSOC)) {
          ?>
          <div class="col-lg-4 col-md-6">
            <div class="product-item">
              <a href="#"><img src="assets/images/<?=$mb['gambar']?>" alt=""></a>
              <div class="down-content">
                <a href="#"><h4><?=$mb['merek']?></h4></a>

                <h6><small></small>Rp. <?=$mb['harga']?> / hari</h6>

                <small>
                  <strong title="Author"><i class="fa fa-cube"></i> <?=$mb['warna']?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
                  <strong title="Views"><i class="fa fa-cog"></i><?=$mb['jenis']?></strong>
                </small>
                <?php
              if(isset($_SESSION["status"])){
              ?>
                <a href="sewa.php?id=<?=$mb['id_mobil']?>" class="btn filled-button">Sewa</a>
                <?php
              }
              ?>
              </div>
            </div>
          </div>
          <?php
            }
            ?>

        </div>
      </div>
    </div>

    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>PT. Setia Jadi </h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/about-1-570x350.jpg" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h4>Perusahaan Rental Mobil Sejak 2013</h4>
              <p>Sudah melayani Ribuan Pelanggan dan terus mempertahankan kualitas untuk keamanan dan kenyamanan Pelanggan</p>
              <h4>Kontak :</h4>
              <h4>0822-8844-9977</h4>
              <h4>mobilindo99@gmail.com</h4>
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
              <p>Copyright © 2020  PT SETIAJADI  -  Kelompok 3   </p>
              <p>
              Anisa Islamia Putri (190102015) | Farastya N. Mirzan (190102039) | Febryanti Hayoto (190102043) | Astri Tan (190102023) | Rawin Lukaraja (190102106)
              </p>
              
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
</php>