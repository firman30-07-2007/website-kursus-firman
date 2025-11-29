<?php
session_start();

// CEK APAKAH SUDAH LOGIN
if (!isset($_SESSION['login_siswa'])) {
    header("Location: /projek_pkl/siswa/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Tabungan - Umum</title>
<style>
  /* === CSS TETAP SAMA === */
  :root {
    --bg: #eef3fa;
    --card: #fff;
    --accent: #2563eb;
    --accent-dark: #1e40af;
    --muted: #6b7280;
    --radius: 18px;
    --shadow: 0 8px 25px rgba(0,0,0,0.1);
  }
  body {
    font-family: "Poppins", sans-serif;
    background: var(--bg);
    margin: 0;
    color: #111827;
    display: flex;
    min-height: 100vh;
  }

  .sidebar {
    width: 230px;
    background: linear-gradient(180deg, #1e40af, #2563eb);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 25px 0;
    box-shadow: var(--shadow);
  }
  .sidebar h2 { text-align: center; font-size: 1.3rem; margin-bottom: 20px; font-weight: 700; }
  .menu { display: flex; flex-direction: column; gap: 10px; padding: 0 20px; }
  .menu a { color: white; text-decoration: none; padding: 10px 14px; border-radius: 10px; transition: 0.3s; }
  .menu a:hover, .menu a.active { background: rgba(255,255,255,0.2); }
  .logout { text-align: center; margin-top: 20px; }
  .logout a { color: #fca5a5; text-decoration: none; font-weight: 600; }

  .content { flex: 1; display: flex; flex-direction: column; }
  header { background: var(--accent); color: white; padding: 1rem; text-align: center; font-size: 1.4rem; font-weight: 600; box-shadow: var(--shadow); }
  main { max-width: 950px; margin: 30px auto; padding: 0 20px 40px; }

  .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 20px; margin-bottom: 40px; }
  .card { background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); padding: 22px; text-align: center; }
  .card h2 { font-size: 1.1rem; color: var(--muted); }
  .readonly { font-size: 1.1rem; font-weight: bold; color: var(--accent); background: #f3f4f6; padding: 10px; border-radius: 10px; }

  .progress-container { background: #e5e7eb; border-radius: 50px; height: 16px; overflow: hidden; }
  .progress-bar { height: 100%; background: linear-gradient(90deg, #2563eb, #1e40af); width: 0%; border-radius: 50px; transition: width 0.5s ease; }

  table { width: 100%; border-collapse: collapse; background: var(--card); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; }
  th, td { text-align: center; padding: 12px; border-bottom: 1px solid #e5e7eb; }
  th { background: var(--accent); color: white; }

  img { width: 70px; height: 70px; object-fit: cover; border-radius: 10px; cursor: zoom-in; transition: 0.3s; }
  img:hover { transform: scale(1.05); }

  .modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); justify-content: center; align-items: center; flex-direction: column; }
  .modal img { max-width: 90%; max-height: 80%; border-radius: 12px; }
  .close-btn { position: absolute; top: 20px; right: 35px; font-size: 40px; color: white; cursor: pointer; }
  .print-btn { margin-top: 15px; background: #10b981; color: white; border: none; padding: 10px 20px; border-radius: 12px; cursor: pointer; }
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <div>
    <h2>SPP Siswa</h2>
    <div class="menu">
      <a href="Home_siswa.php" class="active">Dashboard</a>
      <a href="pembayaran_kursus.html">Pembayaran Kursus</a>
      <a href="pendaftaran.html">Pendaftaran</a>
      <a href="riwayat.html">Riwayat</a>
    </div>
  </div>

  <div class="logout">
    <a href="/projek_pkl/siswa/logout.php">Logout</a>
  </div>
</div>

<!-- CONTENT -->
<div class="content">
  <header>Dashboard SPP Siswa</header>

  <main>
    <div class="cards">
      <div class="card">
        <h2>Total Setoran (Rp)</h2>
        <div id="totalSetoran" class="readonly">0</div>
      </div>
      <div class="card">
        <h2>Target Setoran (Rp)</h2>
        <div id="targetSetoran" class="readonly">0</div>
      </div>
      <div class="card">
        <h2>Progress Pembayaran</h2>
        <p id="persenBayar" style="font-weight:bold;color:var(--accent);">0%</p>
        <div class="progress-container"><div class="progress-bar" id="progressBar"></div></div>
      </div>
    </div>

    <h2>Riwayat Transaksi</h2>
    <table id="tabelTransaksi">
      <thead>
        <tr>
          <th>No</th><th>Nama</th><th>Tanggal</th><th>Metode</th><th>Nominal</th><th>Foto Bukti</th><th>Status</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </main>
</div>

<!-- MODAL -->
<div id="imageModal" class="modal">
  <span class="close-btn">&times;</span>
  <img id="modalImg" src="" alt="Zoom">
  <button class="print-btn" id="printBtn">Cetak</button>
</div>

<script>
  /* === SCRIPT LOCALSTORAGE TETAP SAMA === */

  function loadData() {
    const dataTransaksi = JSON.parse(localStorage.getItem('dataTransaksi')) || [];
    const total = parseInt(localStorage.getItem('totalSetoran')) || 0;
    const target = parseInt(localStorage.getItem('targetSetoran')) || 1000000;

    document.getElementById('totalSetoran').textContent = total.toLocaleString('id-ID');
    document.getElementById('targetSetoran').textContent = target.toLocaleString('id-ID');

    const tbody = document.querySelector('#tabelTransaksi tbody');
    tbody.innerHTML = '';

    if (dataTransaksi.length === 0) {
      tbody.innerHTML = '<tr><td colspan="7" style="color:gray;">Belum ada transaksi</td></tr>';
      return;
    }

    dataTransaksi.forEach((t, i) => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${i + 1}</td>
        <td>${t.nama}</td>
        <td>${t.tanggal}</td>
        <td>${t.metode}</td>
        <td>Rp ${t.nominal.toLocaleString('id-ID')}</td>
        <td><img src="${t.foto}" class="zoomable"></td>
        <td style="color:green;font-weight:bold;">${t.status}</td>
      `;
      tbody.appendChild(tr);
    });

    updateProgress(total, target);
    enableZoomAndPrint();
  }

  function updateProgress(total, target) {
    const persen = Math.min(Math.round((total / target) * 100), 100);
    document.getElementById('persenBayar').textContent = persen + '%';
    document.getElementById('progressBar').style.width = persen + '%';
  }

  function enableZoomAndPrint() {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImg');
    const closeBtn = document.querySelector('.close-btn');

    document.querySelectorAll('.zoomable').forEach(img => {
      img.addEventListener('click', () => {
        modal.style.display = 'flex';
        modalImg.src = img.src;
      });
    });

    closeBtn.onclick = () => modal.style.display = 'none';
  }

  loadData();
</script>


</body>
</html>
