<?php
include 'extract.php'; 
include 'auth.php';

function save_news_image($file, $name) {
  if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {return null;}
    $targetFs = "assets/image/news/{$name}.png";
    if (!move_uploaded_file($file['tmp_name'],"../../" . $targetFs)) {throw new Exception('Failed to save image');}
    return $targetFs;
}

try {
  
  $title = trim($_POST['title'] ?? '');
  $category = trim($_POST['category'] ?? '');
  $author = trim($_POST['author'] ?? '');
  $publish_date = $_POST['publish_date'] ?? '';
  $source_link = trim($_POST['source_link'] ?? '');
  $description = trim($_POST['description'] ?? '');
  $content = trim($_POST['content'] ?? '');

  if ($title === '' || $category === '' || $author === '' || $publish_date === '') {
    throw new Exception('Please fill all required fields');
  }

  if ($source_link !== '' && !filter_var($source_link, FILTER_VALIDATE_URL)) {
    throw new Exception('Invalid source link');
  }

  $imagePath = save_news_image($_FILES['image'] ?? null, $title);

  $stmt = $pdo->prepare('
    INSERT INTO news (title, category, author, publish_date, image, source_link, description, full_content)
    VALUES (?,?,?,?,?,?,?,?)
  ');
  $stmt->execute([$title, $category, $author, $publish_date, $imagePath, $source_link, $description, $content]);

  $newsId = (int)$pdo->lastInsertId();
  log_activity($pdo, 'news', $newsId, 'create', $title, ['publish_date'=>$publish_date]);

  header('Location: ../../admin/news_create.php?ok=1');
    exit;

} catch (Exception $e) {
  header('Location: ../../admin/news_create.php?err='.urlencode($e->getMessage()));
  exit;
}
