<header>
    <div class="logo-container">
        <a href="index.php">
            <img src="assets/image/logo.png" alt="Logo" class="logo">
        </a>
        <a href="https://www.nsbm.ac.lk/" class="nsbmlogoa">
            <img src="assets/image/nsbmlogo.png" alt="Second Logo" class="logo second-logo">
        </a>
    </div>
    

    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="events.php">Events</a>
        <a href="news.php">News</a>
        <a href="contact.php">Contact</a>
    </nav>
    
   
    <div class="social-icons">
        <a href="https://lk.linkedin.com/company/mathematics-and-statistics-circle-nsbm-green-university" style=" background: none !important;"><i class="fab fa-linkedin-in"></i></a>
        <a href="https://www.facebook.com/Mathematics.and.Statistics.Circle" style=" background: none !important;"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/maths_club_nsbm/" style=" background: none !important;"><i class="fab fa-instagram" ></i></a>
        <a href="https://www.youtube.com/@MathematicsandStatisticsCircle" style=" background: none !important;"><i class="fab fa-youtube"></i></a>
        <a href="https://www.tiktok.com/@mathsclubnsbm" style=" background: none !important;"><i class="fab fa-tiktok"></i></a>
    </div>
    
 
    <div class="mobile-menu-toggle">
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
    </div>
    

    <div class="mobile-nav">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="events.php">Events</a>
        <a href="news.php">News</a>
        <a href="contact.php">Contact</a>
        <div class="social-icons">
            <a href="https://lk.linkedin.com/company/mathematics-and-statistics-circle-nsbm-green-university"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://www.facebook.com/Mathematics.and.Statistics.Circle"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/maths_club_nsbm/"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</header>

<script>document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileNav = document.querySelector('.mobile-nav');
    
    mobileMenuToggle.addEventListener('click', function() {
        this.classList.toggle('active');
        mobileNav.classList.toggle('active');
    });
    
    // Close mobile menu when clicking on a link
    const mobileNavLinks = document.querySelectorAll('.mobile-nav a');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenuToggle.classList.remove('active');
            mobileNav.classList.remove('active');
        });
    });
});
</script>