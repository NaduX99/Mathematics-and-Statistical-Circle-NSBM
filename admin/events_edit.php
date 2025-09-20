<?php
  include '../assets/php/extract.php'; 
  include '../assets/php/auth.php';
  $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
  $stmt = $pdo->prepare('SELECT * FROM events WHERE id=?');
  $stmt->execute([$id]);
  $e = $stmt->fetch();
  if (!$e)
  {
    header('Location: events_list.php?err=Not+found');
    exit;
  }
  $page_title = 'Edit Event #' . (int)$e['id'];
  $active = 'events_list';
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
    <div class="form-page-container">
      <?php if (isset($_GET['err'])): ?>
        <div class="alert alert-error">
          <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?>
        </div>
      <?php endif; ?>
      <div class="form-card">
        <form action="../assets/php/event_update.php" method="post" enctype="multipart/form-data" class="event-form">
          <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">
          <div class="form-section">
            <div class="form-grid">
              <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" id="title" name="title" required 
                      value="<?= htmlspecialchars($e['title']) ?>">
              </div>
              <div class="form-group">
                <label for="date_happened">Event Date</label>
                <div class="input-with-icon">
                  <i class="far fa-calendar-alt"></i>
                  <input type="date" id="date_happened" name="date_happened" required 
                        value="<?= htmlspecialchars($e['date']) ?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea id="description" name="description" rows="6" required><?= 
                        htmlspecialchars($e['description']) ?></textarea>
            </div>
            <div class="image-upload-container">
              <div class="current-image-preview" id="imagePreview">
                <div class="preview-label">Current Image</div>
                <img src="../<?= htmlspecialchars($e['image']) ?>" alt="Current event image">
              </div>
              <div class="upload-controls">
                <label for="image" class="upload-btn btn-outline">
                  <i class="fas fa-sync-alt"></i> Replace Image
                  <input type="file" id="image" name="image" accept="image/*">
                </label>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Update Event
              </button>
              <a href="events_list.php" class="btn btn-outline">
                Cancel
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
    <script>
      document.getElementById('image')?.addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(ev) {
            preview.innerHTML = `
              <div class="preview-label">Preview</div>
              <img src="${ev.target.result}" alt="Preview Image">`;
          };
          reader.readAsDataURL(file);
        } else {
          // Fallback: show original image
          preview.innerHTML = `
            <div class="preview-label">Current Image</div>
            <img src="../<?= htmlspecialchars($e['image']) ?>" alt="Current event image">`;
        }
      });
    </script>
  </body>
</html>