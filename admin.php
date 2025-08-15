
<?php
require 'db_functions.php';
$articles = get_all_articles();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">

    <title>Admin - Manage News</title>

    <link rel = "stylesheet" href = "style-admin.css">

</head>

<body>

    <div class="admin-container">
        <h1>Manage News Articles</h1>

        <table class="news-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Publish Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($article['id']); ?></td>
                            <td><?php echo htmlspecialchars($article['title']); ?></td>
                            <td><?php echo htmlspecialchars($article['category']); ?></td>
                            <td><?php echo htmlspecialchars(date("Y-m-d", strtotime($article['publish_date']))); ?></td>
                            <td class="actions">
                                <button class="btn btn-edit js-edit-btn"
                                        data-id="<?php echo htmlspecialchars($article['id']); ?>"
                                        data-title="<?php echo htmlspecialchars($article['title']); ?>"
                                        data-category="<?php echo htmlspecialchars($article['category']); ?>"
                                        data-author="<?php echo htmlspecialchars($article['author']); ?>"
                                        data-publish_date="<?php echo htmlspecialchars(date('Y-m-d', strtotime($article['publish_date']))); ?>"
                                        data-image="<?php echo htmlspecialchars($article['image']); ?>"
                                        data-source_link="<?php echo htmlspecialchars($article['source_link']); ?>"
                                        data-description="<?php echo htmlspecialchars($article['description']); ?>"
                                        data-full_content="<?php echo htmlspecialchars($article['full_content']); ?>">
                                    Edit
                                </button>
                                <a href="delete-article.php?id=<?php echo $article['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this article?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No articles found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <button id="add-article-btn" class="btn btn-add">Add New Article</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div id="article-modal" class="modal-overlay">
        <div class="modal-content">
            <button id="modal-close-btn" class="modal-close">&times;</button>
            <div class="form-container">
                <h2 id="form-title">Add New Article</h2>
                <form id="article-form" action="process-article.php" method="POST">
                    
                    <input type="hidden" id="id" name="id">

                    <div class="tab-container">
                        <div class="tab-buttons">
                            <button type="button" class="tab-btn active" data-tab="tab-core">Core Info</button>
                            <button type="button" class="tab-btn" data-tab="tab-content">Content</button>
                            <button type="button" class="tab-btn" data-tab="tab-media">Media</button>
                        </div>
                        <div class="tab-content">
                            <div id="tab-core" class="tab-pane active">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select id="category" name="category" required>
                                            <option value="">-- Select a Category --</option>
                                            <option value="Breakthroughs & Research">Breakthroughs & Research</option>
                                            <option value="Figures & History">Figures & History</option>
                                            <option value="Puzzles & Paradoxes">Puzzles & Paradoxes</option>
                                            <option value="Math in Action">Math in Action</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Author / Source</label>
                                        <input type="text" id="author" name="author" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="publish_date">Publish Date</label>
                                    <input type="date" id="publish_date" name="publish_date" required>
                                </div>
                            </div>
                            <div id="tab-content" class="tab-pane">
                                <div class="form-group">
                                    <label for="source_link">Source Link</label>
                                    <input type="url" id="source_link" name="source_link" placeholder="https://example.com/article" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description (Short summary for the card)</label>
                                    <textarea id="description" name="description" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="full_content">Full Content (For the modal popup)</label>
                                    <textarea id="full_content" name="full_content" rows="8" required></textarea>
                                </div>
                            </div>
                            <div id="tab-media" class="tab-pane">
                                <div class="form-group">
                                    <label for="image">Image Path</label>
                                    <input type="text" id="image" name="image" placeholder="/images/research-1.jpg" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-save">Save Article</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('article-modal');
            const addBtn = document.getElementById('add-article-btn');
            const closeBtn = document.getElementById('modal-close-btn');
            const editBtns = document.querySelectorAll('.js-edit-btn');
            const articleForm = document.getElementById('article-form');
            const formTitle = document.getElementById('form-title');
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabPanes.forEach(pane => pane.classList.remove('active'));

                    button.classList.add('active');
                    document.getElementById(button.dataset.tab).classList.add('active');
                });
            });

            function openModal() {
                modal.style.display = 'flex';
                tabButtons.forEach((btn, index) => {
                    btn.classList.toggle('active', index === 0);
                });
                tabPanes.forEach((pane, index) => {
                    pane.classList.toggle('active', index === 0);
                });
            }

            function closeModal() {
                modal.style.display = 'none';
            }

            addBtn.addEventListener('click', function() {
                formTitle.textContent = 'Add New Article';
                articleForm.reset();
                document.getElementById('id').value = '';
                openModal();
            });

            editBtns.forEach(button => {
                button.addEventListener('click', function() {
                    formTitle.textContent = 'Edit Article';
                    const data = this.dataset;
                    
                    document.getElementById('id').value = data.id;
                    document.getElementById('title').value = data.title;
                    document.getElementById('category').value = data.category;
                    document.getElementById('author').value = data.author;
                    document.getElementById('publish_date').value = data.publish_date;
                    document.getElementById('image').value = data.image;
                    document.getElementById('source_link').value = data.source_link;
                    document.getElementById('description').value = data.description;
                    document.getElementById('full_content').value = data.full_content;

                    openModal();
                });
            });

            closeBtn.addEventListener('click', closeModal);

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });
        });
    </script>

</body>

</html>
