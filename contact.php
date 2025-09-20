<!DOCTYPE html>
<html>
<head> <?php include 'assets/php/head.php'; ?> </head>
<body>
  <?php include 'assets/php/header.php'; ?>
  <!-- Main Section -->
  <main class="main" style="padding-top: 10px !important;">
    <div class="DIVALL flex-container" style="padding-top: 20px !important;padding-bottom: 10px !important;margin-top: 20px !important;margin-bottom: 10px !important;">
      <div class="text-section">
        <div class="top-left"><p class="top">Mathematics & Statistics Circle</p></div>
        <div class="icons-text-group">
          <div class="icon-text-row">
            <i class="fa fa-envelope icon" title="Gmail"></i>
            <p class="normal">mathematicsandstatisticscircle@gmail.com</p>
          </div>
          <a href = "https://lk.linkedin.com/company/mathematics-and-statistics-circle-nsbm-green-university">
            <div class="icon-text-row">
              <i class="fab fa-linkedin icon" title="LinkedIn"></i>
              <p class="normal">mathematics-and-statistics-circle-nsbm-green-university</p>
            </div>
          </a>
          <a href = "https://www.facebook.com/Mathematics.and.Statistics.Circle">
            <div class="icon-text-row">
              <i class="fab fa-facebook icon" title="Facebook"></i>
              <p class="normal">Mathematics.and.Statistics.Circle</p>
            </div>
          </a>
          <a href = "https://www.instagram.com/maths_club_nsbm/">
            <div class="icon-text-row">
              <i class="fab fa-instagram icon" title="Instagram"></i>
              <p class="normal">maths_club_nsbm</p>
            </div>
          </a>
          <a href = "https://www.youtube.com/@MathematicsandStatisticsCircle">
            <div class="icon-text-row">
              <i class="fab fa-youtube icon" title="YouTube"></i>
              <p class="normal">@MathematicsandStatisticsCircle</p>
            </div>
          </a>
          <a href="https://www.tiktok.com/@mathsclubnsbm">
            <div class="icon-text-row">
              <i class="fab fa-tiktok icon" title="TikTok"></i>
              <p class="normal">@mathsclubnsbm</p>
            </div>
          </a>
        </div>
      </div>
      <div class="img-section">
        <img src="assets/image/logo.png" alt="Maths Club Logo" />
      </div>
    </div>

    <!--join us-->
    <div class="DIVALL flex-container" style="padding-top: 10px !important;margin-top: 10px !important;">
      <div class="text-section">
        <div class="top-left">
          <p class="top">JOIN WITH US</p>
          <p class="normal mic-name">Be part of a growing community that loves numbers, logic, and discovery!</p>
        </div>
        <p class="normal">📊 Improve problem-solving skills</p>
         <p class="normal">🧠 Sharpen your logical thinking</p>
         <p class="normal">🎯 Participate in competitions & events</p>
          <p class="normal">🚀 Boost your career opportunities with math skills</p>
         <p class="normal">🏆 Represent NSBM at inter-university competitions</p>
        <p class="normal">🌐 Explore data science, statistics, and pure maths</p>
     
      <div style="margin-top: 40px !important;" class="icon-text-row">
           
            <a href = "https://docs.google.com/forms/d/e/1FAIpQLSdM9LOH-o5G1Qv_GgTC-lkYlYnWI59-j3Dq4quI4I_KO59zYw/viewform?usp=header"><p style="color:aqua; font-size:22px !important; font-weight:800;font-family: 'Trebuchet MS', sans-serif;" class="normal">Join With Us Now Click This or Scan QR</p></a>
          </div>
         </div>
      <div class="team-member"><div class="qr-wrapper"><img src="assets/image/Qr.png" alt="QR" class="qr" /></div></div>
    </div>

    <div class="DIVALL flex-container" style="padding-top: 20px !important;">
      <div class="text-section">
        <div class="top-left">
          <p class="top">M.I.C</p>
          <p class="normal mic-name">Ms. Hirushi Dilpriya</p>
        </div>
        <p class="normal">The Mathematics & Statistics Circle of NSBM was founded in 2022 under the guidance of <strong>Ms. Hirushi Dilpriya</strong>, who continues to inspire students with her passionfor numbers and logical thinking.</p>
        <p class="normal">With a vision to cultivate analytical skills and a love for mathematics, she has played a pivotal role in shaping the club's journey, organizing engaging events, and fostering a thriving community of math enthusiasts.</p>
        <p class="normal">Under her leadership, the club has grown into a space where students can explore pure mathematics, data science, and statistics while collaborating on exciting projects andcompetitions.</p>
      </div>
      <div class="team-member"><div class="master-incharge-wrapper"><img src="assets/image/mic.png" alt="Master Incharge" class="master-incharge" /></div></div>
    </div>
    <div class="DIVALL">
        <div class="top-left"><p class="top">GET IN TOUCH</p></div>
        <form id="contactForm">
          <div class="form-group two-col">
            <div>
              <label for="first-name">FIRST NAME</label>
              <input type="text" id="first-name" name="first-name" autocomplete="off" placeholder="Enter your first name" required />
            </div>
            <div>
              <label for="last-name">LAST NAME</label>
              <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" required />
            </div>
          </div>

          <div class="form-group two-col">
            <div>
              <label for="email">EMAIL</label>
              <input type="email" id="email" name="email" autocomplete="off" placeholder="Enter your email address" required />
            </div>
            <div>
              <label for="phone">PHONE NUMBER</label>
              <input type="tel" id="phone" name="phone" autocomplete="off" placeholder="Enter your contact number" />
            </div>
          </div>

          <div class="form-group">
            <label for="message">WHAT DO YOU HAVE IN MIND</label>
            <textarea id="message" name="message" placeholder="Share your thoughts, questions, or ideas..."></textarea>
          </div>

          <button type="submit" id="submitBtn">Send Message</button>
        </form>
    </div>
  </main>
  <?php include 'assets/php/footer.php'; ?>
</body>
</html>
