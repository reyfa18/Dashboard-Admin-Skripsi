<?php
session_start();

// Cek apakah user sudah login, jika tidak redirect ke login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Koneksi database
require 'config.php';


// Ambil data users (jika dibutuhkan untuk statistik, dll)
$stmt = $pdo->query("SELECT * FROM admin");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- AdminLTE & Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <!-- Optional Navbar (jika ingin ditampilkan kembali) -->
  <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav> -->

  <!-- Content Wrapper -->
  <div class="content-wrapper" style="margin-left: 0;"> <!-- margin-left:0 untuk hilangkan ruang sidebar -->

    <!-- Header -->
    <section class="content-header">
      <div class="d-flex justify-content-end mb-2">
       <a href="logout.php" class="btn btn-sm btn-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
  </a>
</div>

      <div class="container-fluid">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, <strong><?= $_SESSION['user']; ?></strong>!</p>
      </div>
    </section>

    <!-- Isi Konten -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- Kartu Gejala -->
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Gejala</h3>
                <p>Data Gejala</p>
              </div>
              <div class="icon">
                <i class="fas fa-notes-medical"></i>
              </div>
              <a href="gejala.php" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Kartu Gangguan Mental -->
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Gangguan</h3>
                <p>Data Gangguan Mental</p>
              </div>
              <div class="icon">
                <i class="fas fa-brain"></i>
              </div>
              <a href="gangguan_mental.php" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Kartu Feedback -->
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Feedback</h3>
                <p>Pesan Masuk</p>
              </div>
              <div class="icon">
                <i class="fas fa-comments"></i>
              </div>
              <a href="feedback.php" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>
    </section>

  </div>
</div>

<?php include 'footer.php'; ?>
<!-- Script JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
