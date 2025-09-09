<?php
include 'config.php';
include 'auth.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    die("Data tidak ditemukan!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare("UPDATE users SET nama=?, email=?, role=? WHERE id=?");
    $stmt->execute([$nama, $email, $role, $id]);

    header("Location: index.php");
    exit();
}
?>

<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>

<div class="content-wrapper">
  <section class="content-header"><div class="container-fluid"><h1>Edit User</h1></div></section>
  <section class="content">
    <div class="container-fluid">
      <div class="card card-info">
        <div class="card-body">
          <form method="POST">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
              <label>Role</label>
              <select name="role" class="form-control" required>
                <option <?= $user['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                <option <?= $user['role'] == 'User' ? 'selected' : '' ?>>User</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'partials/footer.php'; ?>
