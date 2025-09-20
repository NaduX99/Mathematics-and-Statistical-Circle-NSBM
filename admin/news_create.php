<?php
include '../assets/php/extract.php'; 
include '../assets/php/auth.php';

$page_title = 'News';
$active = 'news_create';
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
<div class="form-page-container">
<?php if (isset($_GET['ok'])): ?>
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i> Event Saved successfully
        </div>
        <script> setTimeout(function() {window.location.href = 'news_create.php'; }, 3000); </script>
      <?php endif; ?>

  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?></div>
  <?php endif; ?>

  <div class="form-card">
    <form action="../assets/php/news_store.php" method="post" enctype="multipart/form-data">
      
      <div class="form-grid">
        <div class="form-group">
          <label>Title <span style="color:red">*</span></label>
          <input type="text" name="title" required>
        </div>

        <div class="form-group">
          <label>Category <span style="color:red">*</span></label>
          <input type="text" name="category" required>
        </div>

        <div class="form-group">
          <label>Author <span style="color:red">*</span></label>
          <input type="text" name="author" required>
        </div>

        <div class="form-group">
          <label>Publish Date<span style="color:red">*</span></label>
          <input type="date" name="publish_date" required>
        </div>
      </div>

      <div class="form-group">
        <label>Source Link (optional)</label>
        <input type="url" name="source_link" placeholder="https://...">
      </div>

      <div class="form-group">
        <label>Cover Image</label>
        <label class="upload-btn btn-primary">
          <i class="fas fa-upload"></i> Choose Image
          <input type="file" name="image" accept="image/*">
        </label>
      </div>

      <div class="form-group">
        <label>Short Description</label>
        <textarea name="description" rows="3" placeholder="One or two lines summary..."></textarea>
      </div>

      <div class="form-group">
        <label>Content (full article)</label>
        <textarea name="content" rows="10" placeholder="Full content..."></textarea>
      </div>

      <div class="form-actions">
        <button class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
        <a class="btn btn-outline" href="/nsbm-circle/admin/news_list.php">Cancel</a>
      </div>
    </form>
  </div>
</div>
<!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
</body>
</html>