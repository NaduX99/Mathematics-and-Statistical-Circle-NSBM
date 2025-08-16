<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM slides WHERE id=?');
$stmt->execute([$id]);
$s = $stmt->fetch();
if (!$s) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/slides_list.php?err=Not+found');
  exit;
}


$page_title = 'Edit Slide #' . (int)$s['id'];
$active = 'slides_list';

require_once __DIR__ . '/../partials/admin_header.php';
?>

<div class="form-page-container">
  <div class="form-header">
    <div class="header-content">
      <h1><i class="fas fa-edit"></i> Edit Slide #<?= (int)$s['id'] ?></h1>
      <p class="subtitle">Update carousel slide for Mathematics & Statistics Circle</p>
    </div>
    <div class="header-illustration">
      <img src="/Mathematics-and-Statistical-Circle-NSBM/assets/images/slide-edit-illustration.svg" alt="Edit slide illustration">
    </div>
  </div>

  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error">
      <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?>
    </div>
  <?php endif; ?>

  <div class="form-card">
    <form action="/Mathematics-and-Statistical-Circle-NSBM/process/slide_update.php" method="post" enctype="multipart/form-data" class="slide-form">
      <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
      <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">

      <div class="form-section">
        <h2 class="section-title"><span>1</span> Slide Content</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="title">Headline*</label>
            <input type="text" id="title" name="title" required 
                   value="<?= htmlspecialchars($s['title']) ?>" 
                   placeholder="e.g., Happening Now!">
            <div class="input-hint">Short, attention-grabbing text</div>
          </div>

          <div class="form-group">
            <label for="date_label">Date Label*</label>
            <input type="text" id="date_label" name="date_label" required 
                   value="<?= htmlspecialchars($s['date_label']) ?>" 
                   placeholder="e.g., On February 17th">
            <div class="input-hint">How the date should be displayed</div>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>2</span> Slide Position</h2>
        <div class="form-group">
          <label for="position">Display Order*</label>
          <div class="position-selector">
            <?php for ($i = 0; $i <= 5; $i++): ?>
              <label class="position-option <?= $i === (int)$s['position'] ? 'active' : '' ?>">
                <input type="radio" name="position" value="<?= $i ?>" <?= $i === (int)$s['position'] ? 'checked' : '' ?>>
                <span><?= $i ?></span>
              </label>
            <?php endfor; ?>
          </div>
          <div class="input-hint">0 = first position, 5 = last position</div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>3</span> Slide Image</h2>
        <div class="image-upload-container">
          <div class="current-image-preview">
            <div class="preview-label">Current Image</div>
            <img src="<?= htmlspecialchars($s['image_path']) ?>" alt="Current slide image">
          </div>
          <div class="upload-controls">
            <label for="image" class="upload-btn btn-outline">
              <i class="fas fa-sync-alt"></i> Replace Image
              <input type="file" id="image" name="image" accept="image/*">
            </label>
            <div class="upload-requirements">
              <p><i class="fas fa-info-circle"></i> Recommended size: 1920×1080px</p>
              <p><i class="fas fa-info-circle"></i> Max file size: 3MB</p>
              <p><i class="fas fa-info-circle"></i> Leave empty to keep current image</p>
            </div>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>4</span> Publish Settings</h2>
        <div class="toggle-group">
          <label class="toggle-label">
            <input type="checkbox" name="is_published" value="1" <?= $s['is_published'] ? 'checked' : '' ?>>
            <span class="toggle-switch"></span>
            <span class="toggle-text">Publish this slide</span>
          </label>
          <div class="toggle-hint">Maximum of 6 slides can be published at once</div>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="fas fa-save"></i> Update Slide
        </button>
        <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/slides_list.php" class="btn btn-outline">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>

<script>

document.querySelectorAll('.position-option input').forEach(radio => {
  radio.addEventListener('change', function() {
    document.querySelectorAll('.position-option').forEach(option => {
      option.classList.remove('active');
    });
    this.closest('.position-option').classList.add('active');
  });
});
</script>

<?php require_once __DIR__ . '/../partials/admin_footer.php'; ?>