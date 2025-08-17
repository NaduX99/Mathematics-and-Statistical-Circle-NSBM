<?php
    include 'assets/php/config.php';
    $all_articles = $pdo->query('SELECT * FROM news ORDER BY publish_date DESC')->fetchAll();
    $news_categories = [ ];
    foreach ( $all_articles as $article ) { $news_categories [ $article [ 'category' ] ] [ ] = $article;}
?>