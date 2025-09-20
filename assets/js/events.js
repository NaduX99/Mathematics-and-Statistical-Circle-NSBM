const items = document.querySelectorAll('.carousel-item');
let current = 0;
let interval;

function showSlide(index) {
items.forEach((item, i) => {
item.classList.remove('active');
if (i === index) item.classList.add('active');
});
}

function nextSlide() {
current = (current + 1) % items.length;
showSlide(current);
}

function prevSlide() {
current = (current - 1 + items.length) % items.length;
showSlide(current);
}

function startAutoSlide() {
if (items.length > 1) {
interval = setInterval(nextSlide, 5000);
}
}

function stopAutoSlide() {
clearInterval(interval);
}

const nextBtn = document.getElementById('next');
if (nextBtn) {
    nextBtn.addEventListener('click', () => {
        nextSlide();
        stopAutoSlide();
        startAutoSlide();
    });
}
const prevBtn = document.getElementById('prev');
if (prevBtn) {
    prevBtn.addEventListener('click', () => {
        prevSlide();
        stopAutoSlide();
        startAutoSlide();
    });
}

startAutoSlide();