<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth.php';
$title  = $page_title ?? 'Admin';
$active = $active ?? '';
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title) ?> — NSBM Maths Circle</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="/nsbm-circle/style.css">

  <link rel="stylesheet" href="/nsbm-circle/css/admin.css?v=2">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body class="admin-shell">

<header class="admin-header">
  <button class="hamburger" aria-label="Toggle sidebar"><i class="fas fa-bars"></i></button>
  <div class="admin-brand">
    <img src="/nsbm-circle/Logo.png" alt="Logo" class="admin-logo">
    <div>
      <div class="brand-title">NSBM Maths Circle</div>
      <div class="brand-sub">Admin Panel</div>
    </div>
  </div>
  <div class="admin-user">
    <span><i class="far fa-user"></i> <?= htmlspecialchars($_SESSION['admin_username'] ?? 'admin') ?></span>
    <a class="btn-ghost small" href="/nsbm-circle/admin/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</header>

<div class="admin-body">
  <aside class="admin-sidebar" id="adminSidebar">
    <nav class="admin-nav" aria-label="Admin navigation">
      <a class="<?= $active==='dashboard'?'active':'' ?>" href="/nsbm-circle/admin/dashboard.php">
        <i class="fas fa-th-large"></i> Dashboard
      </a>

      <div class="nav-section">Events</div>
      <a class="<?= $active==='events_list'?'active':'' ?>" href="/nsbm-circle/admin/events_list.php">
        <i class="far fa-list-alt"></i> Events List
      </a>
      <a class="<?= $active==='events_create'?'active':'' ?>" href="/nsbm-circle/admin/events_create.php">
        <i class="far fa-plus-square"></i> Add Event
      </a>

      <div class="nav-section">Slides</div>
      <a class="<?= $active==='slides_list'?'active':'' ?>" href="/nsbm-circle/admin/slides_list.php">
        <i class="far fa-images"></i> Slides List
      </a>
      <a class="<?= $active==='slides_create'?'active':'' ?>" href="/nsbm-circle/admin/slides_create.php">
        <i class="far fa-plus-square"></i> Add Slide
      </a>
    </nav>
  </aside>


  <main class="admin-main">
