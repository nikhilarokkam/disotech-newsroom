document.addEventListener('DOMContentLoaded', function () {
  var root = document.querySelector('.newsroom-case-embla');
  if (!root) return;
  if (typeof EmblaCarousel === 'undefined') {
    console.warn('EmblaCarousel is not loaded.');
    return;
  }

  var viewportNode = root.querySelector('.embla__viewport');
  var prevBtn = root.querySelector('.embla__button--prev');
  var nextBtn = root.querySelector('.embla__button--next');

  var embla = EmblaCarousel(viewportNode, {
    loop: false,
    align: 'start',
    slidesToScroll: 1,
  });

  function toggleButtons() {
    if (!embla) return;

    if (!embla.canScrollPrev()) {
      prevBtn.classList.add('is-disabled');
    } else {
      prevBtn.classList.remove('is-disabled');
    }

    if (!embla.canScrollNext()) {
      nextBtn.classList.add('is-disabled');
    } else {
      nextBtn.classList.remove('is-disabled');
    }
  }

  toggleButtons();
  embla.on('select', toggleButtons);
  embla.on('init', toggleButtons);

  prevBtn.addEventListener('click', function () {
    embla.scrollPrev();
  });

  nextBtn.addEventListener('click', function () {
    embla.scrollNext();
  });
});
