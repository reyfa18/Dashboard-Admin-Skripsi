<?php
session_start();
require 'config.php';
require 'header.php';

// Tambah atau Update Feedback
if (isset($_POST['simpan'])) {
  $nomor = $_POST['nomor'];
  $feedback = $_POST['feedback'];
  $tanggal = date('Y-m-d');

  if (!empty($_POST['id_feedback'])) {
    // Update
    $stmt = $pdo->prepare("UPDATE feedback SET nomor = ?, feedback = ?, tanggal = ? WHERE id_feedback = ?");
    $stmt->execute([$nomor, $feedback, $tanggal, $_POST['id_feedback']]);
  } else {
    // Tambah baru
    $stmt = $pdo->prepare("INSERT INTO feedback (nomor, feedback, tanggal) VALUES (?, ?, ?)");
    $stmt->execute([$nomor, $feedback, $tanggal]);
  }

  header("Location: feedback.php");
  exit;
}

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit'])) {
  $stmt = $pdo->prepare("SELECT * FROM feedback WHERE id_feedback = ?");
  $stmt->execute([$_GET['edit']]);
  $edit_data = $stmt->fetch();
}

// Hapus data
if (isset($_GET['hapus'])) {
  $stmt = $pdo->prepare("DELETE FROM feedback WHERE id_feedback = ?");
  $stmt->execute([$_GET['hapus']]);
  header("Location: feedback.php");
  exit;
}

// Ambil semua feedback
$stmt = $pdo->query("SELECT * FROM feedback ORDER BY tanggal DESC");
$data_feedback = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Feedback</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body>
<div class="container mt-4">

  <h4>Daftar Feedback</h4>
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="feedbackTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nomor</th>
              <th>Feedback</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($data_feedback): ?>
              <?php foreach ($data_feedback as $i => $row): ?>
                <tr>
                  <td><?= $i + 1 ?></td>
                  <td><?= htmlspecialchars($row['nomor']) ?></td>
                  <td><?= htmlspecialchars($row['feedback']) ?></td>
                  <td><?= $row['tanggal'] ?></td>
                  <td>
                    <a href="?hapus=<?= $row['id_feedback'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus feedback ini?')"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="5" class="text-center">Belum ada feedback.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>  
    </div>    
  </div>      
</div>
<?php require 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function () {
    $('#feedbackTable').DataTable({
      responsive: true,
      language: {
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        zeroRecords: "Tidak ada data ditemukan",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
        infoEmpty: "Tidak ada data tersedia",
        infoFiltered: "(difilter dari _MAX_ total data)",
        search: "Cari:",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Berikutnya",
          previous: "Sebelumnya"
        }
      }
    });
  });
</script>
</body>
</html>
