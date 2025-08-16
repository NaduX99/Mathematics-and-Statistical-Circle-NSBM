<?php
require_once __DIR__ . '/../config.php';
session_destroy();
header('Location: /Mathematics-and-Statistical-Circle-NSBM/admin/login.php');
