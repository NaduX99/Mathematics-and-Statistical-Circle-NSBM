<?php
include '../assets/php/extract.php'; 
include '../assets/php/auth.php'; // Ensure only logged-in admins can access
$page_title = 'Change Password';
$active = 'change_password';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $newPassword = $_POST['new_password'];
    $confirm = $_POST['confirm'];

    if ($newPassword !== $confirm) {
        $message = "Passwords do not match!";
    } else {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE admin_users SET password_hash = ? WHERE username = ?");
        if ($stmt->execute([$hash, $username])) {
            $message = "Password updated successfully!";
        } else {
            $message = "Error updating password.";
        }
    }
}

// Fetch all admin usernames for the dropdown
$stmt = $pdo->query("SELECT username FROM admin_users");
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
    <div class="form-page-container" style="background-color: #000000;color: #ffffff;">
        <?php if($message) echo "<p>$message</p>"; ?>
        <form method="post">
            <label>Select Admin:
                <select name="username">
                    <?php foreach ($admins as $admin): ?>
                        <option value="<?= htmlspecialchars($admin['username']) ?>"><?= htmlspecialchars($admin['username']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label><br><br>
            <label>New Password:<br><br><input type="password" name="new_password" required></label><br><br>
            <label>Confirm Password:<br><br><input type="password" name="confirm" required></label><br><br>
            <button type="submit">Change Password</button>
        </form>
    </div>
    <!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
</body>
</html>
