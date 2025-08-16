<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

try {
  // CSRF protection
  verify_csrf($_POST['csrf'] ?? '');

  $id = (int)($_POST['id'] ?? 0);
  if ($id <= 0) {
    throw new Exception('Invalid event ID');
  }

  // Fetch title & image first (so we can log and remove the file)
  $stmt = $pdo->prepare('SELECT title, image_path FROM events WHERE id=?');
  $stmt->execute([$id]);
  $row = $stmt->fetch();

  if ($row) {
    // Log delete action BEFORE deleting the row
    log_activity($pdo, 'event', $id, 'delete', (string)$row['title']);

    // Delete DB row
    $pdo->prepare('DELETE FROM events WHERE id=?')->execute([$id]);

    // Best-effort image file cleanup (ignore errors)
    $url = $row['image_path'];
    if (is_string($url) && strpos($url, '/Mathematics-and-Statistical-Circle-NSBM/') === 0) {
      $fs = __DIR__ . '/../' . ltrim(substr($url, strlen('/Mathematics-and-Statistical-Circle-NSBM/')), '/');
      if (is_file($fs)) {
        @unlink($fs);
      }
    }
  }

  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php?deleted=1');
  exit;
} catch (Exception $e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php?err=' . urlencode($e->getMessage()));
  exit;
}
