<?php
include '../assets/php/extract.php'; 
include '../assets/php/auth.php';

$page_title = 'News';
$active = 'news_list';

$rows = $pdo->query('SELECT * FROM news ORDER BY publish_date DESC, id DESC')->fetchAll();

function is_published_today($d) {
  return strtotime($d) <= strtotime(date('Y-m-d'));
}

?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
<div class="slides-page-container">
  <?php if (isset($_GET['ok'])): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> Saved.</div>
    <script> setTimeout(function() {window.location.href = 'news_list.php';}, 3000); </script>
  <?php endif; ?>
  <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> Deleted.</div>
    <script> setTimeout(function() {window.location.href = 'news_list.php';}, 3000); </script>
  <?php endif; ?>
  <?php if (isset($_GET['err'])): ?>
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_GET['err']) ?></div>
  <?php endif; ?>

  <?php if (!$rows): ?>
    <div class="empty-state">
      <div class="empty-icon"><i class="far fa-newspaper"></i></div>
      <h3>No News Yet</h3>
      <a href="/nsbm-circle/admin/news_create.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create News</a>
    </div>
  <?php else: ?>
    <div class="slides-table-container">
      <table class="slides-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Preview</th>
            <th>Title / Category</th>
            <th>Author</th>
            <th>Publish Date</th>
            <th class="actions-col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
            <tr>
              <td><?= (int)$r['id'] ?></td>
              <td class="preview-col">
                <?php if ($r['image']): ?>
                  <img src="../<?= htmlspecialchars($r['image']) ?>" alt="" style="height:42px;border-radius:4px;">
                <?php endif; ?>
              </td>
              <td>
                <div class="slide-title"><?= htmlspecialchars($r['title']) ?></div>
                <div class="slide-date"><?= htmlspecialchars($r['category']) ?></div>
              </td>
              <td><?= htmlspecialchars($r['author']) ?></td>
              <td><?= htmlspecialchars($r['publish_date']) ?></td>
              <td class="actions-col">
                <div class="action-buttons">
                  <a class="btn btn-sm btn-primary" href="news_edit.php?id=<?= (int)$r['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
                  <form action="../assets/php/news_delete.php" method="post" class="action-form" onsubmit="return confirm('Delete this news?');">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars(csrf_token()) ?>">
                    <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
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