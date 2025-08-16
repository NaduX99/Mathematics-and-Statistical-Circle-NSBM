<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';


$page_title = 'Dashboard';
$active = 'dashboard';


$eventCount  = ($pdo->query('SELECT COUNT(*) AS c FROM events')->fetch()['c'] ?? 0);
$slideCount  = ($pdo->query('SELECT COUNT(*) AS c FROM slides')->fetch()['c'] ?? 0);
$pubSlideCnt = ($pdo->query('SELECT COUNT(*) AS c FROM slides WHERE is_published=1')->fetch()['c'] ?? 0);

$activities = $pdo->query("
  SELECT id, actor, entity_type, entity_id, entity_title, action, details, created_at
  FROM activity_log
  ORDER BY created_at DESC
  LIMIT 8
")->fetchAll();

function activity_icon(array $a): string {
  $t = $a['entity_type']; $act = $a['action'];
  if ($t === 'event') {
    return match($act) {
      'create' => 'fas fa-calendar-plus',
      'update' => 'fas fa-user-edit',
      'publish' => 'fas fa-eye',
      'unpublish' => 'fas fa-eye-slash',
      'delete' => 'fas fa-trash',
      'upload_image' => 'far fa-image',
      default => 'fas fa-calendar-alt',
    };
  } else { // slide
    return match($act) {
      'create' => 'fas fa-images',
      'update' => 'fas fa-pen',
      'publish' => 'fas fa-toggle-on',
      'unpublish' => 'fas fa-toggle-off',
      'delete' => 'fas fa-trash',
      'upload_image' => 'far fa-image',
      default => 'fas fa-sliders-h',
    };
  }
}

function time_ago(string $ts): string {
  $d = new DateTime($ts);
  $now = new DateTime('now', new DateTimeZone('Asia/Colombo'));
  $diff = $now->getTimestamp() - $d->getTimestamp();
  if ($diff < 60) return $diff . ' sec ago';
  if ($diff < 3600) return floor($diff/60) . ' min ago';
  if ($diff < 86400) return floor($diff/3600) . ' hours ago';
  if ($diff < 7*86400) return floor($diff/86400) . ' days ago';
  return $d->format('Y-m-d H:i');
}


require_once __DIR__ . '/../partials/admin_header.php';
?>

<div class="dashboard-container">
  <div class="dashboard-header">
    <div class="header-content">
      <h1>Dashboard Overview</h1>
      <p class="welcome-message">Welcome back, <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin') ?></p>
    </div>
    <div class="quick-stats">
      <div class="stat-badge">
        <i class="fas fa-calendar-alt"></i>
        <span><?= (int)$eventCount ?> Events</span>
      </div>
      <div class="stat-badge">
        <i class="fas fa-sliders-h"></i>
        <span><?= (int)$slideCount ?> Slides</span>
      </div>
      <div class="stat-badge">
        <i class="fas fa-eye"></i>
        <span><?= (int)$pubSlideCnt ?>/6 Published</span>
      </div>
    </div>
  </div>

  <div class="dashboard-grid">
    <!-- Events Card -->
    <div class="dashboard-card">
      <div class="card-header">
        <div class="card-icon">
          <i class="fas fa-calendar-check"></i>
        </div>
        <h3>Events Management</h3>
      </div>
      <div class="card-body">
        <div class="progress-container">
          <div class="progress-info">
            <span>Total Events</span>
            <span class="count"><?= (int)$eventCount ?></span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" style="width: <?= min(100, ($eventCount/10)*100) ?>%"></div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/events_create.php" class="btn btn-primary">
          <i class="fas fa-plus"></i> Add Event
        </a>
        <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/events_list.php" class="btn btn-secondary">
          <i class="fas fa-list"></i> View All
        </a>
      </div>
    </div>

    <!-- Slides Card -->
    <div class="dashboard-card">
      <div class="card-header">
        <div class="card-icon">
          <i class="fas fa-sliders-h"></i>
        </div>
        <h3>Carousel Slides</h3>
      </div>
      <div class="card-body">
        <div class="progress-container">
          <div class="progress-info">
            <span>Published Slides</span>
            <span class="count"><?= (int)$pubSlideCnt ?> <small>/6 max</small></span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" style="width: <?= ($pubSlideCnt/6)*100 ?>%"></div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/slides_create.php" class="btn btn-primary">
          <i class="fas fa-plus"></i> Add Slide
        </a>
        <a href="/Mathematics-and-Statistical-Circle-NSBM/admin/slides_list.php" class="btn btn-secondary">
          <i class="fas fa-list"></i> View All
        </a>
      </div>
    </div>

    <!-- Recent Activity Card -->
    <div class="dashboard-card wide-card">
      <div class="card-header">
        <h3>Recent Activity</h3>
        
      </div>
      <div class="card-body">
        <?php if (!$activities): ?>
          <p>No activity yet.</p>
        <?php else: ?>
          <div class="activity-list">
            <?php foreach ($activities as $a): ?>
              <div class="activity-item">
                <div class="activity-icon">
                  <i class="<?= htmlspecialchars(activity_icon($a)) ?>"></i>
                </div>
                <div class="activity-content">
                  <p>
                    <?php if ($a['entity_type'] === 'event'): ?>
                      <strong>Event</strong>
                    <?php else: ?>
                      <strong>Slide</strong>
                    <?php endif; ?>
                    “<?= htmlspecialchars($a['entity_title']) ?>”
                    <?php
                      $verb = match($a['action']) {
                        'create' => 'created',
                        'update' => 'updated',
                        'publish' => 'published',
                        'unpublish' => 'unpublished',
                        'delete' => 'deleted',
                        'upload_image' => 'image updated',
                        default => $a['action']
                      };
                    ?>
                    was <?= $verb ?><?= $a['actor'] ? ' by ' . htmlspecialchars($a['actor']) : '' ?>
                  </p>
                  <span class="activity-time"><?= htmlspecialchars(time_ago($a['created_at'])) ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php

require_once __DIR__ . '/../partials/admin_footer.php';