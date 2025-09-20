<?php
  $DB_HOST = 'localhost';
  $DB_NAME = 'mascwebsite';
  $DB_USER = 'root';
  $DB_PASS = ''; 

  try
  {
    $pdo = new PDO(
      "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
      $DB_USER,
      $DB_PASS,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]
    );
  }
  catch (Exception $e) {die('DB connection failed: ' . htmlspecialchars($e->getMessage()));}

  // Global app timezone
  date_default_timezone_set('Asia/Colombo');

  try {$pdo->exec("SET time_zone = '+05:30'");}
  catch (Throwable $e) {}

  if (session_status() === PHP_SESSION_NONE) session_start();

    if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(32)); }
    function csrf_token() { return $_SESSION['csrf']; }
    function verify_csrf($t) {
    if (!isset($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], (string)$t)) {
        throw new Exception('Invalid CSRF token');
    }
    }
?>