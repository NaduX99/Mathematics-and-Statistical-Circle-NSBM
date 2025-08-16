<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

try {
  // CSRF
  verify_csrf($_POST['csrf'] ?? '');

  $id = (int)($_POST['id'] ?? 0);
  $state = isset($_POST['state']) && (int)$_POST['state'] === 1 ? 1 : 0;

  if ($id <= 0) {
    throw new Exception('Invalid event ID');
  }


  $q = $pdo->prepare('SELECT title, is_published FROM events WHERE id = ?');
  $q->execute([$id]);
  $row = $q->fetch();
  if (!$row) {
    throw new Exception('Event not found');
  }

  $current = (int)$row['is_published'];
  $title = (string)$row['title'];

  
  if ($current !== $state) {
    $stmt = $pdo->prepare('UPDATE events SET is_published = ? WHERE id = ?');
    $stmt->execute([$state, $id]);


    log_activity($pdo, 'event', $id, $state ? 'publish' : 'unpublish', $title);
  }

  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php?' . ($state ? 'pub=1' : 'unpub=1'));
  exit;

} catch (Exception $e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php?err=' . urlencode($e->getMessage()));
  exit;
}
