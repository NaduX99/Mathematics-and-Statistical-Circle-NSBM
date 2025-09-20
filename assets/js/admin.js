//Create Carousel----------------------------------
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
