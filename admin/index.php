<?php 
  include '../assets/php/extract.php'; 
  include '../assets/php/auth.php';
  $page_title = 'Dashboard';
  $active = 'dashboard';
?>
<!DOCTYPE html>
<html>
  <head> <?php include '../assets/php/admin_head.php'; ?> </head>
  <body class="admin-shell">
    <?php include '../assets/php/admin_header.php'; ?>
    <div class="dashboard-container">
      <div class="dashboard-grid">
          <div class="dashboard-card">
            <div class="card-header">
              <div class="card-icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <h3>Events Management</h3>
            </div>
            <br>
            <div class="card-body">
              <div class="progress-container">
                <div class="progress-info">
                  <span>Total Events</span>
                  <span class="count"><?= (int)$eventCount ?></span>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: <?= $eventCount?>%"></div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="events_create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Event
              </a>
              <a href="events_list.php" class="btn btn-secondary">
                <i class="fas fa-list"></i> View All
              </a>
            </div>
          </div>
          <div class="dashboard-card">
            <div class="card-header">
              <div class="card-icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <h3>News Management</h3>
            </div><br>
            <div class="card-body">
              <div class="progress-container">
                <div class="progress-info">
                  <span>Total News</span>
                  <span class="count"><?= (int)$newsCount ?></span>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: <?= $newsCount?>%"></div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="news_create.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add News
              </a>
              <a href="news_list.php" class="btn btn-secondary">
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
                <p>No Activity Yet.</p>
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
                            <strong>News</strong>
                          <?php endif; ?>
                          “<?= htmlspecialchars($a['entity_title']) ?>”
                          <?php
                            $verb = match($a['action']) {
                              'create' => 'created',
                              'update' => 'updated',
                              'delete' => 'deleted',
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
    <!-- Footer Section -->
    <?php include '../assets/php/admin_footer.php'; ?>
  </body>
</html>