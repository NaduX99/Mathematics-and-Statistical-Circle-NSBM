document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger");
    const sidebar = document.getElementById("adminSidebar");
    const closeBtn = document.querySelector(".close-sidebar");

    // open/close with hamburger
    hamburger.addEventListener("click", () => {
      sidebar.classList.toggle("active");
    });

    // close with "X" button
    closeBtn.addEventListener("click", () => {
      sidebar.classList.remove("active");
    });
  });
