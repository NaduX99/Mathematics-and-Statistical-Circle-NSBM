<?php
require_once __DIR__ . '/../config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  $stmt = $pdo->prepare('SELECT * FROM admin_users WHERE username = ? LIMIT 1');
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['admin_id'] = $user['id'];
    $_SESSION['admin_username'] = $user['username'];
    header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/dashboard.php');
    exit;
  } else {
    $error = 'Invalid username or password';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | Mathematics & Statistics Circle - NSBM</title>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <style>
    :root {
      --color-white: #ffffff;
      --color-green: #4caf50;
      --color-dark: #36453b;
      --color-error: #e74c3c;
      --border-radius: 8px;
    }
    
    body {
      font-family: 'Work Sans', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-image: linear-gradient(
          180deg,
          rgba(145, 145, 145, 0.5) 0%,
          rgba(70, 87, 57, 1) 100%
        ),
        url('/Mathematics-and-Statistical-Circle-NSBM/img/bgImageEvent.png');
      background-size: cover;
      background-position: center;
    }
    
    .login-container {
      background-color: var(--color-white);
      border-radius: var(--border-radius);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 420px;
      padding: 40px;
      margin: 20px;
    }
    
    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .login-header h2 {
      color: var(--color-dark);
      margin: 0 0 10px;
      font-weight: 700;
    }
    
    .login-header img {
      height: 60px;
      margin-bottom: 15px;
    }
    
    .error-message {
      color: var(--color-error);
      background-color: rgba(231, 76, 60, 0.1);
      padding: 12px;
      border-radius: var(--border-radius);
      margin-bottom: 20px;
      text-align: center;
      font-size: 14px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: var(--color-dark);
      font-weight: 500;
      font-size: 14px;
    }
    
    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: var(--border-radius);
      font-size: 16px;
      transition: all 0.3s;
      box-sizing: border-box;
    }
    
    .form-group input:focus {
      border-color: var(--color-green);
      outline: none;
      box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
    }
    
    .login-button {
      width: 100%;
      padding: 14px;
      background-color: var(--color-green);
      color: var(--color-white);
      border: none;
      border-radius: var(--border-radius);
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 10px;
    }
    
    .login-button:hover {
      background-color: #3d8b40;
    }
    
    .login-footer {
      text-align: center;
      margin-top: 20px;
      color: #777;
      font-size: 14px;
    }
    
    @media (max-width: 480px) {
      .login-container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <img src="/Mathematics-and-Statistical-Circle-NSBM/Logo.png" alt="Mathematics & Statistics Circle Logo">
      <h2>Admin Portal</h2>
      <p>Mathematics & Statistics Circle - NSBM</p>
    </div>
    
    <?php if($error): ?>
      <div class="error-message">
        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
    
    <form method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      
      <button type="submit" class="login-button">
        <i class="fas fa-sign-in-alt"></i> Login
      </button>
    </form>
    
    <div class="login-footer">
      <p>Restricted access. Authorized personnel only.</p>
    </div>
  </div>
</body>
</html>