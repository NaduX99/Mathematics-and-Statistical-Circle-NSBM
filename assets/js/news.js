$(document).ready(function(){
  $('.header-carousel').slick({
    dots: true,
    arrows: false,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear',
    autoplay: true,
    autoplaySpeed: 4000
  });

  const modal = $('#article-modal');
  const modalImg = $('#modal-img');
  const modalTitle = $('#modal-title');
  const modalText = $('#modal-text');
  const modalMetadata = $('#modal-metadata');
  const modalSourceLink = $('#modal-source-link');

  $('.js-open-modal').on('click', function(e) {
    e.preventDefault();

    const image = $(this).data('image');
    const title = $(this).data('title');
    const content = $(this).data('content');
    const date = $(this).data('date');
    const author = $(this).data('author');
    const sourceLink = $(this).data('source-link');

    modalImg.attr('src', image);
    modalTitle.text(title);
    modalText.text(content);
    modalMetadata.text(`${date} | ${author}`);
    modalSourceLink.attr('href', sourceLink);
    
    modal.addClass('is-visible');
    $('body').css('overflow', 'hidden');
  });

  function closeModal() {
    modal.removeClass('is-visible');
    $('body').css('overflow', 'auto');
  }

  $('.js-close-modal').on('click', closeModal);

  modal.on('click', function(e) { if (e.target === this) { closeModal(); } });

  $(document).on('keyup', function(e) { if (e.key === "Escape") { closeModal(); } });
});