<?php
require_once __DIR__ . '/config.php';

// fetch published events (newest first)
$events = $pdo->query("
  SELECT id, title, date_happened, description, image_path, start_color, end_color, gradient_angle
  FROM events
  WHERE is_published = 1
  ORDER BY date_happened DESC, id DESC
")->fetchAll();

// Get up to 6 published slides ordered by position, then id
$slides = $pdo->query("
  SELECT title, date_label, image_path
  FROM slides
  WHERE is_published = 1
  ORDER BY position ASC, id ASC
  LIMIT 6
")->fetchAll();


?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Mathematics & Statistics Circle - NSBM</title>
  
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="icon" type="image/png" href="/nsbm-circle/Logo.png" />
<link rel="stylesheet" href="style.css" />
  <style>
    :root {
      --color-white: #ffffff;
      --color-green: #4caf50;
      --color-dark-green: #36453b;
      --color-light-green: #a2d5f2;
      --border-radius-card: 25px;
      --box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      --transition: all 0.3s ease;
    }
    
    /* Base Styles */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    main {
      flex: 1;
      padding: 0;
    }
    
    a {
      text-decoration: none;
      color: inherit;
    }
    
    img {
      max-width: 100%;
      height: auto;
    }
    
    /* Header Styles */
    header {
  background-color: #36453b;
  color: white;
  padding: 20px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .logo {
      height: 60px;
      transition: transform 0.3s;
    }
    
    .logo:hover {
      transform: scale(1.05);
    }
    .social-icons {
      display: flex;
      gap: 15px;
    }
    
    .social-icons a {
      color: white;
      font-size: 1.2rem;
      transition: transform 0.3s, color 0.3s;
    }
    
    .social-icons a:hover {
      color: var(--color-light-green);
      transform: translateY(-2px);
    }

    
    .events {
      padding: 4rem 2rem;
      background-image: linear-gradient(
      180deg,
      rgba(145, 145, 145, 0.5) 0%,
      rgba(70, 87, 57, 1) 100%
    ),
    url(../img/eventbg.png);
      position: relative;
      
    }
    
    .events::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url('../img/eventbg.png');
      background-size: cover;
      background-position: center;
      opacity: 0.5;
      z-index: -1;
    }
    
    .eventType {
      color: var(--color-white);
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 2rem;
      text-align: center;
    }
    
    .event-card {
      max-width: 1000px;
      margin: 0 auto 3rem;
      min-height: 300px;
      align-items: stretch;
      height: auto;
      display: flex;
      position: relative;
      overflow: hidden;
      border-radius: var(--border-radius-card);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s;
    }
    
    .event-card:hover {
      transform: translateY(-5px);
    }
    
    .event-image-banner {
      flex: 0 0 40%;      
      width: 40%;
      height: 100%;       
      display: block;     
      object-fit: cover;  
      object-position: center;
    }

    .event-image-col {
      position: relative;
      flex: 0 0 40%;
      width: 40%;
    }

    .event-image-col .event-image-banner {
      position: absolute;
      inset: 0;           
      width: 100%;
      height: 100%;
      object-fit: cover;  
      display: block;
    }
        
    .event-details {
      width: 60%;
      padding: 2rem;
      color: var(--color-white);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    
    .event-date {
      font-size: 1.1rem;
      margin-bottom: 1rem;
      font-weight: 500;
    }
    
    .event-description {
      margin-bottom: 1rem;
      flex-grow: 1;
    }
    
    .event-description strong {
      font-size: 1.5rem;
      display: block;
      margin-bottom: 0.5rem;
    }

    .event-description p {
      display: -webkit-box;
      -webkit-line-clamp: 3;       
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .event-button {
      color: var(--color-white);
      background: transparent;
      border: 2px solid var(--color-white);
      padding: 0.6rem 1.5rem;
      border-radius: 30px;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      align-self: flex-start;
      margin-top: auto;
    }
    
    .event-button:hover {
      background: var(--color-white);
      color: var(--color-green);
    }
    
    /* Gradient backgrounds for event cards */
    .event-card--1 {
      background: linear-gradient(358deg, var(--color-dark-green) 5%, #bd3614 50%);
    }
    .event-card--2 {
      background: linear-gradient(358deg, var(--color-dark-green) 5%, #02381e 50%);
    }
    .event-card--3 {
      background: linear-gradient(358deg, var(--color-dark-green) 5%, #200001 50%);
    }
    .event-card--4 {
      background: linear-gradient(358deg, var(--color-dark-green) 5%, #374dc4 50%);
    }
    .event-card--5 {
      background: linear-gradient(358deg, var(--color-dark-green) 5%, #1f9845 50%);
    }

    /* Preloader */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: var(--color-dark-green);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 0.8s ease;
    }
    
    .preloader-img {
      max-width: 150px;
      animation: pulse 1.5s infinite;
    }
    
    .preloader-text {
      color: #e0e0e0;
      text-align: center;
      margin-top: 1.5rem;
    }
    
    .preloader-text p {
      margin: 0.3rem 0;
      font-size: 1.1rem;
    }
    
    #preloader.fade-out {
      opacity: 0;
      pointer-events: none;
    }
    
    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
    }
    
    /* Responsive Styles */
    @media (max-width: 1024px) {
      .carousel-slide-details {
        max-width: 400px;
        padding: 1.5rem;
      }
      
      .carosel-text {
        font-size: 1.5rem;
      }
    }
    
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        padding: 1rem;
        gap: 1rem;
      }
      
      nav {
        flex-wrap: wrap;
        justify-content: center;
      }
      
      .carousel-slide-details {
        position: static;
        transform: none;
        max-width: 100%;
        margin: 0 auto;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 0;
      }
      
      .carousel-container {
        height: auto;
        min-height: 500px;
      }
      
      .carousel-track {
        flex-direction: column;
        height: auto;
      }
      
      .carousel-slide {
        min-height: 500px;
      }
      
      .event-card {
        flex-direction: column;
        height: auto;
      }
      
      .event-image-banner {
        width: 100%;
        height: 150px;
      }
      
      .event-details {
        width: 100%;
        padding: 1.5rem;
      }
    }
    
    @media (max-width: 480px) {
      .carosel-text {
        font-size: 1.3rem;
      }
      
      .eventType {
        font-size: 2rem;
      }
      
      footer {
        grid-template-columns: 1fr;
        text-align: center;
      }
      
      .footer-logo {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      
      .footer-socials {
        justify-content: center;
      }
      
      .contact-item {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

<header>
  <a href="/nsbm-circle/index.php">
    <img src="/nsbm-circle/Logo.png" alt="Mathematics & Statistics Circle Logo" class="logo" />
  </a>
  <nav>
    <a href="/nsbm-circle/index.php">Home</a>
    <a href="/nsbm-circle/events.php">Events</a>
    <a href="/nsbm-circle/about.php">About</a>
    <a href="/nsbm-circle/news.php">News</a>
    <a href="/nsbm-circle/contact.php">Contact</a>
  </nav>
  <div class="social-icons">
    <a href="https://lk.linkedin.com/company/mathematics-and-statistics-circle-nsbm-green-university" aria-label="LinkedIn">
      <i class="fab fa-linkedin-in"></i>
    </a>
    <a href="https://www.facebook.com/Mathematics.and.Statistics.Circle" aria-label="Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://www.instagram.com/maths_club_nsbm/" aria-label="Instagram">
      <i class="fab fa-instagram"></i>
    </a>
  </div>
</header>

<main>
  <section class="carousel-container" aria-label="Featured Events">
    <div class="carousel-track">
      <?php foreach($slides as $s): ?>
        <div class="carousel-slide">
          <img src="<?= htmlspecialchars($s['image_path']) ?>" class="img-carousel" alt="<?= htmlspecialchars($s['title']) ?>" />
          <div class="carousel-slide-details">
            <p class="carosel-text">
              <?= htmlspecialchars($s['title']) ?>
              <span class="carousel-date"><?= htmlspecialchars($s['date_label']) ?></span>
              <a class="carousel-button" href="/nsbm-circle/events.php">
                Go to event
                <span class="arr"><i class="fas fa-arrow-right"></i></span>
              </a>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <div class="carousel-nav">
      <button class="prev" aria-label="Previous slide"><i class="fas fa-arrow-left"></i></button>
      <button class="next" aria-label="Next slide"><i class="fas fa-arrow-right"></i></button>
    </div>
    
    <div class="dots"></div>
  </section>

  <section class="events">
    <h1 class="eventType">Past Events</h1>

    <?php if (!$events): ?>
      <p style="color: var(--color-white); text-align: center;">No events published yet.</p>
    <?php else: ?>
      <?php foreach($events as $idx => $e):
      $cardClass = 'event-card--' . ((($idx % 4) + 2)); // fallback colors
      $bgStyle = '';
      if (!empty($e['start_color']) && !empty($e['end_color'])) {
          $angle = isset($e['gradient_angle']) && $e['gradient_angle'] !== null ? (int)$e['gradient_angle'] : 358;
          $bgStyle = "background: linear-gradient({$angle}deg, {$e['start_color']} 5%, {$e['end_color']} 50%);";
      }
      ?>
      <div class="event-card <?= $cardClass ?>" id="event-<?= (int)$e['id'] ?>" style="<?= htmlspecialchars($bgStyle) ?>">
        <div class="event-image-col">
          <img src="<?= htmlspecialchars($e['image_path']) ?>" alt="<?= htmlspecialchars($e['title']) ?>" class="event-image-banner" />
        </div>
        <div class="event-details">
            <h3 class="event-date"><?= htmlspecialchars(date('F j, Y', strtotime($e['date_happened']))) ?></h3>
            <div class="event-description">
              <strong><?= htmlspecialchars($e['title']) ?></strong>
              <p><?= nl2br(htmlspecialchars(substr($e['description'], 0, 150))) ?>...</p>
            </div>
            <a class="event-button" href="#event-<?= (int)$e['id'] ?>">View Details</a>
          </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</main>

<footer>
  <div class="footer-section footer-logo">
    <img src="Logo.png" alt="Mathematics & Statistics Circle Logo" class="logo" />
    <p>MATHEMATICS & STATISTICS CIRCLE</p>
    <p>NSBM GREEN UNIVERSITY</p>
  </div>
  
  <div class="footer-section">
    <h3>CONTACT US</h3>
    <div class="contact-item">
      <i class="fas fa-map-marker-alt"></i>
      <span>NSBM Green University, Mahenwaththa, Pitipana, Homagama, Sri Lanka</span>
    </div>
    <div class="contact-item">
      <i class="fas fa-envelope"></i>
      <span>mathscircle@nsbm.ac.lk</span>
    </div>
  </div>
  
  <div class="footer-section">
    <h3>FOLLOW US</h3>
    <div class="footer-socials">
      <a href="https://lk.linkedin.com/company/mathematics-and-statistics-circle-nsbm-green-university" aria-label="LinkedIn">
        <i class="fab fa-linkedin-in"></i>
      </a>
      <a href="https://www.facebook.com/Mathematics.and.Statistics.Circle" aria-label="Facebook">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://www.instagram.com/maths_club_nsbm" aria-label="Instagram">
        <i class="fab fa-instagram"></i>
      </a>
    </div>
  </div>
  
  <div class="footer-section">
    <h3>QUICK LINKS</h3>
    <div class="links">
      <a href="/nsbm-circle/index.php">Home</a>
      <a href="/nsbm-circle/events.php">Events</a>
      <a href="/nsbm-circle/about.php">About</a>
      <a href="/nsbm-circle/news.php">News</a>
      <a href="/nsbm-circle/contact.php">Contact</a>
    </div>
  </div>
  
  <div class="footer-bottom">
    <p>&copy; <?= date('Y') ?> Mathematics & Statistics Circle. All Rights Reserved.</p>
  </div>
</footer>

<!-- Preloader -->
<div id="preloader">
  <img class="preloader-img" src="/nsbm-circle/Logo.png" alt="Loading..." />
  <div class="preloader-text">
    <p>MATHEMATICS & STATISTICS CIRCLE</p>
    <p>NSBM GREEN UNIVERSITY</p>
  </div>
</div>


<script src="../Mathematics-and-Statistical-Circle-NSBM/script/index.js"></script>
</body>
</html>
