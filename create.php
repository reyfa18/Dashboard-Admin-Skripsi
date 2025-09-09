<?php
include 'config.php';
include 'auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO admin (nama, email, role) VALUES (?, ?, ?)");
    $stmt->execute([$nama, $email, $role]);

    header("Location: index.php");
    exit();
}
?>

<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<!-- Main Content -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Tambah User</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-body">
          <form method="POST">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select name="role" class="form-control" required>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'partials/footer.php'; ?>
