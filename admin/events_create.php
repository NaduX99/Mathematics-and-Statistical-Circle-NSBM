<?php
  include '../assets/php/extract.php'; 
  include '../assets/php/auth.php';
  $page_title = 'Add Event';
  $active = 'events_create';
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
        <script> setTimeout(function() {window.location.href = 'events_create.php'; }, 3000); </script>
      <?php endif; ?>
      <?php if (isset($_GET['err'])): ?>
        <div class="alert alert-error">
          <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?>
        </div>
      <?php endif; ?>
      <div class="form-card">
        <form action="../assets/php/event_store.php" method="post" enctype="multipart/form-data" class="event-form">
          <div class="form-section">
            <div class="form-grid">
              <div class="form-group">
                <label for="title">Event Title<span style="color:red">*</span></label>
                <input type="text" id="title" name="title" required placeholder="e.g., Annual Math Symposium">
                
              </div>

              <div class="form-group">
                <label for="date_happened">Event Date&nbsp;<span style="color:red">*</span></label>
                <div class="input-with-icon">
                  <i class="far fa-calendar-alt"></i>
                  <input type="date" id="date_happened" name="date_happened" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="description">Description&nbsp;<span style="color:red">*</span></label>
              <textarea id="description" name="description" rows="5" required
                placeholder="Describe the event details, speakers, agenda, etc."></textarea>
    
            </div>
            <div class="image-upload-container">
              <div class="upload-preview" id="imagePreview">
                <?php if (!empty($existing_image_path)): ?>
                  <img src="<?= htmlspecialchars($existing_image_path) ?>" alt="Preview">
                <?php else: ?>
                  <div class="preview-default">
                    <i class="fas fa-image"></i>
                    <p>No image selected</p>
                  </div>
                <?php endif; ?>
              </div>

              <div class="upload-controls">
                <label for="image" class="upload-btn btn-primary">
                  <i class="fas fa-upload"></i> Choose Image
                  <!-- Required only if we DON'T have an existing image -->
                  <input type="file" id="image" name="image" required>
                </label>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Save Event
              </button>
              <a href="events_create.php" class="btn btn-outline">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
    <script>
      // Image preview (also works when replacing slide image)
      document.getElementById('image')?.addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(ev) {
            preview.innerHTML = `<img src="${ev.target.result}" alt="Preview">`;
          };
          reader.readAsDataURL(file);
        } else {
          preview.innerHTML = `
            <div class="preview-default">
              <i class="fas fa-image"></i>
              <p>No image selected</p>
            </div>`;
        }
      });
    </script>
  </body>
</html>
