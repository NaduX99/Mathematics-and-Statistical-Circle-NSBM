<?php include 'assets/php/extract.php'; ?>
<html>
<head> <?php include 'assets/php/head.php'; ?> </head>
<body>
    <?php include 'assets/php/header.php'; ?>
    <main class = "page-container">
        <header class = "header-carousel">
            <div class = "carousel-item">
                <img src = "assets/image/Breakthroughs and Research.png" alt = "Abstract glowing network representing breakthroughs and research">
                <div class = "carousel-caption">
                    <h2>Breakthroughs & Research</h2>
                </div>
            </div>
            <div class = "carousel-item">
                <img src = "assets/image/Figures and History.png" alt = "Vintage chalkboard with complex historical mathematical formulas and diagrams">
                <div class = "carousel-caption">
                    <h2>Figures & History</h2>
                </div>
            </div>
            <div class = "carousel-item">
                <img src = "assets/image/Puzzles and Paradoxes.png" alt = "A dark, glowing, intricate maze-like labyrinth representing puzzles and paradoxes">
                <div class = "carousel-caption">
                    <h2>Puzzles & Paradoxes</h2>
                </div>
            </div>
            <div class = "carousel-item">
                <img src = "assets/image/Math in Action.png" alt = "A futuristic city skyline at night with glowing data streams and network connections, representing math in action">
                <div class = "carousel-caption">
                    <h2>Math in Action</h2>
                </div>
            </div>
        </header>
        <div>
            <?php   if ( !empty ( $news_categories ) ):foreach ( $news_categories as $category_name => $articles ): ?>
                        <section class = "news-category">
                            <h2><?php echo htmlspecialchars ($category_name ); ?></h2>
                            <div class = "news-grid">
                                <?php foreach ( $articles as $article ): ?>
                                    <div class = "news-card">
                                        <img src = "<?php echo htmlspecialchars ( $article [ 'image' ] ); ?>" alt = "<?php echo htmlspecialchars ( $article [ 'title' ] ); ?>">
                                        <div class = "card-content">
                                            <h4><?php echo htmlspecialchars ( $article [ 'title' ] ); ?></h4>
                                            <div class = "card-metadata">
                                                <span><?php echo htmlspecialchars ( date ( "F j, Y" , strtotime ( $article [ 'publish_date' ] ) ) ); ?></span> | 
                                                <span><?php echo htmlspecialchars ( $article [ 'author' ] ); ?></span>
                                            </div>
                                            <p><?php echo htmlspecialchars ( $article [ 'description' ] ); ?></p>
                                            <a class = "btn-more-info js-open-modal"
                                                data-image = "<?php echo htmlspecialchars ( $article [ 'image' ] ); ?>"
                                                data-title = "<?php echo htmlspecialchars ( $article [ 'title' ] ); ?>"
                                                data-content = "<?php echo htmlspecialchars ( $article [ 'full_content' ] ); ?>"
                                                data-date = "<?php echo htmlspecialchars ( date ( "F j, Y" , strtotime ( $article ['publish_date' ] ) ) ); ?>"
                                                data-author = "<?php echo htmlspecialchars ( $article [ 'author' ] ); ?>"
                                                data-source-link = "<?php echo htmlspecialchars ( $article [ 'source_link' ] ); ?>">
                                                More Info
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
            <?php
                        endforeach;
                    else:
            ?>
                        <p>No news articles found.</p>
            <?php
                    endif;
            ?>
        </div>
    </main>
    <div id = "article-modal" class = "modal-overlay">

        <div class = "modal-content">
            <button class = "modal-close js-close-modal">&times;</button>
            <img id = "modal-img" src = "" alt = "Article Image">
            <h3 id = "modal-title"></h3>
            <div id = "modal-metadata" class = "modal-metadata"></div>
            <p id = "modal-text"></p>
            <div class = "modal-footer">
                <a id = "modal-source-link" href = "#" target = "_blank" class = "btn-source-link">Read Full Story</a>
            </div>
        </div>

    </div>
    <?php include 'assets/php/footer.php'; ?>
</body>
</html>
