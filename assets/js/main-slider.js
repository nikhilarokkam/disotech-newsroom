document.addEventListener("DOMContentLoaded", () => {
  const ourProduct = document.querySelector(".blaze-our-slider");

  if (!ourProduct) {
    return;
  }

  new BlazeSlider(ourProduct, {
    all: {
      slidesToShow: 1,
      slideGap: "20px",
      loop: true,
      enableAutoplay: true,
      autoplayInterval: 4000,
    },
    "(min-width: 480px) and (max-width: 766px)": {
      slidesToShow: 2,
    },
    "(min-width: 767px) and (max-width: 1023px)": {
      slidesToShow: 3,
    },
    "(min-width: 1024px)": {
      slidesToShow: 4,
    },
  });
});
