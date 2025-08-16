<?php

if (!isset($_SESSION['admin_id'])) {
  header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/login.php');
  exit;
}
//nsbm-circle