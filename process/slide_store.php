<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

function save_image($file, $subdir = 'slides') {
  if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
    throw new Exception('Image upload failed');
  }
  $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'];
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  $mime  = finfo_file($finfo, $file['tmp_name']); finfo_close($finfo);
  if (!isset($allowed[$mime])) throw new Exception('Unsupported image type (use jpg/png/webp)');
  if ($file['size'] > 3 * 1024 * 1024) throw new Exception('Image too large (max 3MB)');

  $ext = $allowed[$mime];
  $name = uniqid('slide_', true) . '.' . $ext;

  $targetDirFs = __DIR__ . "/../uploads/{$subdir}";
  if (!is_dir($targetDirFs)) mkdir($targetDirFs, 0775, true);

  $targetFs = $targetDirFs . '/' . $name;
  if (!move_uploaded_file($file['tmp_name'], $targetFs)) {
    throw new Exception('Failed to save image');
  }

  return "/Mathematics-and-Statistical-Circle-NSBM/uploads/{$subdir}/{$name}";
}

try {
  // CSRF
  verify_csrf($_POST['csrf'] ?? '');

  
  $title        = trim($_POST['title'] ?? '');
  $date_label   = trim($_POST['date_label'] ?? '');
  $position     = max(0, min(5, (int)($_POST['position'] ?? 0))); // clamp 0..5
  $is_published = isset($_POST['is_published']) ? 1 : 0;

  if ($title === '' || $date_label === '') {
    throw new Exception('Please fill all fields');
  }

  
  if ($is_published === 1) {
    $count = (int)($pdo->query('SELECT COUNT(*) AS c FROM slides WHERE is_published=1')->fetch()['c'] ?? 0);
    if ($count >= 6) {
      throw new Exception('Max 6 published slides allowed. Unpublish one first.');
    }
  }

  
  $imgPath = save_image($_FILES['image'] ?? null, 'slides');

  
  $stmt = $pdo->prepare('
    INSERT INTO slides (title, date_label, image_path, position, is_published)
    VALUES (?,?,?,?,?)
  ');
  $stmt->execute([$title, $date_label, $imgPath, $position, $is_published]);

  
  $slideId = (int)$pdo->lastInsertId();
  log_activity($pdo, 'slide', $slideId, 'create', $title, [
    'position'  => $position,
    'published' => (bool)$is_published
  ]);
  if ($is_published === 1) {
    log_activity($pdo, 'slide', $slideId, 'publish', $title);
  }

  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/slides_list.php?ok=1');
  exit;

} catch (Exception $e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/slides_create.php?err=' . urlencode($e->getMessage()));
  exit;
}
