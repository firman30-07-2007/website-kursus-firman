<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun Siswa</title>

  <style>
    /* ===== RESET ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #74b9ff, #a29bfe);
    }

    /* ===== KONTENER REGISTER ===== */
    .register-container {
      background: #fff;
      width: 90%;
      max-width: 400px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 40px 30px;
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .register-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2d3436;
    }

    /* ===== INPUT GROUP ===== */
    .input-group {
      margin-bottom: 20px;
    }

    .input-group label {
      display: block;
      font-weight: 500;
      margin-bottom: 6px;
      color: #2d3436;
    }

    .input-group input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #dfe6e9;
      border-radius: 8px;
      font-size: 14px;
      transition: 0.3s;
    }

    .input-group input:focus {
      border-color: #0984e3;
      box-shadow: 0 0 5px rgba(9,132,227,0.2);
      outline: none;
    }

    /* ===== TOMBOL ===== */
    .btn {
      width: 100%;
      background: #0984e3;
      color: #fff;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      font-size: 15px;
    }

    .btn:hover {
      background: #74b9ff;
    }

    .register-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .register-link a {
      color: #0984e3;
      text-decoration: none;
      font-weight: 500;
    }

    .register-link a:hover {
      text-decoration: underline;
    }
  </style>

</head>
<body>
  <div class="register-container">
    <h2>Daftar Akun Siswa</h2>

    <form action="register_process.php" method="post">

      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>

      <div class="input-group">
        <label>Kata Sandi</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit" class="btn">Daftar</button>
    </form>

    <div class="register-link">
      Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
  </div>
</body>
</html>
