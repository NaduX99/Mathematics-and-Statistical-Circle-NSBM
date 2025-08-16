<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

try {
  // CSRF protection
  verify_csrf($_POST['csrf'] ?? '');

  $id = (int)($_POST['id'] ?? 0);
  if ($id <= 0) {
    throw new Exception('Invalid slide ID');
  }

  
  $stmt = $pdo->prepare('SELECT title, image_path FROM slides WHERE id=?');
  $stmt->execute([$id]);
  $row = $stmt->fetch();

  if ($row) {
  
    log_activity($pdo, 'slide', $id, 'delete', (string)$row['title']);


    $pdo->prepare('DELETE FROM slides WHERE id=?')->execute([$id]);

    $url = $row['image_path'];
    if (is_string($url) && strpos($url, '/Mathematics-and-Statistical-Circle-NSBM/') === 0) {
      $fs = __DIR__ . '/../' . ltrim(substr($url, strlen('/Mathematics-and-Statistical-Circle-NSBM/')), '/');
      if (is_file($fs)) {
        @unlink($fs);
      }
    }
  }

  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/slides_list.php?deleted=1');
  exit;

} catch (Exception $e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/slides_list.php?err=' . urlencode($e->getMessage()));
  exit;
}
