<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- AdminLTE & Bootstrap -->
  <link rel="stylesheet" href="assets/adminlte/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/adminlte/plugins/bootstrap/css/bootstrap.min.css">

  <style>
  /* Buat sidebar tetap di kiri */
  .main-sidebar {
    position: fixed !important;
    top: 0;
    left: 0;
    height: 100vh;
    overflow-y: auto;
  }

  /* Supaya konten utama tidak tertutup sidebar */
  .content-wrapper {
    margin-left: 250px; /* Sesuaikan dengan lebar sidebar (default 250px di AdminLTE) */
  }

  /* Navbar tetap di atas */
  .main-header {
    position: fixed;
    width: 100%;
    z-index: 1030;
    left: 0;
  }

  /* Agar isi konten tidak tertutup navbar */
  .content-wrapper {
    padding-top: 70px;
  }

  /* Untuk menghindari footer nabrak */
  .main-footer {
    margin-left: 250px;
  }
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->


  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link text-center">
      <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
          <li class="nav-item">
            <a href="gejala.php" class="nav-link">
              <i class="nav-icon fas fa-notes-medical"></i>
              <p>Gejala</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="gangguan_mental.php" class="nav-link">
              <i class="nav-icon fas fa-user-injured"></i>
              <p>Gangguan Mental</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="feedback.php" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>Feedback</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Keluar</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper p-3">
