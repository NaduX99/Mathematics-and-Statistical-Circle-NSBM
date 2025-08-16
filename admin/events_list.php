<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';

$page_title = 'Events';
$active = 'events_list';

$rows = $pdo->query('SELECT * FROM events ORDER BY date_happened DESC, id DESC')->fetchAll();

require_once __DIR__ . '/../partials/admin_header.php';
?>

<div class="events-page-container">
  <div class="page-header">
    <div class="header-content">
      <h1><i class="fas fa-calendar-alt"></i> Events Management</h1>
      <p class="subtitle">Manage all Mathematics & Statistics Circle events</p>
    </div>
    <div class="header-actions">
      <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/events_create.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Event
      </a>
    </div>
  </div>

  <?php if (isset($_GET['ok'])): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> Event saved successfully
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> Event deleted successfully
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['pub'])): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> Event published successfully
    </div>
  <?php endif; ?>
  
  <?php if (isset($_GET['unpub'])): ?>
    <div class="alert alert-warning">
      <i class="fas fa-check-circle"></i> Event unpublished successfully
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
        <i class="fas fa-calendar-times"></i>
      </div>
      <h3>No Events Found</h3>
      <p>You haven't created any events yet. Get started by adding your first event.</p>
      <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/events_create.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> Create Event
      </a>
    </div>
  <?php else: ?>
    <div class="events-table-container">
      <table class="events-table">
        <thead>
          <tr>
            <th class="id-col">ID</th>
            <th class="title-col">Event Title</th>
            <th class="date-col">Date</th>
            <th class="status-col">Status</th>
            <th class="image-col">Preview</th>
            <th class="actions-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td class="id-col">#<?= (int)$r['id'] ?></td>
              <td class="title-col">
                <div class="event-title"><?= htmlspecialchars($r['title']) ?></div>
                <?php if ($r['description']): ?>
                  <div class="event-description"><?= htmlspecialchars(substr($r['description'], 0, 50)) ?>...</div>
                <?php endif; ?>
              </td>
              <td class="date-col">
                <?= date('M j, Y', strtotime($r['date_happened'])) ?>
              </td>
              <td class="status-col">
                <span class="status-badge <?= $r['is_published'] ? 'published' : 'draft' ?>">
                  <?= $r['is_published'] ? 'Published' : 'Draft' ?>
                </span>
              </td>
              <td class="image-col">
                <div class="event-image-preview">
                  <img src="<?= htmlspecialchars($r['image_path']) ?>" alt="Event image">
                </div>
              </td>
              <td class="actions-col">
                <div class="action-buttons">
                  <form action="/Mathematics-and-Statistical-Circle-NSBM/process/event_toggle_publish.php" method="post" class="action-form">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
                    <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                    <input type="hidden" name="state" value="<?= $r['is_published'] ? 0 : 1 ?>">
                    <button type="submit" class="btn btn-sm <?= $r['is_published'] ? 'btn-warning' : 'btn-success' ?>">
                      <i class="fas <?= $r['is_published'] ? 'fa-eye-slash' : 'fa-eye' ?>"></i>
                      <?= $r['is_published'] ? 'Unpublish' : 'Publish' ?>
                    </button>
                  </form>

                  <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/events_edit.php?id=<?= (int)$r['id'] ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Edit
                  </a>

                  <form action="/Mathematics-and-Statistical-Circle-NSBM/process/event_delete.php" method="post" class="action-form" onsubmit="return confirm('Are you sure you want to delete this event?');">
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