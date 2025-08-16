<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

function save_image($file, $subdir = 'slides') {
  if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) return null; // no new image
  $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime  = finfo_file($finfo, $file['tmp_name']); finfo_close($finfo);
  if (!isset($allowed[$mime])) throw new Exception('Unsupported image type');
  if ($file['size'] > 3 * 1024 * 1024) throw new Exception('Image too large (max 3MB)');

  $ext = $allowed[$mime];
  $name = uniqid('slide_', true) . '.' . $ext;

  $dir = __DIR__ . "/../uploads/{$subdir}";
  if (!is_dir($dir)) mkdir($dir, 0775, true);
  $target = $dir . '/' . $name;
  if (!move_uploaded_file($file['tmp_name'], $target)) throw new Exception('Failed to save image');

  return "/Mathematics-and-Statistical-Circle-NSBM/uploads/{$subdir}/{$name}";
}

try {
  // CSRF
  verify_csrf($_POST['csrf'] ?? '');

  
  $id         = (int)($_POST['id'] ?? 0);
  if ($id <= 0) throw new Exception('Invalid slide ID');

  $title      = trim($_POST['title'] ?? '');
  $date_label = trim($_POST['date_label'] ?? '');
  $position   = max(0, min(5, (int)($_POST['position'] ?? 0))); // clamp 0..5
  $pub        = isset($_POST['is_published']) ? 1 : 0;

  if ($title === '' || $date_label === '') throw new Exception('Please fill all fields');

  
  $stmt = $pdo->prepare('SELECT * FROM slides WHERE id = ?');
  $stmt->execute([$id]);
  $s = $stmt->fetch();
  if (!$s) throw new Exception('Slide not found');

  
  if ($pub === 1 && (int)$s['is_published'] === 0) {
    $q = $pdo->prepare('SELECT COUNT(*) AS c FROM slides WHERE is_published = 1 AND id <> ?');
    $q->execute([$id]);
    $c = (int)($q->fetch()['c'] ?? 0);
    if ($c >= 6) throw new Exception('Max 6 published slides allowed. Unpublish one first.');
  }

  
  $newImage = save_image($_FILES['image'] ?? null, 'slides');
  if ($newImage) {
    
    $oldUrl = $s['image_path'];
    if (is_string($oldUrl) && strpos($oldUrl, '/Mathematics-and-Statistical-Circle-NSBM/') === 0) {
      $oldFs = __DIR__ . '/../' . ltrim(substr($oldUrl, strlen('/Mathematics-and-Statistical-Circle-NSBM/')), '/');
      if (is_file($oldFs)) @unlink($oldFs);
    }
  }

  
  $sql = 'UPDATE slides SET title = ?, date_label = ?, position = ?, is_published = ?'
       . ($newImage ? ', image_path = ?' : '')
       . ' WHERE id = ?';

  $params = [$title, $date_label, $position, $pub];
  if ($newImage) $params[] = $newImage;
  $params[] = $id;

  $pdo->prepare($sql)->execute($params);

  
  log_activity($pdo, 'slide', $id, 'update', $title);
  if ($newImage) {
    log_activity($pdo, 'slide', $id, 'upload_image', $title);
  }
  
  $prevPub = (int)$s['is_published'];
  if ($prevPub !== $pub) {
    log_activity($pdo, 'slide', $id, $pub ? 'publish' : 'unpublish', $title);
  }

  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/slides_list.php?ok=1');
  exit;

} catch (Exception $e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/slides_edit.php?id='.(int)($_POST['id'] ?? 0).'&err='.urlencode($e->getMessage()));
  exit;
}
