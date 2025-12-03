// slider octagone

document.addEventListener("DOMContentLoaded", function () {
  const carouselItems = document.querySelectorAll("#carousel .carousel-item");
  let selectedIndex = Math.floor(carouselItems.length / 2); // центруємо початковий слайд

  function getClassName(index) {
    const count = carouselItems.length;
    const relativeIndex = (index - selectedIndex + count) % count;

    if (relativeIndex === 0) return "selected";
    if (relativeIndex === 1) return "next";
    if (relativeIndex === 2 && count > 4) return "nextRightSecond";
    if (relativeIndex === count - 1) return "prev";
    if (relativeIndex === count - 2 && count > 4) return "prevLeftSecond";

    return relativeIndex < count / 2 ? "hideLeft" : "hideRight";
  }

  function updateCarouselClasses() {
    carouselItems.forEach((item, index) => {
      item.className = `carousel-item ${getClassName(index)}`;
    });
  }

  function moveToSelected(direction) {
    if (direction === "next") {
      selectedIndex = (selectedIndex + 1) % carouselItems.length;
    } else if (direction === "prev") {
      selectedIndex =
        (selectedIndex - 1 + carouselItems.length) % carouselItems.length;
    }

    updateCarouselClasses();
  }

  // ініціалізація
  updateCarouselClasses();

  // обробники кнопок
  const prevBtn = document.getElementById("carousel-prev");
  if (prevBtn) {
    prevBtn.addEventListener("click", () => moveToSelected("prev"));
  }
  
  const nextBtn = document.getElementById("carousel-next");
  if (nextBtn) {
    nextBtn.addEventListener("click", () => moveToSelected("next"));
  }

  // автоперемикання (опціонально)
  // setInterval(() => moveToSelected('next'), 15000);
});
