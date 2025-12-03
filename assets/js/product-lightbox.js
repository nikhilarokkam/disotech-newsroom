class ProductImageSlider {
  constructor() {
    this.currentLightboxIndex = 0;
    this.currentImages = [];
    this.lightboxElements = null;
    this.init();
  }

  init() {
    this.createLightboxIfNotExists();
    this.initSliders();
    this.initLightbox();
  }

  createLightboxIfNotExists() {
    // Перевіряємо чи існує lightbox
    let lightbox = document.getElementById("lightbox");

    if (!lightbox) {
      // Створюємо lightbox якщо його немає
      const lightboxHTML = `
                <div id="lightbox" class="lightbox">
                    <div class="lightbox-content">
                    <div class="lightbox-slider">
                    <button class="lightbox-close" aria-label="Close lightbox">&times;</button>
                            <img src="" alt="" class="lightbox-image">
                            <button class="lightbox-btn prev-btn" aria-label="Previous image">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button class="lightbox-btn next-btn" aria-label="Next image">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="lightbox-dots"></div>
                        <div class="lightbox-counter">
                            <span class="current-image">1</span> / <span class="total-images">1</span>
                        </div>
                    </div>
                </div>
            `;

      document.body.insertAdjacentHTML("beforeend", lightboxHTML);
    }
  }

  initSliders() {
    const productImages = document.querySelectorAll(".product-card__image");

    productImages.forEach((imageContainer, containerIndex) => {
      const images = imageContainer.querySelectorAll(".slider-image");

      // Якщо немає зображень зі структурою слайдера, створюємо їх з існуючого img
      if (images.length === 0) {
        const existingImg = imageContainer.querySelector("img");
        if (existingImg) {
          this.convertToSliderStructure(imageContainer, existingImg);
          return;
        }
      }

      const prevBtn = imageContainer.querySelector(".prev-btn");
      const nextBtn = imageContainer.querySelector(".next-btn");
      const dots = imageContainer.querySelectorAll(".dot");

      // Якщо тільки одне зображення, приховуємо контроли
      if (images.length <= 1) {
        imageContainer.setAttribute("data-single-image", "true");
        // Все одно додаємо можливість відкриття lightbox
        imageContainer.addEventListener("click", () => {
          this.openLightbox(images, 0);
        });
        return;
      }

      let currentIndex = 0;

      // Функція показу слайду
      const showSlide = (index) => {
        images.forEach((img, i) => {
          img.classList.toggle("active", i === index);
        });
        dots.forEach((dot, i) => {
          dot.classList.toggle("active", i === index);
        });
        currentIndex = index;
      };

      // Попередній слайд
      if (prevBtn) {
        prevBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          const newIndex =
            currentIndex > 0 ? currentIndex - 1 : images.length - 1;
          showSlide(newIndex);
        });
      }

      // Наступний слайд
      if (nextBtn) {
        nextBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          const newIndex =
            currentIndex < images.length - 1 ? currentIndex + 1 : 0;
          showSlide(newIndex);
        });
      }

      // Клік по точкам
      dots.forEach((dot, index) => {
        dot.addEventListener("click", (e) => {
          e.stopPropagation();
          showSlide(index);
        });
      });

      // Відкриття lightbox при кліку на зображення
      imageContainer.addEventListener("click", () => {
        this.openLightbox(images, currentIndex);
      });
    });
  }

  convertToSliderStructure(container, img) {
    // Конвертуємо звичайне зображення в структуру слайдера
    const imageSliderHTML = `
            <div class="image-slider">
                <div class="slider-container">
                    <img src="${img.src}" alt="${img.alt}" class="slider-image active">
                </div>
            </div>
        `;

    container.innerHTML = imageSliderHTML;
    container.setAttribute("data-single-image", "true");

    // Додаємо обробник кліку для lightbox
    container.addEventListener("click", () => {
      const images = container.querySelectorAll(".slider-image");
      this.openLightbox(images, 0);
    });
  }

  initLightbox() {
    const lightbox = document.getElementById("lightbox");

    if (!lightbox) {
      console.error("Lightbox element not found");
      return;
    }

    const lightboxImage = lightbox.querySelector(".lightbox-image");
    const lightboxClose = lightbox.querySelector(".lightbox-close");
    const lightboxPrev = lightbox.querySelector(".prev-btn");
    const lightboxNext = lightbox.querySelector(".next-btn");
    const lightboxDots = lightbox.querySelector(".lightbox-dots");
    const currentImageSpan = lightbox.querySelector(".current-image");
    const totalImagesSpan = lightbox.querySelector(".total-images");

    // Перевіряємо чи всі елементи знайдено
    if (
      !lightboxImage ||
      !lightboxClose ||
      !lightboxPrev ||
      !lightboxNext ||
      !lightboxDots
    ) {
      console.error("Some lightbox elements not found");
      return;
    }

    // Закриття lightbox
    const closeLightbox = () => {
      lightbox.classList.remove("active");
      document.body.style.overflow = "";
    };

    // Показ зображення в lightbox
    const showLightboxImage = (index) => {
      if (this.currentImages[index]) {
        lightboxImage.src = this.currentImages[index].src;
        lightboxImage.alt = this.currentImages[index].alt;

        // Оновлення точок
        const dots = lightboxDots.querySelectorAll(".dot");
        dots.forEach((dot, i) => {
          dot.classList.toggle("active", i === index);
        });

        // Оновлення лічильника
        if (currentImageSpan) currentImageSpan.textContent = index + 1;

        this.currentLightboxIndex = index;
      }
    };

    // Події lightbox
    lightboxClose.addEventListener("click", closeLightbox);

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) {
        closeLightbox();
      }
    });

    lightboxPrev.addEventListener("click", () => {
      const newIndex =
        this.currentLightboxIndex > 0
          ? this.currentLightboxIndex - 1
          : this.currentImages.length - 1;
      showLightboxImage(newIndex);
    });

    lightboxNext.addEventListener("click", () => {
      const newIndex =
        this.currentLightboxIndex < this.currentImages.length - 1
          ? this.currentLightboxIndex + 1
          : 0;
      showLightboxImage(newIndex);
    });

 
    document.addEventListener("keydown", (e) => {
      if (!lightbox.classList.contains("active")) return;

      switch (e.key) {
        case "Escape":
          closeLightbox();
          break;
        case "ArrowLeft":
          lightboxPrev.click();
          break;
        case "ArrowRight":
          lightboxNext.click();
          break;
      }
    });

    this.lightboxElements = {
      lightbox,
      showImage: showLightboxImage,
      dots: lightboxDots,
      totalImagesSpan,
    };
  }


  openLightbox(images, startIndex = 0) {
    // Перевіряємо чи ініціалізовано lightbox
    if (!this.lightboxElements) {
      console.error("Lightbox not initialized");
      return;
    }

    this.currentImages = Array.from(images);
    this.currentLightboxIndex = startIndex;

    const { lightbox, showImage, dots, totalImagesSpan } =
      this.lightboxElements;

    
    const prevBtn = lightbox.querySelector(".prev-btn");
    const nextBtn = lightbox.querySelector(".next-btn");

    if (this.currentImages.length <= 1) {
      if (prevBtn) prevBtn.style.display = "none";
      if (nextBtn) nextBtn.style.display = "none";
    } else {
      if (prevBtn) prevBtn.style.display = "block";
      if (nextBtn) nextBtn.style.display = "block";
    }

    
    if (totalImagesSpan) {
      totalImagesSpan.textContent = this.currentImages.length;
    }

    
    if (dots) {
      dots.innerHTML = "";
      if (this.currentImages.length > 1) {
        this.currentImages.forEach((_, index) => {
          const dot = document.createElement("span");
          dot.className = "dot";
          dot.addEventListener("click", () => showImage(index));
          dots.appendChild(dot);
        });
      }
    }

    
    showImage(startIndex);

    
    lightbox.classList.add("active");
    document.body.style.overflow = "hidden";
  }
}


document.addEventListener("DOMContentLoaded", () => {
  new ProductImageSlider();
});


if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", () => {
    new ProductImageSlider();
  });
} else {
  new ProductImageSlider();
}
