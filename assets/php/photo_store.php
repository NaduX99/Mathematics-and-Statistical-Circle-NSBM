<?php
include 'extract.php'; 
include 'auth.php';

function save_image($file, $name, $index)
{
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) { return null; }

    // Ensure the folder exists
    $dir = "../image/events/".$name."/";
    if (!is_dir($dir)) mkdir($dir, 0777, true);

    // Create unique file name based on index
    $targetFs = $dir.$index.".png";

    if (!move_uploaded_file($file['tmp_name'], $targetFs)) {
        throw new Exception('Failed to save image: ' . $file['name']);
    }

    return $targetFs;
}

try {
    $uploadedFiles = $_FILES['image'] ?? [];
    $savedPaths = [];
    $eid = $_POST['title'];
    if ($eid === '') { throw new Exception('Please fill the event name'); }

    $dir = "../image/events/".$eid."/";
    $startIndex = 1;

    // Get the last numbered file in the folder
    if (is_dir($dir)) {
        $files = glob($dir . '*.png'); // get all png files
        if (!empty($files)) {
            // Extract numbers from filenames and find the max
            $numbers = array_map(function($f) {
                return (int) pathinfo($f, PATHINFO_FILENAME);
            }, $files);
            $startIndex = max($numbers) + 1;
        }
    } else {
        mkdir($dir, 0777, true);
    }

    if (!empty($uploadedFiles['name'])) {
        foreach ($uploadedFiles['name'] as $i => $filename) {
            $fileArray = [
                'name' => $uploadedFiles['name'][$i],
                'type' => $uploadedFiles['type'][$i],
                'tmp_name' => $uploadedFiles['tmp_name'][$i],
                'error' => $uploadedFiles['error'][$i],
                'size' => $uploadedFiles['size'][$i],
            ];

            $savedPath = save_image($fileArray, $eid, $startIndex + $i);
            $savedPaths[] = $savedPath;
        }
    }

    log_activity($pdo, 'event', $eid, 'update', $eid, ['date_happened' => date('Y-m-d H:i:s')]);
    header('Location: ../../admin/events_photos.php?ok=1');
    exit;

} catch (Exception $e) {
    header('Location: ../../admin/events_photos.php?err=' . urlencode($e->getMessage()));
    exit;
}
?>
