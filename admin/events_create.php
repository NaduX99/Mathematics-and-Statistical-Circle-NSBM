<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

$page_title = 'Add Event';
$active = 'events_create';

require_once __DIR__ . '/../partials/admin_header.php';
?>

<div class="form-page-container">
  <div class="form-header">
    <div class="header-content">
      <h1><i class="fas fa-calendar-plus"></i> Create New Event</h1>
      <p class="subtitle">Add a new event to the Mathematics & Statistics Circle</p>
    </div>
    <div class="header-illustration">
      <img src="/Mathematics-and-Statistical-Circle-NSBM/assets/images/event-illustration.svg" alt="Event illustration">
    </div>
  </div>

  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error">
      <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?>
    </div>
  <?php endif; ?>

  <div class="form-card">
    <form action="/Mathematics-and-Statistical-Circle-NSBM/process/event_store.php" method="post" enctype="multipart/form-data" class="event-form">
      <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">

      <div class="form-section">
        <h2 class="section-title"><span>1</span> Basic Information</h2>
        <div class="form-grid">
          <div class="form-group">
            <label for="title">Event Title*</label>
            <input type="text" id="title" name="title" required placeholder="e.g., Annual Math Symposium">
            <div class="input-hint">A catchy title for your event</div>
          </div>

          <div class="form-group">
            <label for="date_happened">Event Date*</label>
            <div class="input-with-icon">
              <i class="far fa-calendar-alt"></i>
              <input type="date" id="date_happened" name="date_happened" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="description">Description*</label>
          <textarea id="description" name="description" rows="5" required 
                    placeholder="Describe the event details, speakers, agenda, etc."></textarea>
          <div class="input-hint">Markdown formatting supported</div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>2</span> Event Image</h2>
        <div class="image-upload-container">
          <div class="upload-preview" id="imagePreview">
            <div class="preview-default">
              <i class="fas fa-image"></i>
              <p>No image selected</p>
            </div>
          </div>
          <div class="upload-controls">
            <label for="image" class="upload-btn btn-primary">
              <i class="fas fa-upload"></i> Choose Image
              <input type="file" id="image" name="image" accept="image/*" required>
            </label>
            <div class="upload-requirements">
              <p><i class="fas fa-info-circle"></i> Recommended size: 1200×630px</p>
              <p><i class="fas fa-info-circle"></i> Max file size: 3MB</p>
            </div>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h2 class="section-title"><span>3</span> Card Styling</h2>
        <p class="section-description">Customize how this event will appear on cards</p>
        
        <div class="style-preview-container">
          <div class="style-preview" id="stylePreview">
            <div class="preview-card" style="background: linear-gradient(358deg, #36453B, #2ECC71);">
              <h3>Preview Card</h3>
              <p>This is how your event card will look</p>
            </div>
          </div>

          <div class="style-controls">
            <div class="form-grid">
              <div class="form-group color-picker">
                <label>Gradient Start</label>
                <div class="color-input">
                  <input type="color" id="start_color" name="start_color" value="#36453B">
                  <div class="color-value">#36453B</div>
                </div>
              </div>
              
              <div class="form-group color-picker">
                <label>Gradient End</label>
                <div class="color-input">
                  <input type="color" id="end_color" name="end_color" value="#2ECC71">
                  <div class="color-value">#2ECC71</div>
                </div>
              </div>
              
              <div class="form-group angle-picker">
                <label for="gradient_angle">Angle</label>
                <div class="angle-controls">
                  <input type="range" id="gradient_angle" name="gradient_angle" min="0" max="360" value="358">
                  <div class="angle-value">358°</div>
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
            <input type="checkbox" name="is_published" value="1" checked>
            <span class="toggle-switch"></span>
            <span class="toggle-text">Publish this event immediately</span>
          </label>
          <div class="toggle-hint">Uncheck to save as draft</div>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="fas fa-save"></i> Save Event
        </button>
        <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php" class="btn btn-outline">
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>

<script>

document.getElementById('image').addEventListener('change', function(e) {
  const preview = document.getElementById('imagePreview');
  const file = e.target.files[0];
  
  if (file) {
    const reader = new FileReader();
    
    reader.onload = function(e) {
      preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
    }
    
    reader.readAsDataURL(file);
  } else {
    preview.innerHTML = `
      <div class="preview-default">
        <i class="fas fa-image"></i>
        <p>No image selected</p>
      </div>
    `;
  }
});


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