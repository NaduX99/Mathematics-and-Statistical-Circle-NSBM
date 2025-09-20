<?php
include '../assets/php/extract.php'; 
include '../assets/php/auth.php';
$page_title = 'Events';
$active = 'events_list';
$rows = $pdo->query('SELECT * FROM events ORDER BY date DESC, id DESC')->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
    <div class="events-page-container">
      <?php if (isset($_GET['ok'])): ?>
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i> Event Saved successfully
        </div>
        <script> setTimeout(function() {window.location.href = 'events_list.php';}, 3000); </script>
      <?php endif; ?>
      
      <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">
          <i class="fas fa-check-circle"></i> Event Deleted successfully
        </div>
        <script> setTimeout(function() {window.location.href = 'events_list.php';}, 3000); </script>
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
          <a href="events_create.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create Event
          </a>
        </div>
      <?php else: ?>
        <div class="events-table-container">
          <table class="events-table">
            <thead>
              <tr>
                <th class="title-col">Title</th>
                <th class="description-col">Description</th>
                <th class="date-col" style="color:#fff">Date</th>
                <th class="image-col">Preview</th>
                <th class="actions-col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $r): ?>
                <tr>
                  <td class="title-col">
                    <div class="event-title"><?= htmlspecialchars($r['title']) ?></div>
                  </td>
                  <td class="title-col">
                    <?php if ($r['description']): ?>
                      <div class="event-description" style="text-align:justify"><?= htmlspecialchars($r['description']) ?></div>
                    <?php endif; ?>
                  </td>
                  <td class="date-col">
                    <?= date('M j, Y', strtotime($r['date'])) ?>
                  </td>
                  <td class="image-col">
                    <div class="event-image-preview">
                      <img src="../<?= htmlspecialchars($r['image']) ?>" alt="Event image">
                    </div>
                  </td>
                  <td class="actions-col">
                    <div class="action-buttons">

                      <a href="events_edit.php?id=<?= (int)$r['id'] ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                      </a>

                      <form action="../assets/php/event_delete.php" method="post" class="action-form" onsubmit="return confirm('Are you sure you want to delete this event?');">
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
    <!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
  </body>
</html>