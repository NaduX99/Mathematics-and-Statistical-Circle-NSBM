<?php
// assets/php/get_images.php
include 'extract.php'; 

header('Content-Type: application/json');

try {
    $folderPath = $_GET['path'] ?? '';

    if ($folderPath === '') {
        throw new Exception('Missing folder path');
    }

    // Remove extra quotes if json_encode added them
    $folderPath = trim($folderPath, '"');

    // Build filesystem path relative to this script
    $fsPath = "../../" . $folderPath;  // go 2 levels up from assets/php/

    if (!is_dir($fsPath)) {
        echo json_encode([]);
        exit;
    }

    // Scan folder
    $files = scandir($fsPath);

    $images = [];
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, ['png','jpg','jpeg','gif'])) {
            // return relative path for frontend
            $images[] = $folderPath . $file;
        }
    }

    echo json_encode($images);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
