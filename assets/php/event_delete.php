<?php
include 'extract.php'; 
include 'auth.php';
try {
  $id = (int)($_POST['id'] ?? 0);
  if ($id <= 0) {throw new Exception('Invalid event ID');}
  // Fetch title & image first (so we can log and remove the file)
  $stmt = $pdo->prepare('SELECT title, image FROM events WHERE id=?');
  $stmt->execute([$id]);
  $row = $stmt->fetch();
  if ($row)
  {
    log_activity($pdo, 'event', $id, 'delete', (string)$row['title']);
    $pdo->prepare('DELETE FROM events WHERE id=?')->execute([$id]);

    $url = $row['image'];
    
      $fs = '../../' . $url;
      if (is_file($fs)) {@unlink($fs);}
      // Delete the folder with all images for this event (if exists)
      $eventFolder = '../../assets/image/events/' . $id;
      if (is_dir($eventFolder))
      {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($eventFolder, RecursiveDirectoryIterator::SKIP_DOTS),RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $fileinfo)
        {
          $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
          $todo($fileinfo->getRealPath());
        }
        rmdir($eventFolder); // remove the now-empty folder
      }
  }
  header('Location: ../../admin/events_list.php?deleted=1');
  exit;

} catch (Exception $e)
{
  header('Location: ../../admin/events_list.php?err=' . urlencode($e->getMessage()));
  exit;
}
