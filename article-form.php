
<?php

require 'db_functions.php';

$article = [
    'id' => '',
    'title' => '',
    'category' => '',
    'author' => '',
    'publish_date' => '',
    'image' => '',
    'source_link' => '',
    'description' => '',
    'full_content' => ''
];
$page_title = 'Add New Article';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $article = get_article_by_id($id);
    $page_title = 'Edit Article';

    if (!$article) {
        header("Location: admin.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>

    <div class="form-container">
        <h1><?php echo $page_title; ?></h1>

        <form action="process-article.php" method="POST">

            <?php if (!empty($article['id'])): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['id']); ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">-- Select a Category --</option>
                    <option value="Breakthroughs & Research" <?php echo ($article['category'] == 'Breakthroughs & Research') ? 'selected' : ''; ?>>Breakthroughs & Research</option>
                    <option value="Figures & History" <?php echo ($article['category'] == 'Figures & History') ? 'selected' : ''; ?>>Figures & History</option>
                    <option value="Puzzles & Paradoxes" <?php echo ($article['category'] == 'Puzzles & Paradoxes') ? 'selected' : ''; ?>>Puzzles & Paradoxes</option>
                    <option value="Math in Action" <?php echo ($article['category'] == 'Math in Action') ? 'selected' : ''; ?>>Math in Action</option>
                </select>
            </div>

            <div class="form-group">
                <label for="author">Author / Source</label>
                <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($article['author']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="publish_date">Publish Date</label>
                <input type="date" id="publish_date" name="publish_date" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($article['publish_date'] ?? 'now'))); ?>" required>
            </div>

            <div class="form-group">
                <label for="image">Image Path</label>
                <input type="text" id="image" name="image" placeholder="/images/research-1.jpg" value="<?php echo htmlspecialchars($article['image']); ?>" required>
            </div>

            <div class="form-group">
                <label for="source_link">Source Link</label>
                <input type="url" id="source_link" name="source_link" placeholder="https://example.com/article" value="<?php echo htmlspecialchars($article['source_link']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description (Short summary for the card)</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($article['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="full_content">Full Content (For the modal popup)</label>
                <textarea id="full_content" name="full_content" rows="10" required><?php echo htmlspecialchars($article['full_content']); ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save">Save Article</button>
            </div>

        </form>
    </div>

</body>
</html>
