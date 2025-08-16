<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

function save_image($file, $subdir = 'events') {
  if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) return null; // no new image
  $allowed = ['image/jpeg'=>'jpg', 'image/png'=>'png', 'image/webp'=>'webp'];
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime  = finfo_file($finfo, $file['tmp_name']); finfo_close($finfo);
  if (!isset($allowed[$mime])) throw new Exception('Unsupported image type');
  if ($file['size'] > 3 * 1024 * 1024) throw new Exception('Image too large (max 3MB)');

  $ext = $allowed[$mime];
  $name = uniqid('evt_', true) . '.' . $ext;

  $dir = __DIR__ . "/../uploads/{$subdir}";
  if (!is_dir($dir)) mkdir($dir, 0775, true);

  $target = $dir . '/' . $name;
  if (!move_uploaded_file($file['tmp_name'], $target)) throw new Exception('Failed to save image');

  return "/Mathematics-and-Statistical-Circle-NSBM/uploads/{$subdir}/{$name}";
}

function clean_hex_nullable($v) {
  $v = isset($v) ? trim($v) : '';
  if ($v === '') return null;
  if (preg_match('/^#[0-9A-Fa-f]{6}$/', $v)) return strtoupper($v);
  throw new Exception('Colors must be 6-digit hex like #123ABC');
}

try {
  // CSRF
  verify_csrf($_POST['csrf'] ?? '');

  
  $id    = (int)($_POST['id'] ?? 0);
  if ($id <= 0) throw new Exception('Invalid event ID');

  $title = trim($_POST['title'] ?? '');
  $date  = $_POST['date_happened'] ?? '';
  $desc  = trim($_POST['description'] ?? '');
  $pub   = isset($_POST['is_published']) ? 1 : 0;

  $start = clean_hex_nullable($_POST['start_color'] ?? '');
  $end   = clean_hex_nullable($_POST['end_color'] ?? '');
  $angle = ($_POST['gradient_angle'] === '' ? null : (int)$_POST['gradient_angle']);
  if ($angle !== null && ($angle < 0 || $angle > 360)) throw new Exception('Angle must be 0–360');

  if ($title === '' || $date === '' || $desc === '') throw new Exception('Please fill all fields');

 
  $stmt = $pdo->prepare('SELECT * FROM events WHERE id=?');
  $stmt->execute([$id]);
  $e = $stmt->fetch();
  if (!$e) throw new Exception('Event not found');

  
  $newImage = save_image($_FILES['image'] ?? null, 'events');
  if ($newImage) {
 
    $oldUrl = $e['image_path'];
    if (is_string($oldUrl) && strpos($oldUrl, '/Mathematics-and-Statistical-Circle-NSBM/') === 0) {
      $oldFs = __DIR__ . '/../' . ltrim(substr($oldUrl, strlen('/Mathematics-and-Statistical-Circle-NSBM/')), '/'); 
      if (is_file($oldFs)) @unlink($oldFs);
    }
  }


  $sql = 'UPDATE events 
          SET title=?, date_happened=?, description=?, is_published=?, start_color=?, end_color=?, gradient_angle=?'
         . ($newImage ? ', image_path=?' : '')
         . ' WHERE id=?';
  $params = [$title, $date, $desc, $pub, $start, $end, $angle];
  if ($newImage) $params[] = $newImage;
  $params[] = $id;


  $upd = $pdo->prepare($sql);
  $upd->execute($params);

 
  log_activity($pdo, 'event', (int)$id, 'update', $title);
  if ($newImage) {
    log_activity($pdo, 'event', (int)$id, 'upload_image', $title);
  }

  $prevPub = (int)$e['is_published'];
  if ($prevPub !== $pub) {
    log_activity($pdo, 'event', (int)$id, $pub ? 'publish' : 'unpublish', $title);
  }

  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php?ok=1');
  exit;

} catch (Exception $e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_edit.php?id='.(int)($_POST['id'] ?? 0).'&err='.urlencode($e->getMessage()));
  exit;
}
