const form = document.getElementById('contactForm');
  
  form.addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent actual form submission

    const firstName = form.elements['first-name'].value;
    const lastName = form.elements['last-name'].value;
    const email = form.elements['email'].value;
    const phone = form.elements['phone'].value;
    const message = form.elements['message'].value;

    const subject = encodeURIComponent('New Message from ' + firstName + ' ' + lastName);
    const body = encodeURIComponent(
      `Name: ${firstName} ${lastName}\n` +
      `Email: ${email}\n` +
      `Phone: ${phone}\n\n` +
      `Message:\n${message}`
    );

    // window.location.href = `mailto:mathematicsandstatisticscircle@gmail.com?subject=${subject}&body=${body}`;
    const mailtoLink = `mailto:mathematicsandstatisticscircle@gmail.com?subject=${subject}&body=${body}`;

    // Open mailto link in a new "window/tab" (browser may handle differently)
    window.open(mailtoLink, '_blank');
    setTimeout(() => window.location.reload(), 5000);
});