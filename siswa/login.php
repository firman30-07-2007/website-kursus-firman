<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Siswa</title>
  <style>
     /* ===== RESET DAN DASAR ===== */
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

    /* ===== KONTENER LOGIN ===== */
    .login-container {
      background: #fff;
      width: 90%;
      max-width: 380px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 40px 30px;
      text-align: center;
      animation: fadeIn 0.8s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .input-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .input-group label {
      font-weight: 500;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #0984e3;
      color: white;
      cursor: pointer;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login Siswa</h2>
      <form action="login_process.php" method="post">
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>

      <div class="input-group">
        <label>Kata Sandi</label>
        <input type="password" name="password" required>
      </div>

      <button type="submit" name="login" class="btn">Login</button>
    </form>

    <div class="register-link">
      Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>

  </div>
</body>
</html>
