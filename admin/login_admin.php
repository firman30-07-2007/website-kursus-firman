<?php
session_start();

// Jika sudah login, langsung masuk
if (isset($_SESSION['admin_login'])) {
    header("Location: Home_admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <style>
    /* CSS sama persis seperti punyamu */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", sans-serif; }
    body {
      height: 100vh; display: flex; align-items: center; justify-content: center;
      background: linear-gradient(135deg, #74b9ff, #a29bfe);
    }
    .login-container {
      background: #fff; width: 90%; max-width: 380px; border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      padding: 40px 30px; text-align: center; animation: fadeIn 0.8s ease;
    }
    @keyframes fadeIn { from {opacity:0; transform:translateY(-15px);} to {opacity:1; transform:translateY(0);} }
    .login-container h2 { color:#2d3436; margin-bottom:15px; font-weight:600; }
    .login-container p { color:#636e72; margin-bottom:25px; font-size:14px; }
    .input-group { margin-bottom:20px; text-align:left; }
    .input-group label { display:block; margin-bottom:6px; font-weight:500; color:#2d3436; font-size:14px; }
    .input-group input {
      width:100%; padding:10px 12px; border:1px solid #dfe6e9; border-radius:8px; font-size:14px;
      transition:0.3s;
    }
    .input-group input:focus {
      border-color:#0984e3; outline:none; box-shadow:0 0 5px rgba(9,132,227,0.2);
    }
    .btn {
      width:100%; background:#0984e3; color:#fff; padding:12px; border:none; border-radius:8px;
      cursor:pointer; font-weight:600; font-size:15px; transition:0.3s;
    }
    .btn:hover { background:#74b9ff; }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Login admin</h2>
    <p>Silakan login untuk melanjutkan ke sistem</p>
    
<form action="proses_login_admin.php" method="post">
  <div class="input-group">
    <label>Username</label>
    <input type="text" name="username" required placeholder="Masukkan username">
  </div>

  <div class="input-group">
    <label>Kata Sandi</label>
    <input type="password" name="password" required placeholder="Masukkan kata sandi">
  </div>

  <button type="submit" class="btn">Login</button>
</form>

  </div>

</body>
</html>
