<?php
include "../koneksi.php";

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Cek apakah username sudah ada
$cek = mysqli_query($conn, "SELECT * FROM siswa WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
            alert('Username sudah digunakan!');
            window.location.href='register.php';
          </script>";
    exit;
}

// Simpan ke database
$query = mysqli_query($conn, "INSERT INTO siswa (username, password) VALUES ('$username', '$password')");

if ($query) {
    echo "<script>
            alert('Akun berhasil dibuat, silakan login');
            window.location.href='login.php';
          </script>";
} else {
    echo "Gagal menyimpan data: " . mysqli_error($conn);
}
?>
