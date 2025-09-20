<header class="admin-header">
  <button class="hamburger" aria-label="Toggle sidebar"><i class="fas fa-bars"></i></button>
  <div class="admin-brand">
    <img src="../assets/image/logo.png" alt="Logo" class="admin-logo">
    <div class="brand-title">Admin Panel</div>
  </div>
  <div class="admin-user">
    <span><i class="far fa-user"></i>&ensp;MASCAdmin</span>
    <a class="btn-ghost small" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</header>

<div class="admin-body">
  <aside class="admin-sidebar" id="adminSidebar">
    <button class="close-sidebar" aria-label="Close sidebar">
      <i class="fas fa-times"></i>
    </button>
    <nav class="admin-nav" aria-label="Admin navigation" style=" display: block !important;">
      <a class="<?= $active==='dashboard'?'active':'' ?>" href="index.php">
        <i class="fas fa-th-large"></i> Dashboard
      </a>
      <div class="nav-section">Events</div>
      <a class="<?= $active==='events_list'?'active':'' ?>" href="events_list.php">
        <i class="far fa-list-alt"></i> Events List
      </a>
      <a class="<?= $active==='events_create'?'active':'' ?>" href="events_create.php">
        <i class="far fa-plus-square"></i> Add Event
      </a>
      <a class="<?= $active==='events_photos'?'active':'' ?>" href="events_photos.php">
        <i class="far fa-plus-square"></i> Add Event Photos
      </a>
      <div class="nav-section">News</div>
      <a class="<?= $active==='news_list'?'active':'' ?>" href="news_list.php">
        <i class="far fa-newspaper"></i> News List
      </a>
      <a class="<?= $active==='news_create'?'active':'' ?>" href="news_create.php">
        <i class="far fa-plus-square"></i> Add News
      </a>
      <div class="nav-section">Admins</div>
      <a class="<?= $active==='add_admin'?'active':'' ?>" href="add_admin.php">
        <i class="far fa-list-alt"></i> Add Admin
      </a>
      <a class="<?= $active==='change_password'?'active':'' ?>" href="change_password.php">
        <i class="far fa-plus-square"></i> Change Password
      </a>
      <div class="nav-section">New Members</div>
      <a href="analys.php">
        <i class="far fa-list-alt"></i> Member Dashboard
      </a>
    </nav>
    <footer class="admin-footer">
      <p>&copy; Mathematics & Statistics Circle. All Rights Reserved.</p>
    </footer> 
  </aside>
<?php if (!empty($_SESSION['flash_success'])): ?>
  <div class="alert success">
    <?= $_SESSION['flash_success'] ?>
  </div>
  <?php unset($_SESSION['flash_success']); ?>
<?php endif; ?>

  <main class="admin-main">
