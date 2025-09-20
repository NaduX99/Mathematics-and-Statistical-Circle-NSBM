<?php
  include 'extract.php'; 
  include 'auth.php';
  
  function save_image($file, $name)
  {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {return null;}
    $targetFs = "assets/image/events/{$name}.png";
    if (!move_uploaded_file($file['tmp_name'],"../../" . $targetFs)) {throw new Exception('Failed to save image');}
    return $targetFs;
  }

  // category finding
  $eventDateInput = $_POST['date_happened'] ?? '';
  $eventDate = DateTime::createFromFormat("Y-m-d", $eventDateInput); // <- updated
  if (!$eventDate) { throw new Exception("Invalid date format: {$eventDateInput}"); }
  $today = new DateTime("today");
  $category = ($eventDate >= $today) ? "upcoming" : "past";

  try
  {
    $title = trim($_POST['title'] ?? '');
    $date  = $_POST['date_happened'] ?? '';
    $desc  = trim($_POST['description'] ?? '');
    
    if ($title === '' || $date === '' || $desc === '') {throw new Exception('Please fill all fields');}

    $imgPath = save_image($_FILES['image'] ?? null, $title);
    $stmt = $pdo->prepare('
      INSERT INTO events (title, description, date,category, image)
      VALUES (?,?,?,?,?)
    ');
    $stmt->execute([$title, $desc, $date, $category, $imgPath]);

    $eventId = (int)$pdo->lastInsertId();

    log_activity($pdo, 'event', $eventId, 'create', $title, ['date_happened' => $date]);
    header('Location: ../../admin/events_create.php?ok=1');
    exit;

  }
  catch (Exception $e)
  {
    header('Location: ../../admin/events_create.php?err=' . urlencode($e->getMessage()));
    exit;
  }
?>