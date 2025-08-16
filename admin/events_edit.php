<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM events WHERE id=?');
$stmt->execute([$id]);
$e = $stmt->fetch();
if (!$e) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php?err=Not+found');
  exit;
}


$page_title = 'Edit Event #' . (int)$e['id'];
$active = 'events_list';

require_once __DIR__ . '/../partials/admin_header.php';
?>

<div class="form-page-container">
  <div class="form-header">
    <div class="header-content">
      <h1><i class="fas fa-edit"></i> Edit Event #<?= (int)$e['id'] ?></h1>
      <p class="subtitle">Update event details for Mathematics & Statistics Circle</p>
    </div>
    <div class="header-illustration">
      <img src="/Mathematics-and-Statistical-Circle-NSBM/assets/images/edit-illustration.svg" alt="Edit illustration">
    </div>
  </div>

  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error">
      <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?>
    </div>
  <?php endif; ?>

  <div class="form-card">
    <form action="/Mathematics-and-Statistical-Circle-NSBM/process/event_update.php" method="post" enctype="multipart/form-data" class="event-form">
      <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
      <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">

      <div class="form-section">
        <h2 class="section-title"><span>1</span> Basic Information</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="title">Event Title*</label>
            <input type="text" id="title" name="title" required 
                   value="<?= htmlspecialchars($e['title']) ?>" 
                   placeholder="e.g., Annual Math Symposium">
          </div>

          <div class="form-group">
            <label for="date_happened">Event Date*</label>
            <div class="input-with-icon">
              <i class="far fa-calendar-alt"></i>
              <input type="date" id="date_happened" name="date_happened" required 
                     value="<?= htmlspecialchars($e['date_happened']) ?>">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Description*</label>
          <textarea id="description" name="description" rows="6" required
                    placeholder="Describe the event details, speakers, agenda, etc."><?= 
                    htmlspecialchars($e['description']) ?></textarea>
          <div class="input-hint">Markdown formatting supported</div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>2</span> Event Image</h2>
        <div class="image-upload-container">
          <div class="current-image-preview">
            <div class="preview-label">Current Image</div>
            <img src="<?= htmlspecialchars($e['image_path']) ?>" alt="Current event image">
          </div>
          <div class="upload-controls">
            <label for="image" class="upload-btn btn-outline">
              <i class="fas fa-sync-alt"></i> Replace Image
              <input type="file" id="image" name="image" accept="image/*">
            </label>
            <div class="upload-requirements">
              <p><i class="fas fa-info-circle"></i> Recommended size: 1200×630px</p>
              <p><i class="fas fa-info-circle"></i> Max file size: 3MB</p>
              <p><i class="fas fa-info-circle"></i> Leave empty to keep current image</p>
            </div>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>3</span> Card Styling</h2>
        <p class="section-description">Customize how this event appears on cards</p>
        
        <div class="style-preview-container">
          <div class="style-preview">
            <div class="preview-card" 
                 style="background: linear-gradient(<?= htmlspecialchars($e['gradient_angle'] ?? 358) ?>deg, 
                        <?= htmlspecialchars($e['start_color'] ?? '#36453B') ?>, 
                        <?= htmlspecialchars($e['end_color'] ?? '#2ECC71') ?>);">
              <h3>Preview Card</h3>
              <p>This is how your event card will look</p>
            </div>
          </div>

          <div class="style-controls">
            <div class="form-grid">
              <div class="form-group color-picker">
                <label>Gradient Start</label>
                <div class="color-input">
                  <input type="color" id="start_color" name="start_color" 
                         value="<?= htmlspecialchars($e['start_color'] ?? '#36453B') ?>">
                  <div class="color-value"><?= htmlspecialchars($e['start_color'] ?? '#36453B') ?></div>
                </div>
              </div>
              
              <div class="form-group color-picker">
                <label>Gradient End</label>
                <div class="color-input">
                  <input type="color" id="end_color" name="end_color" 
                         value="<?= htmlspecialchars($e['end_color'] ?? '#2ECC71') ?>">
                  <div class="color-value"><?= htmlspecialchars($e['end_color'] ?? '#2ECC71') ?></div>
                </div>
              </div>
              
              <div class="form-group angle-picker">
                <label for="gradient_angle">Angle</label>
                <div class="angle-controls">
                  <input type="range" id="gradient_angle" name="gradient_angle" 
                         min="0" max="360" value="<?= htmlspecialchars($e['gradient_angle'] ?? 358) ?>">
                  <div class="angle-value"><?= htmlspecialchars($e['gradient_angle'] ?? 358) ?>°</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>4</span> Publish Settings</h2>
        <div class="toggle-group">
          <label class="toggle-label">
            <input type="checkbox" name="is_published" value="1" <?= $e['is_published'] ? 'checked' : '' ?>>
            <span class="toggle-switch"></span>
            <span class="toggle-text">Published</span>
          </label>
          <div class="toggle-hint">Uncheck to save as draft</div>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="fas fa-save"></i> Update Event
        </button>
        <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php" class="btn btn-outline">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>

<script>

const startColor = document.getElementById('start_color');
const endColor = document.getElementById('end_color');
const angleInput = document.getElementById('gradient_angle');
const previewCard = document.querySelector('.preview-card');

function updateGradientPreview() {
  const angle = angleInput.value;
  const start = startColor.value;
  const end = endColor.value;
  
  previewCard.style.background = `linear-gradient(${angle}deg, ${start}, ${end})`;
  

  document.querySelector('.angle-value').textContent = `${angle}°`;
  

  document.querySelectorAll('.color-picker .color-value').forEach((el, index) => {
    el.textContent = index === 0 ? start : end;
  });
}

startColor.addEventListener('input', updateGradientPreview);
endColor.addEventListener('input', updateGradientPreview);
angleInput.addEventListener('input', updateGradientPreview);
</script>

<?php require_once __DIR__ . '/../partials/admin_footer.php'; ?>