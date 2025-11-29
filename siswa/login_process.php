<?php
session_start();
include "../koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM siswa WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    if (password_verify($password, $data['password'])) {

        $_SESSION['login_siswa'] = $data['username'];

        echo "<script>
                alert('Login berhasil!');
                window.location.href='Home_siswa.php';
              </script>";

    } else {
        echo "<script>
                alert('Password salah!');
                window.location.href='login.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Username tidak ditemukan!');
            window.location.href='login.php';
          </script>";
}
?>
