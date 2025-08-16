<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

date_default_timezone_set('Asia/Colombo');

function save_image($file, $subdir = 'events') {
  if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
    throw new Exception('Image upload failed');
  }
  $allowed = ['image/jpeg'=>'jpg', 'image/png'=>'png', 'image/webp'=>'webp'];
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime  = finfo_file($finfo, $file['tmp_name']); finfo_close($finfo);
  if (!isset($allowed[$mime])) throw new Exception('Unsupported image type (use jpg/png/webp)');
  if ($file['size'] > 3 * 1024 * 1024) throw new Exception('Image too large (max 3MB)');

  $ext = $allowed[$mime];
  $name = uniqid('evt_', true) . '.' . $ext;

  $targetDirFs = __DIR__ . "/../uploads/{$subdir}";
  if (!is_dir($targetDirFs)) mkdir($targetDirFs, 0775, true);

  $targetFs = $targetDirFs . '/' . $name;
  if (!move_uploaded_file($file['tmp_name'], $targetFs)) {
    throw new Exception('Failed to save image');
  }
  return "/Mathematics-and-Statistical-Circle-NSBM/uploads/{$subdir}/{$name}";
}

function clean_hex(?string $v): ?string {
  if ($v === null) return null;
  $v = trim($v);
  if ($v === '') return null;
  if (preg_match('/^#[0-9A-Fa-f]{6}$/', $v)) return strtoupper($v);
  throw new Exception('Colors must be 6-digit hex like #123ABC');
}

try {
  // CSRF
  verify_csrf($_POST['csrf'] ?? '');

  $title = trim($_POST['title'] ?? '');
  $date  = $_POST['date_happened'] ?? '';
  $desc  = trim($_POST['description'] ?? '');
  $pub   = isset($_POST['is_published']) ? 1 : 0;

  $start = isset($_POST['start_color']) ? clean_hex($_POST['start_color']) : null;
  $end   = isset($_POST['end_color'])   ? clean_hex($_POST['end_color'])   : null;
  $angle = isset($_POST['gradient_angle']) && $_POST['gradient_angle'] !== '' ? (int)$_POST['gradient_angle'] : null;
  if ($angle !== null && ($angle < 0 || $angle > 360)) throw new Exception('Angle must be 0–360');

  if ($title === '' || $date === '' || $desc === '') {
    throw new Exception('Please fill all fields');
  }

  $imgPath = save_image($_FILES['image'], 'events');

  $stmt = $pdo->prepare('
    INSERT INTO events (title, date_happened, description, image_path, is_published, start_color, end_color, gradient_angle)
    VALUES (?,?,?,?,?,?,?,?)
  ');
  $stmt->execute([$title, $date, $desc, $imgPath, $pub, $start, $end, $angle]);

  
  $eventId = (int)$pdo->lastInsertId();
  log_activity($pdo, 'event', $eventId, 'create', $title, ['date_happened' => $date, 'published' => (bool)$pub]);
  if ($pub === 1) {
    log_activity($pdo, 'event', $eventId, 'publish', $title);
  }

  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php?ok=1');
  exit;
} catch (Exception $e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_create.php?err=' . urlencode($e->getMessage()));
  exit;
}
