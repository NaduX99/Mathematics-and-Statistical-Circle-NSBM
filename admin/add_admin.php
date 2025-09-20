<?php
include '../assets/php/extract.php'; 
include '../assets/php/auth.php';
$page_title = 'Add Admin';
  $active = 'add_admin';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $message = "Passwords do not match!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO admin_users (username, password_hash, created_at) VALUES (?, ?, NOW())");
        if ($stmt->execute([$username, $hash])) {
            $message = "New admin added successfully!";
        } else {
            $message = "Error adding admin.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
    <div class="form-page-container" style="background-color: #000000;color: #ffffff;">
<?php if($message) echo "<p>$message</p>"; ?>
<form method="post">
    <label>Username:<br><br><input type="text" name="username" required></label><br><br>
    <label>Password:<br><br><input type="password" name="password" required></label><br><br>
    <label>Confirm Password:<br><br><input type="password" name="confirm" required></label><br><br>
    <button type="submit">Add Admin</button>
</form>
</body>
</html>
