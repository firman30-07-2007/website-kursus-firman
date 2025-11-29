<?php
session_start();
include "koneksi.php";

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah username & password ada di database
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    // Jika login benar
    $_SESSION['admin_login'] = true;
    $_SESSION['admin_username'] = $data['username'];

    echo "<script>
            alert('Login berhasil!');
            window.location.href='Home_admin.php';
          </script>";
} else {
    // Jika salah → tetap di login_admin
    echo "<script>
            alert('Username atau password salah!');
            window.location.href='login_admin.php';
          </script>";
}
?>
