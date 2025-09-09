<?php
session_start();
require 'config.php';
require 'header.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// Tambah Gejala
if (isset($_POST['tambah'])) {
  $kode = $_POST['kode'];
  $gejala = $_POST['nama'];
  $id_gangguan = $_POST['id_gangguan'];

  $stmt = $pdo->prepare("INSERT INTO gejala (kode, gejala, id_gangguan) VALUES (?, ?, ?)");
  $stmt->execute([$kode, $gejala, $id_gangguan]);
  header("Location: gejala.php");
  exit;
}

// Edit Gejala
if (isset($_POST['update'])) {
  $id_gejala = $_POST['id_gejala'];
  $kode = $_POST['kode'];
  $gejala = $_POST['nama'];
  $id_gangguan = $_POST['id_gangguan'];

  $stmt = $pdo->prepare("UPDATE gejala SET kode = ?, gejala = ?, id_gangguan = ? WHERE id_gejala = ?");
  $stmt->execute([$kode, $gejala, $id_gangguan, $id_gejala]);
  header("Location: gejala.php");
  exit;
}

// Hapus Gejala
if (isset($_GET['hapus'])) {
  $id_gejala = $_GET['hapus'];
  $stmt = $pdo->prepare("DELETE FROM gejala WHERE id_gejala = ?");
  $stmt->execute([$id_gejala]);
  header("Location: gejala.php");
  exit;
}

// Ambil data untuk tabel
$stmt = $pdo->query("SELECT gejala.*, gangguan_mental.nama AS nama_gangguan FROM gejala LEFT JOIN gangguan_mental ON gejala.id_gangguan = gangguan_mental.id_gangguan ORDER BY LENGTH(kode), kode ASC");
$gejala = $stmt->fetchAll();

// Ambil data untuk form edit
$edit_data = null;
if (isset($_GET['edit'])) {
  $id_gejala = $_GET['edit'];
  $stmt = $pdo->prepare("SELECT * FROM gejala WHERE id_gejala = ?");
  $stmt->execute([$id_gejala]);
  $edit_data = $stmt->fetch();
}

// Cari kode yang belum digunakan dari G1 - G99
$stmt = $pdo->query("SELECT kode FROM gejala");
$existing_kode = $stmt->fetchAll(PDO::FETCH_COLUMN);
$available_kode = null;
for ($i = 1; $i <= 99; $i++) {
  $kode_coba = 'G' . $i;
  if (!in_array($kode_coba, $existing_kode)) {
    $available_kode = $kode_coba;
    break;
  }
}

$gangguan_list = $pdo->query("SELECT * FROM gangguan_mental")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Gejala</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body>
<div class="container mt-4">
  <h2>Data Gejala</h2>

  <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">
    <i class="fas fa-plus"></i> Tambah Gejala
  </button>

<div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="gejalaTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama Gejala</th>
              <th>Gangguan</th>
              <th style="width: 60px;">Aksi</th>
              <th style="display:none;">Urutan</th> <!-- Kolom urutan -->
            </tr>
          </thead>
          <tbody>
            <?php foreach ($gejala as $g): ?>
              <tr>
                <td><?= htmlspecialchars($g['kode']) ?></td>
                <td><?= htmlspecialchars($g['gejala']) ?></td>
                <td><?= htmlspecialchars($g['nama_gangguan']) ?></td>
                <td>  
                  <a href="?edit=<?= $g['id_gejala'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                  <a href="?hapus=<?= $g['id_gejala'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash"></i></a>
                </td>
                <td style="display:none;"><?= intval(substr($g['kode'], 1)) ?></td> <!-- nilai numerik, misalnya 1 dari G1 -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Tambah Gejala</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" value="<?= $available_kode ?>" required>
          </div>
          <div class="form-group">
            <label>Nama Gejala</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Jenis Gangguan</label>
            <select name="id_gangguan" class="form-control" required>
              <option value="">Pilih Gangguan</option>
              <?php foreach ($gangguan_list as $g): ?>
                <option value="<?= $g['id_gangguan'] ?>"><?= htmlspecialchars($g['nama']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php if ($edit_data): ?>
<div class="modal fade show" id="modalEdit" tabindex="-1" role="dialog" style="display:block;" aria-modal="true">
  <div class="modal-dialog">
    <form method="post">
      <input type="hidden" name="id_gejala" value="<?= $edit_data['id_gejala'] ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Gejala</h5>
          <a href="gejala.php" class="close">&times;</a>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Kode</label>
            <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($edit_data['kode']) ?>" required>
          </div>
          <div class="form-group">
            <label>Nama Gejala</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($edit_data['gejala']) ?>" required>
          </div>
          <div class="form-group">
            <label>Jenis Gangguan</label>
            <select name="id_gangguan" class="form-control" required>
              <?php foreach ($gangguan_list as $g): ?>
                <option value="<?= $g['id_gangguan'] ?>" <?= $edit_data['id_gangguan'] == $g['id_gangguan'] ? 'selected' : '' ?>><?= htmlspecialchars($g['nama']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
          <a href="gejala.php" class="btn btn-secondary">Batal</a>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal-backdrop fade show"></div>
<?php endif; ?>
<?php require 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
$('#gejalaTable').DataTable({
  columnDefs: [
    {
      targets: 4, // kolom ke-0 (urutan)
      visible: false,
      searchable: false
    },
    {
      targets: 0,  // kolom "Kode" yang terlihat
      orderData: 4 // gunakan kolom ke-5 (urutan angka) untuk sorting
    }
  ],
  order: [[4, 'asc']], // default sort: urut dari angka
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

</script>
</body>
</html>
