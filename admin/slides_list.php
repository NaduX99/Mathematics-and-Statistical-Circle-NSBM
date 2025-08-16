<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

$page_title = 'Slides';
$active = 'slides_list';

$rows = $pdo->query('SELECT * FROM slides ORDER BY position ASC, id ASC')->fetchAll();
$publishedCount = $pdo->query('SELECT COUNT(*) as count FROM slides WHERE is_published=1')->fetch()['count'];

require_once __DIR__ . '/../partials/admin_header.php';
?>

<div class="slides-page-container">
  <div class="page-header">
    <div class="header-content">
      <h1><i class="fas fa-sliders-h"></i> Carousel Slides</h1>
      <p class="subtitle">Manage homepage carousel slides (<?= $publishedCount ?>/6 published)</p>
    </div>
    <div class="header-actions">
      <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/slides_create.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Slide
      </a>
    </div>
  </div>

  <?php if (isset($_GET['ok'])): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> Slide saved successfully
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> Slide deleted successfully
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['pub'])): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> Slide published successfully
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['unpub'])): ?>
    <div class="alert alert-warning">
      <i class="fas fa-check-circle"></i> Slide unpublished successfully
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error">
      <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?>
    </div>
  <?php endif; ?>

  <?php if (!$rows): ?>
    <div class="empty-state">
      <div class="empty-icon">
        <i class="fas fa-sliders-h"></i>
      </div>
      <h3>No Slides Found</h3>
      <p>You haven't created any slides yet. Get started by adding your first slide.</p>
      <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/slides_create.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create Slide
      </a>
    </div>
  <?php else: ?>
    <div class="slides-table-container">
      <table class="slides-table">
        <thead>
          <tr>
            <th class="position-col">Position</th>
            <th class="preview-col">Preview</th>
            <th class="content-col">Content</th>
            <th class="status-col">Status</th>
            <th class="actions-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td class="position-col">
                <div class="position-badge"><?= (int)$r['position'] ?></div>
              </td>
              <td class="preview-col">
                <div class="slide-preview">
                  <img src="<?= htmlspecialchars($r['image_path']) ?>" alt="Slide preview">
                </div>
              </td>
              <td class="content-col">
                <div class="slide-title"><?= htmlspecialchars($r['title']) ?></div>
                <div class="slide-date"><?= htmlspecialchars($r['date_label']) ?></div>
              </td>
              <td class="status-col">
                <span class="status-badge <?= $r['is_published'] ? 'published' : 'draft' ?>">
                  <?= $r['is_published'] ? 'Published' : 'Draft' ?>
                </span>
                <?php if ($r['is_published']): ?>
                  <div class="published-info">
                    <i class="fas fa-eye"></i> Visible on homepage
                  </div>
                <?php else: ?>
                  <div class="draft-info">
                    <i class="fas fa-eye-slash"></i> Not visible
                  </div>
                <?php endif; ?>
              </td>
              <td class="actions-col">
                <div class="action-buttons">

                  <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/slides_edit.php?id=<?= (int)$r['id'] ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Edit
                  </a>

                  <form action="/Mathematics-and-Statistical-Circle-NSBM/process/slide_delete.php" method="post" class="action-form" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
                    <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../partials/admin_footer.php'; ?>