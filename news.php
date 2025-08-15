<?php

require 'db_functions.php';

$all_articles = get_all_articles ( );


$news_categories = [ ];
foreach ( $all_articles as $article ) {
    
    $news_categories [ $article [ 'category' ] ] [ ] = $article;

}
?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta content = "width=device-width, initial-scale=1.0" name = "viewport">
    <meta name = "description" content = "Official website for the Mathematics and Statistics Circle of NSBM Green University.">
    <meta name = "keywords" content = "NSBM, Mathematics, Statistics, Circle, University, Green University, NBSM Green University, Mathematics Circle, Statistics Circle, Mathematics and Statistics Circle">
    <meta name = "author" content = "Mathematics & Statistics Circle NSBM">
    <title>Mathematics & Statistics Circle - NSBM</title>

    <link href = "https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700&display=swap" rel = "stylesheet">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel = "icon" type = "image/png" href = "Logo.png">

    <link rel = "stylesheet" href = "style.css">
    <link rel = "stylesheet" href = "style-news.css">

    <link rel = "stylesheet" type = "text/css" href = "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel = "stylesheet" type = "text/css" href = "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

</head>

<body>

    <header>

        <a href = "index.php" style = "text-decoration : none;">
            <img src = "Logo.png" alt = "Logo" class = "logo">
        </a>
        <a href = "https://www.nsbm.ac.lk/" style = "text-decoration : none; margin-left : 15px;">
            <img src = "NSBM Logo.png" alt = "Second Logo" class = "logo second-logo">
        </a>

        <nav>
            <a href = "index.php">Home</a>
            <a href = "events.php">Events</a>
            <a href = "about.php">About</a>
            <a href = "news.php">News</a>
            <a href = "contact.php">Contact</a>
        </nav>

        <div class = "social-icons">
            <a href = "https://lk.linkedin.com/company/mathematics-and-statistics-circle-nsbm-green-university"><i class = "fab fa-linkedin-in"></i></a>
            <a href = "https://www.facebook.com/Mathematics.and.Statistics.Circle"><i class = "fab fa-facebook-f"></i></a>
            <a href = "https://www.instagram.com/maths_club_nsbm/"><i class = "fab fa-instagram"></i></a>
        </div>

    </header>

    <div class = "page-container">

        <header class = "header-carousel">

            <div class = "carousel-item">
                <img src = "images/Breakthroughs and Research.png" alt = "Abstract glowing network representing breakthroughs and research">
                <div class = "carousel-caption">
                    <h2>Breakthroughs & Research</h2>
                </div>
            </div>

            <div class = "carousel-item">
                <img src = "images/Figures and History.png" alt = "Vintage chalkboard with complex historical mathematical formulas and diagrams">
                <div class = "carousel-caption">
                    <h2>Figures & History</h2>
                </div>
            </div>

            <div class = "carousel-item">
                <img src = "images/Puzzles and Paradoxes.png" alt = "A dark, glowing, intricate maze-like labyrinth representing puzzles and paradoxes">
                <div class = "carousel-caption">
                    <h2>Puzzles & Paradoxes</h2>
                </div>
            </div>

            <div class = "carousel-item">
                <img src = "images/Math in Action.png" alt = "A futuristic city skyline at night with glowing data streams and network connections, representing math in action">
                <div class = "carousel-caption">
                    <h2>Math in Action</h2>
                </div>
            </div>

        </header>

        <main>

            <?php

            if ( !empty ( $news_categories ) ):
                foreach ( $news_categories as $category_name => $articles ):
            ?>

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

        </main>

    </div>

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

    <footer>

        <div class = "footer-section footer-logo">
            <img src = "Logo.png" alt = "Logo" class = "logo">
            <p>MATHEMATICS & STATISTICS CIRCLE</p>
            <p>NSBM GREEN UNIVERSITY</p>
        </div>

        <div class="footer-middle-column">
            <div class = "footer-section">
                <h3>CONTACT US</h3>
                <p class = "contact-item"><i class = "fas fa-map-marker-alt"></i>NSBM Green University, Mahenwaththa, Pitipana, Homagama, Sri Lanka</p>
                <p class = "contact-item"><i class = "fas fa-envelope"></i>mathscircle@nsbm.ac.lk</p>
            </div>
            <div class = "footer-section">
                <h3>FOLLOW US ON</h3>
                <div class="footer-socials">
                    <a href = "https://lk.linkedin.com/company/mathematics-and-statistics-circle-nsbm-green-university"><i class = "fab fa-linkedin-in"></i></a>
                    <a href = "https://www.facebook.com/Mathematics.and.Statistics.Circle"><i class = "fab fa-facebook-f"></i></a>
                    <a href = "https://www.instagram.com/maths_club_nsbm"><i class = "fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class = "footer-section footer-quick-links">
            <h3>QUICK LINKS</h3>
            <div class = "links">
                <a href = "index.php">Home</a>
                <a href = "events.php">Events</a>
                <a href = "about.php">About</a>
                <a href = "news.php">News</a>
                <a href = "contact.php">Contact</a>
            </div>
        </div>

        <div class = "footer-bottom">
            <p>&copy; Mathematics & Statistics Circle. All Rights Reserved.</p>
        </div>

    </footer>

    <script src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type = "text/javascript" src = "https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>

        $(document).ready(function(){
            $('.header-carousel').slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 500,
                fade: true,
                cssEase: 'linear',
                autoplay: true,
                autoplaySpeed: 4000
            });

            const modal = $('#article-modal');
            const modalImg = $('#modal-img');
            const modalTitle = $('#modal-title');
            const modalText = $('#modal-text');
            const modalMetadata = $('#modal-metadata');
            const modalSourceLink = $('#modal-source-link');

            $('.js-open-modal').on('click', function(e) {
                e.preventDefault();

                const image = $(this).data('image');
                const title = $(this).data('title');
                const content = $(this).data('content');
                const date = $(this).data('date');
                const author = $(this).data('author');
                const sourceLink = $(this).data('source-link');

                modalImg.attr('src', image);
                modalTitle.text(title);
                modalText.text(content);
                modalMetadata.text(`${date} | ${author}`);
                modalSourceLink.attr('href', sourceLink);
                
                modal.addClass('is-visible');
                $('body').css('overflow', 'hidden');
            });

            function closeModal() {
                modal.removeClass('is-visible');
                $('body').css('overflow', 'auto');
            }

            $('.js-close-modal').on('click', closeModal);

            modal.on('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            $(document).on('keyup', function(e) {
                if (e.key === "Escape") {
                    closeModal();
                }
            });
        });

    </script>

</body>
</html>
