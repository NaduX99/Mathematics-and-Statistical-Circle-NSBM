
function createParticles() {
  const particlesContainer = document.getElementById('particles');
  const particleCount = 20;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    

    const size = Math.random() * 4 + 2;
    particle.style.width = size + 'px';
    particle.style.height = size + 'px';
    
   
    particle.style.left = Math.random() * 100 + '%';
    
    
    particle.style.animationDuration = (Math.random() * 15 + 10) + 's';
    particle.style.animationDelay = Math.random() * 5 + 's';
    
    particlesContainer.appendChild(particle);
}


document.addEventListener('DOMContentLoaded', function() {
  const contactForm = document.getElementById('contactForm');
  
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      const successMessage = document.getElementById('successMessage');
      
  
      e.preventDefault();
      
    
      submitBtn.classList.add('btn-loading');
      submitBtn.textContent = '';
      
    
      setTimeout(() => {
        submitBtn.classList.remove('btn-loading');
        submitBtn.textContent = 'Send Message';
        
        
        successMessage.classList.add('show');
        
        
        contactForm.reset();
        
        
        setTimeout(() => {
          successMessage.classList.remove('show');
        }, 5000);
      }, 2000);
    });
  }
});


document.addEventListener('DOMContentLoaded', function() {
  const iconRows = document.querySelectorAll('.icon-text-row');
  
  iconRows.forEach(row => {
    row.addEventListener('click', function() {
      const icon = this.querySelector('.icon');
      if (icon) {
        icon.style.transform = 'scale(1.5) rotate(360deg)';
        setTimeout(() => {
          icon.style.transform = '';
        }, 600);
      }
    });
  });
});


document.addEventListener('DOMContentLoaded', function() {
  createParticles();
  
 
  setInterval(createParticles, 30000);
});


function smoothScroll(target) {
  document.querySelector(target).scrollIntoView({
    behavior: 'smooth'
  });
}


function typeWriter(element, text, speed) {
  speed = speed || 100;
  let i = 0;
  element.innerHTML = '';
  
  function type() {
    if (i < text.length) {
      element.innerHTML += text.charAt(i);
      i++;
      setTimeout(type, speed);
    }
  }
  
  type();
}


function cleanupParticles() {
  const particles = document.querySelectorAll('.particle');
  if (particles.length > 50) {
    
    for (let i = 0; i < 10; i++) {
      if (particles[i]) {
        particles[i].remove();
      }
    }
  }
}


setInterval(cleanupParticles, 60000);


window.addEventListener('resize', function() {
  
  const particles = document.querySelectorAll('.particle');
  const maxParticles = window.innerWidth < 768 ? 10 : 20;
  
  if (particles.length > maxParticles) {
    for (let i = maxParticles; i < particles.length; i++) {
      particles[i].remove();
    }
  }
});


document.addEventListener('visibilitychange', function() {
  const particles = document.querySelectorAll('.particle');
  
  if (document.hidden) {

    particles.forEach(particle => {
      particle.style.animationPlayState = 'paused';
    });
  } else {
    
    particles.forEach(particle => {
      particle.style.animationPlayState = 'running';
    });
  }
});}