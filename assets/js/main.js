 // Preloader script -->
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    setTimeout(() => {
        preloader.classList.add('fade-out');
        setTimeout(() => preloader.style.display = 'none', 800);
    }, 650);
});

// About page
const mvSection = document.querySelector('.mission-vision-section');

// Mouse hover
mvSection.addEventListener('mouseenter', () => {mvSection.classList.add('glow');});
mvSection.addEventListener('mouseleave', () => {mvSection.classList.remove('glow');});

// Touch devices
mvSection.addEventListener('touchstart', () => {mvSection.classList.add('glow');});
mvSection.addEventListener('touchend', () => {mvSection.classList.remove('glow');});

// Scroll-in animation for cards
function revealCardsOnScroll() {
    const cards = document.querySelectorAll('.card');
    const triggerBottom = window.innerHeight * 0.92;
    cards.forEach(card => {
        const cardTop = card.getBoundingClientRect().top;
        if(cardTop < triggerBottom) {card.classList.add('visible');}
    });
}

window.addEventListener('scroll', revealCardsOnScroll);
window.addEventListener('DOMContentLoaded', () => {
    revealCardsOnScroll();

    // Glow effect for cards (hover and touch)
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', () => card.classList.add('glow'));
        card.addEventListener('mouseleave', () => card.classList.remove('glow'));
        card.addEventListener('touchstart', () => card.classList.add('glow'));
        card.addEventListener('touchend', () => card.classList.remove('glow'));
    });

    // Glow effect for mission-vision-section
    const mvSection = document.querySelector('.mission-vision-section');
    if(mvSection) {
        mvSection.addEventListener('mouseenter', () => mvSection.classList.add('glow'));
        mvSection.addEventListener('mouseleave', () => mvSection.classList.remove('glow'));
        mvSection.addEventListener('touchstart', () => mvSection.classList.add('glow'));
        mvSection.addEventListener('touchend', () => mvSection.classList.remove('glow'));
    }
});

function revealHeadingsOnScroll() {
    document.querySelectorAll('.animated-heading').forEach(heading => {
        const triggerBottom = window.innerHeight * 0.92;
        const headingTop = heading.getBoundingClientRect().top;
        if (headingTop < triggerBottom) {heading.classList.add('visible');}
    });
}
window.addEventListener('scroll', revealHeadingsOnScroll);
window.addEventListener('DOMContentLoaded', revealHeadingsOnScroll);