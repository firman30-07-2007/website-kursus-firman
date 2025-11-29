<?php
$koneksi = mysqli_connect("localhost", "root", "", "projek_pkl");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
