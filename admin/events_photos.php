<?php
  include '../assets/php/extract.php'; 
  include '../assets/php/auth.php';
  $page_title = 'Add Photos';
  $active = 'events_photos';
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
    <div class="form-page-container">
      <?php if (isset($_GET['ok'])): ?>
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i> Photos Saved successfully
        </div>
        <script> setTimeout(function() {window.location.href = 'events_photos.php'; }, 3000); </script>
      <?php endif; ?>
      <?php if (isset($_GET['err'])): ?>
        <div class="alert alert-error">
          <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?>
        </div>
      <?php endif; ?>
      <div class="form-card">
        <form action="../assets/php/photo_store.php" method="post" enctype="multipart/form-data" class="event-form">
          <div class="form-section">
            <div class="form-group">
                <label for="title">Event&nbsp;<span style="color:red">*</span></label>
                <select name="title" id="title" required>
                  <option value="" disabled selected>Select Event</option>
                  <?php foreach ($events as $event): ?> <option value="<?= htmlspecialchars($event['id']) ?>"> <?= htmlspecialchars($event['title']) ?> </option>  <?php endforeach; ?>
                </select>
                </div>
          <div class="form-section">
            <div class="image-upload-container">
              <div class="upload-preview" id="imagePreview">
                <?php if (!empty($existing_image_path)): ?>
                  <img src="<?= htmlspecialchars($existing_image_path) ?>" alt="Preview">
                <?php else: ?>
                  <div class="preview-default">
                    <i class="fas fa-image"></i>
                    <p>No Images selected</p>
                  </div>
                <?php endif; ?>
              </div>
              <div class="upload-controls">
                <label for="image" class="upload-btn btn-primary">
                  <i class="fas fa-upload"></i> Choose Images
                  <!-- Required only if we DON'T have an existing image -->
                  <input type="file" id="image" name="image[]" multiple required>
                </label>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Upload Photos
              </button>
              <a href="events_photos.php" class="btn btn-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <script>
      document.getElementById('image')?.addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const files = e.target.files;

        if (files.length > 0) {
          preview.innerHTML = '';
          Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(ev) {
              const img = document.createElement('img');
              img.src = ev.target.result;
              img.alt = 'Preview';
              preview.appendChild(img);
            };
            reader.readAsDataURL(file);
          });
        } else {
          preview.innerHTML = `
            <div class="preview-default">
              <i class="fas fa-image"></i>
              <p>No image selected</p>
            </div>`;
        }
      });
    </script>
    <!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
  </body>
</html>
