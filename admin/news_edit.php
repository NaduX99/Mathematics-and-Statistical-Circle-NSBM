<?php
include '../assets/php/extract.php'; 
  include '../assets/php/auth.php';

$page_title = 'News';
$active = 'news_list';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM news WHERE id=?');
$stmt->execute([$id]);
$n = $stmt->fetch();
if (!$n) { header('Location: news_list.php?err=Not+found'); exit; }
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
<div class="form-page-container">
  
  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?></div>
  <?php endif; ?>

  <div class="form-card">
    <form action="../assets/php/news_update.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= (int)$n['id'] ?>">
      <input type="hidden" name="oldtitle" value="<?= htmlspecialchars($n['title']) ?>">
      <div class="form-grid">
        <div class="form-group">
          <label>Title</label>
          <input type="text" name="title" required value="<?= htmlspecialchars($n['title']) ?>">
        </div>

        <div class="form-group">
          <label>Category</label>
          <input type="text" name="category" required value="<?= htmlspecialchars($n['category']) ?>">
        </div>

        <div class="form-group">
          <label>Author</label>
          <input type="text" name="author" required value="<?= htmlspecialchars($n['author']) ?>">
        </div>

        <div class="form-group">
          <label>Publish Date</label>
          <input type="date" name="publish_date" required value="<?= htmlspecialchars($n['publish_date']) ?>">
        </div>
      </div>

      <div class="form-group">
        <label>Source Link</label>
        <input type="url" name="source_link" value="<?= htmlspecialchars($n['source_link']) ?>">
      </div>

      <div class="form-group">
        <label>Current Image</label><br>
        <?php if ($n['image']): ?>
          <img src="../<?= htmlspecialchars($n['image']) ?>" alt="" >
        <?php else: ?>
          <em>No image</em>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label>Replace Image (optional)</label>
        <label class="upload-btn btn-primary">
            <i class="fas fa-upload"></i> Choose Image
            <input type="file" name="image" accept="image/*">
        </label>
       </div>

      <div class="form-group">
        <label>Short Description</label>
        <textarea name="description" rows="3"><?= htmlspecialchars($n['description']) ?></textarea>
      </div>

      <div class="form-group">
        <label>Content</label>
        <textarea name="content" rows="10"><?= htmlspecialchars($n['full_content']) ?></textarea>
      </div>

      <div class="form-actions">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Update News
              </button>
              <a href="news_list.php" class="btn btn-outline">
                Cancel
              </a>
            </div>
    </form>
  </div>
</div>
<!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
    </body>
</html>