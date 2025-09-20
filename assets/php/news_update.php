<?php
include 'extract.php'; 
include 'auth.php';


function save_image($file, $name)
{
  $targetFs = "assets/image/news/{$name}.png";
  if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {return null;}
  else
  {
    $fullPath = "../../" . $targetFs;
    if (is_file($fullPath)) {unlink($fullPath);}
    if (!move_uploaded_file($file['tmp_name'], "../../" . $targetFs)) {throw new Exception('Failed to save image');}
    return $targetFs;
  }
}
try {
  $id = (int)($_POST['id'] ?? 0);
  if ($id <= 0) throw new Exception('Invalid ID');

  $stmt = $pdo->prepare('SELECT * FROM news WHERE id=?');
  $stmt->execute([$id]);
  $n = $stmt->fetch();
  if (!$n) throw new Exception('News not found');

  $title = trim($_POST['title'] ?? '');
  $oldtitle = trim($_POST['oldtitle'] ?? '');
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
  
  $fullP = "../../assets/image/news/" . $otitle;
  if (is_file($fullP)) {unlink($fullP);}
  $newImg = save_image($_FILES['image'] ?? null, $title);
  // If no new image uploaded, keep the old image path
  if (!$newImg) {$newImg = $n['image'];}

  $sql = 'UPDATE news SET title=?, category=?, author=?, publish_date=?, image=?, source_link=?, description=?, full_content=?'
       . ' WHERE id=?';

  $params = [$title, $category, $author, $publish_date, $newImg, $source_link, $description, $content];
  $params[] = $id;

  $pdo->prepare($sql)->execute($params);

  log_activity($pdo, 'news', $id, 'update', $title);

  header('Location: ../../admin/news_list.php?ok=1');
  exit;

}
catch (Exception $e)
{
  header('Location: ../../admin/news_edit.php?id='.(int)($_POST['id'] ?? 0).'&err='.urlencode($e->getMessage()));
  exit;
}
