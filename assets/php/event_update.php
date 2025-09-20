<?php
include 'extract.php'; 
include 'auth.php';

function save_image($file, $name)
{
  $targetFs = "assets/image/events/{$name}.png";
  if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {return null;}
  else
  {
    $fullPath = "../../" . $targetFs;
    if (is_file($fullPath)) {unlink($fullPath);}
    if (!move_uploaded_file($file['tmp_name'], "../../" . $targetFs)) {throw new Exception('Failed to save image');}
    return $targetFs;
  }
}
// category finding
  $eventDateInput = $_POST['date_happened'] ?? '';
  $eventDate = DateTime::createFromFormat("Y-m-d", $eventDateInput); // <- updated
  if (!$eventDate) { throw new Exception("Invalid date format: {$eventDateInput}"); }
  $today = new DateTime("today");
  $category = ($eventDate >= $today) ? "upcoming" : "past";
try
{ 
  $id    = (int)($_POST['id'] ?? 0);
  if ($id <= 0) throw new Exception('Invalid event ID');

  $title = trim($_POST['title'] ?? '');
  $date  = $_POST['date_happened'] ?? '';
  $desc  = trim($_POST['description'] ?? '');
  
  if ($title === '' || $date === '' || $desc === '') throw new Exception('Please fill all fields');

  $stmt = $pdo->prepare('SELECT * FROM events WHERE id=?');
  $stmt->execute([$id]);
  $e = $stmt->fetch();
  if (!$e) throw new Exception('Event not found');
  $fullP = "../../assets/image/events/" . $title;
  if (is_file($fullP)) {unlink($fullP);}
  $newImage = save_image($_FILES['image'] ?? null, $title);
  // If no new image uploaded, keep the old image path
  if (!$newImage) {$newImage = $e['image'];}
  $sql = 'UPDATE events 
          SET title=?, description=?, date=?, category=?, image=? '
         . ' WHERE id=?';
  $params = [$title, $desc, $date, $category, $newImage, $id];

  $upd = $pdo->prepare($sql);
  $upd->execute($params);

  log_activity($pdo, 'event', $id, 'update', $title, ['date_happened' => $date]);

  header('Location: ../../admin/events_list.php?ok=1');
  exit;

}
catch (Exception $e)
{
  header('Location: ../../admin/events_edit.php?id='.(int)($_POST['id'] ?? 0).'&err='.urlencode($e->getMessage()));
  exit;
}
