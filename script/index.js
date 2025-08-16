//Create Carousel----------------------------------
/*
const next = document.querySelector(".next");
const track = document.querySelector(".carousel-track");
const slides = document.querySelectorAll(".carousel-slide");
const dotContainer = document.querySelector(".dots");

let curSlide = 0;
const maxSlide = slides.length - 1;

const activeDots = function (slide) {
  document
    .querySelectorAll(".dots__dot")
    .forEach((dot) => dot.classList.remove("dots__dot--active"));

  document
    .querySelector(`.dots__dot[data-slide="${slide}"]`)
    .classList.add("dots__dot--active");
};
const moveNext = function (pos) {
  activeDots(curSlide);
  track.style.transform = `translateX(-${pos * 100}%)`;
};
next.addEventListener("click", function () {
  curSlide = curSlide === maxSlide ? 0 : curSlide + 1;
  moveNext(curSlide);
});
function autoPlay() {
  curSlide = curSlide === maxSlide ? 0 : curSlide + 1;
  moveNext(curSlide);
}
// setInterval(autoPlay, 3000); --> Auto play mode
const createDots = function () {
  slides.forEach(function (_, i) {
    dotContainer.insertAdjacentHTML(
      "beforeend",
      `<button class="dots__dot" data-slide="${i}"></button>`
    );
  });
};
createDots();
activeDots(curSlide);
dotContainer.addEventListener("click", function (e) {
  if (e.target.classList.contains("dots__dot")) {
    const { slide } = e.target.dataset;
    curSlide = Number(slide);
    moveNext(curSlide);
  }
});
*/
document.addEventListener("DOMContentLoaded", () => {
  // Carousel functionality
  const carouselTrack = document.querySelector(".carousel-track");
  const slides = document.querySelectorAll(".carousel-slide");
  const dotsContainer = document.querySelector(".dots");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");

  if (slides.length > 0) {
    let currentSlide = 0;
    const maxSlide = slides.length - 1;

    // Create dots
    const createDots = () => {
      slides.forEach((_, i) => {
        dotsContainer.insertAdjacentHTML(
          "beforeend",
          `<button class="dots__dot" data-slide="${i}" aria-label="Go to slide ${
            i + 1
          }"></button>`
        );
      });
    };

    // Activate dot
    const activateDot = (slide) => {
      document.querySelectorAll(".dots__dot").forEach((dot) => {
        dot.classList.remove("dots__dot--active");
      });

      document
        .querySelector(`.dots__dot[data-slide="${slide}"]`)
        ?.classList.add("dots__dot--active");
    };

    // Go to slide
    const goToSlide = (slide) => {
      carouselTrack.style.transform = `translateX(-${100 * slide}%)`;
      activateDot(slide);
    };

    // Next slide
    const nextSlide = () => {
      if (currentSlide === maxSlide) {
        currentSlide = 0;
      } else {
        currentSlide++;
      }
      goToSlide(currentSlide);
    };

    // Previous slide
    const prevSlide = () => {
      if (currentSlide === 0) {
        currentSlide = maxSlide;
      } else {
        currentSlide--;
      }
      goToSlide(currentSlide);
    };

    // Initialize
    createDots();
    goToSlide(0);

    // Event listeners
    nextBtn.addEventListener("click", nextSlide);
    prevBtn.addEventListener("click", prevSlide);

    dotsContainer.addEventListener("click", (e) => {
      if (e.target.classList.contains("dots__dot")) {
        const slide = e.target.dataset.slide;
        currentSlide = +slide;
        goToSlide(currentSlide);
      }
    });

    // Keyboard navigation
    document.addEventListener("keydown", (e) => {
      if (e.key === "ArrowRight") nextSlide();
      if (e.key === "ArrowLeft") prevSlide();
    });

    // Autoplay
    let autoplay = setInterval(nextSlide, 5000);

    // Pause autoplay on hover
    carouselTrack.addEventListener("mouseenter", () => {
      clearInterval(autoplay);
    });

    carouselTrack.addEventListener("mouseleave", () => {
      autoplay = setInterval(nextSlide, 5000);
    });
  }

  // Preloader
  window.addEventListener("load", () => {
    const preloader = document.getElementById("preloader");
    if (preloader) {
      setTimeout(() => {
        preloader.classList.add("fade-out");
        setTimeout(() => {
          preloader.style.display = "none";
        }, 800);
      }, 650);
    }
  });
});
