<?php
session_start();
include "koneksi.php";

// Jika form tambah disubmit → simpan ke database
if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $nisn  = $_POST['nisn'];
    $status = $_POST['status'];

    $query = mysqli_query($conn, "INSERT INTO data_siswa (nama, kelas, nisn, status_pembayaran)
                                  VALUES ('$nama', '$kelas', '$nisn', '$status')");

    if ($query) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Gagal menambah data!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Siswa - SPP Pembayaran</title>

  <style>
    /* === CSS TIDAK DIUBAH (PERSIS PUNYA KAMU) === */
    *{margin:0;padding:0;box-sizing:border-box;font-family:"Poppins",sans-serif}
    body{min-height:100vh;background:#f8fafc;color:#0f172a;display:flex;overflow-x:hidden;}
    .sidebar{width:250px;background:linear-gradient(180deg,#7c3aed,#06b6d4);color:#fff;display:flex;flex-direction:column;justify-content:space-between;position:fixed;top:0;left:0;bottom:0;box-shadow:2px 0 20px rgba(0,0,0,0.1);}
    .logo{padding:24px 20px;font-weight:700;font-size:20px;display:flex;align-items:center;gap:10px;background:rgba(255,255,255,0.08);}
    nav{display:flex;flex-direction:column;padding:20px;}
    nav a{padding:12px 16px;border-radius:10px;color:#f1f5f9;font-weight:500;transition:0.2s;display:flex;align-items:center;gap:10px;}
    nav a:hover,nav a.active{background:rgba(255,255,255,0.15);color:#fff;}
    .bottom{padding:20px;border-top:1px solid rgba(255,255,255,0.2);}
    .bottom a{color:#f87171;font-weight:600;text-decoration:none;display:block;text-align:center;}
    main{margin-left:250px;flex:1;padding:24px;display:flex;flex-direction:column;gap:24px;transition:margin-left 0.3s;}
    header{display:flex;align-items:center;justify-content:space-between;background:#fff;padding:14px 20px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,0.05);}
    header h1{font-size:20px;}
    .menu-btn{display:none;background:transparent;border:none;font-size:22px;cursor:pointer;}
    .top-bar{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;}
    .search-box input{padding:10px 14px;border:1px solid #cbd5e1;border-radius:10px;width:240px;font-size:14px;}
    .btn-add{background:linear-gradient(90deg,#7c3aed,#06b6d4);border:none;color:#fff;padding:10px 16px;font-weight:600;border-radius:10px;cursor:pointer;transition:.2s;box-shadow:0 4px 12px rgba(99,102,241,0.2);}
    .btn-add:hover{transform:translateY(-1px);box-shadow:0 8px 18px rgba(99,102,241,0.25);}
    .table-wrap{background:#fff;border-radius:14px;padding:20px;box-shadow:0 3px 14px rgba(0,0,0,0.06);overflow:auto;}
    table{width:100%;border-collapse:collapse;min-width:700px;}
    th,td{text-align:left;padding:12px 10px;}
    th{background:#f1f5f9;color:#334155;font-size:14px;}
    tr:nth-child(even){background:#f9fafb;}
    td{font-size:14px;color:#0f172a;}
    .status-lunas{color:#16a34a;font-weight:600;}
    .status-belum{color:#dc2626;font-weight:600;}
    .modal{position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.4);display:none;align-items:center;justify-content:center;z-index:10;}
    .modal.active{display:flex;}
    .modal-content{background:#fff;padding:24px;border-radius:14px;width:90%;max-width:420px;box-shadow:0 8px 26px rgba(0,0,0,0.1);animation:fadeIn .3s ease;}
    @keyframes fadeIn{from{opacity:0;transform:translateY(-10px);}to{opacity:1;transform:translateY(0);}}
    .modal-content h2{margin-bottom:16px;}
    .form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:12px;}
    .form-group label{font-size:14px;font-weight:600;}
    .form-group input,.form-group select{padding:10px 12px;border:1px solid #cbd5e1;border-radius:10px;font-size:14px;}
    .modal-buttons{display:flex;justify-content:flex-end;gap:10px;margin-top:8px;}
    .btn-cancel{background:#e2e8f0;border:none;padding:8px 14px;border-radius:10px;cursor:pointer;}
    .btn-save{background:linear-gradient(90deg,#7c3aed,#06b6d4);border:none;color:#fff;font-weight:600;padding:8px 16px;border-radius:10px;cursor:pointer;}
  </style>
</head>
<body>

  <aside class="sidebar" id="sidebar">
    <div>
      <div class="logo"><span>SPP Admin</span></div>

      <nav>
        <a href="Home_admin.php" class="active">Dashboard</a>
        <a href="laporankeuangan.html">Laporan Keuangan</a>
        <a href="riwayat_pendaftaran.html">Riwayat Pendaftaran</a>
        <a href="tabungan.html">Riwayat SPP Siswa</a>
      </nav>
    </div>

    <div class="bottom">
      <a href="logout.php">Logout</a>
    </div>
  </aside>

  <main>
    <header>
      <h1>Data Siswa</h1>
    </header>

    <div class="top-bar">
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari siswa...">
      </div>
      <button class="btn-add" id="btnAdd">+ Tambah Siswa</button>
    </div>

    <section class="table-wrap">
      <table id="tabelSiswa">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>NISN</th>
            <th>Status Pembayaran</th>
          </tr>
        </thead>
        <tbody>

        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM data_siswa ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($data)) {
            echo "
                <tr>
                    <td>$no</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['kelas']}</td>
                    <td>{$row['nisn']}</td>
                    <td class='".($row['status_pembayaran']=="Lunas"?"status-lunas":"status-belum")."'>{$row['status_pembayaran']}</td>
                </tr>
            ";
            $no++;
        }
        ?>

        </tbody>
      </table>
    </section>

  </main>

  <!-- Modal Tambah -->
  <div class="modal" id="modal">
    <div class="modal-content">
      <h2>Tambah Data Siswa</h2>

      <form method="POST">
        <div class="form-group">
          <label>Nama Siswa</label>
          <input type="text" name="nama" required>
        </div>

        <div class="form-group">
          <label>Kelas</label>
          <select name="kelas" required>
            <option value="">-- Pilih Kelas --</option>
            <option>X RPL 1</option>
            <option>XII RPL 1</option>
            <option>XI AKL 2</option>
          </select>
        </div>

        <div class="form-group">
          <label>NISN</label>
          <input type="text" name="nisn" required>
        </div>

        <div class="form-group">
          <label>Status Pembayaran</label>
          <select name="status">
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
          </select>
        </div>

        <div class="modal-buttons">
          <button type="button" class="btn-cancel" id="btnCancel">Batal</button>
          <button type="submit" name="simpan" class="btn-save">Simpan</button>
        </div>
      </form>

    </div>
  </div>

<script>
  const modal=document.getElementById("modal");
  const btnAdd=document.getElementById("btnAdd");
  const btnCancel=document.getElementById("btnCancel");

  btnAdd.onclick=()=>modal.classList.add("active");
  btnCancel.onclick=()=>modal.classList.remove("active");

  window.onclick=e=>{if(e.target===modal)modal.classList.remove("active");};
</script>

</body>
</html>
