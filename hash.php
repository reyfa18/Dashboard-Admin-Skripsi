<?php
$password = 'admin123'; // ← Ganti dengan password yang kamu inginkan
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Password hash: " . $hash;
