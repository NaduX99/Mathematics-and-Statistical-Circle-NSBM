<?php
include 'extract.php'; 
include 'auth.php';
try {
    $newsId = (int)($_POST['id'] ?? 0);
    if ($newsId <= 0) {throw new Exception("Invalid news ID.");}
    // Fetch title + image for logging & cleanup
    $stmt = $pdo->prepare("SELECT title, image FROM news WHERE id = ?");
    $stmt->execute([$newsId]);
    $news = $stmt->fetch();
    if (!$news) {throw new Exception("News item not found.");}
    // Delete image file if it exists
    if (!empty($news['image'])) {
        $fs = "../../" . $news['image']; // matches /uploads/news/... paths
        if (is_file($fs)) @unlink($fs);
    }

    // Delete DB row
    $pdo->prepare("DELETE FROM news WHERE id = ?")->execute([$newsId]);

    // Activity log
    log_activity($pdo, "news", $newsId, "delete", $news['title']);

    header("Location: ../../admin/news_list.php?deleted=1");
    exit;

} catch (Throwable $e) {
    header("Location: ../../admin/news_list.php");
    exit;
}
