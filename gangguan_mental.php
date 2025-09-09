<?php
session_start();
require 'config.php';
require 'header.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// Tambah Gangguan
if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $ringkasan = $_POST['ringkasan'];
  $deskripsi = $_POST['deskripsi'];

  $stmt = $pdo->prepare("INSERT INTO gangguan_mental (nama, ringkasan, deskripsi) VALUES (?, ?, ?)");
  $stmt->execute([$nama, $ringkasan, $deskripsi]);
  header("Location: gangguan_mental.php");
  exit;
}

// Edit Gangguan
if (isset($_POST['update'])) {
  $id_gangguan = $_POST['id_gangguan'];
  $nama = $_POST['nama'];
  $ringkasan = $_POST['ringkasan'];
  $deskripsi = $_POST['deskripsi'];

  $stmt = $pdo->prepare("UPDATE gangguan_mental SET nama=?, ringkasan=?, deskripsi=? WHERE id_gangguan=?");
  $stmt->execute([$nama, $ringkasan, $deskripsi, $id_gangguan]);
  header("Location: gangguan_mental.php");
  exit;
}

// Hapus Gangguan
if (isset($_GET['hapus'])) {
  $id_gangguan = $_GET['hapus'];
  $stmt = $pdo->prepare("DELETE FROM gangguan_mental WHERE id_gangguan=?");
  $stmt->execute([$id_gangguan]);
  header("Location: gangguan_mental.php");
  exit;
}

// Ambil Data
$stmt = $pdo->query("SELECT * FROM gangguan_mental ORDER BY nama ASC");
$gangguan = $stmt->fetchAll();

// Data edit (jika ada)
$edit_data = null;
if (isset($_GET['edit'])) {
  $stmt = $pdo->prepare("SELECT * FROM gangguan_mental WHERE id_gangguan=?");
  $stmt->execute([$_GET['edit']]);
  $edit_data = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Gangguan Mental</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body>
<div class="container mt-4">
  <h2 class="mb-4">Data Gangguan Mental</h2>

  <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">
    <i class="fas fa-plus"></i> Tambah Gangguan Mental
  </button>

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="gangguanTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Ringkasan</th>
              <th>Deskripsi</th>
              <th style="width: 100px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($gangguan as $g): ?>
              <tr>
                <td><?= htmlspecialchars($g['nama']) ?></td>
                <td><?= htmlspecialchars($g['ringkasan']) ?></td>
                <td><?= htmlspecialchars($g['deskripsi']) ?></td>
                <td>
                  <a href="?edit=<?= $g['id_gangguan'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                  <a href="?hapus=<?= $g['id_gangguan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Gangguan Mental</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Ringkasan</label>
            <input type="text" name="ringkasan" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<?php if ($edit_data): ?>
<div class="modal fade show" id="modalEdit" tabindex="-1" role="dialog" style="display:block;" aria-modal="true">
  <div class="modal-dialog">
    <form method="post">
      <input type="hidden" name="id_gangguan" value="<?= $edit_data['id_gangguan'] ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Gangguan Mental</h5>
          <a href="gangguan_mental.php" class="close"><span>&times;</span></a>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($edit_data['nama']) ?>" required>
          </div>
          <div class="form-group">
            <label>Ringkasan</label>
            <input type="text" name="ringkasan" class="form-control" value="<?= htmlspecialchars($edit_data['ringkasan']) ?>" required>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($edit_data['deskripsi']) ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
          <a href="gangguan_mental.php" class="btn btn-secondary">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal-backdrop fade show"></div>
<?php endif; ?>

<?php require 'footer.php'; ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function () {
    $('#gangguanTable').DataTable({
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
