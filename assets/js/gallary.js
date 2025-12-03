// if (!window?.galleryData) {
//   console.warn("galleryData is not available.");
//   return;
// }

const data = window.galleryData;

class Gallery {
  constructor() {
    this.gallery = document.getElementById("gallery");
    this.loading = document.getElementById("loading");
    this.tabLoading = document.getElementById("tabLoading");
    this.currentFilter = this.getFirstAvailableKey();
    this.fancyboxInstances = {};
    this.loadedCategories = new Set([this.currentFilter]);
    this.imageCache = new Map();
    this.isLoading = false;
    this.init();
  }

  getFirstAvailableKey() {
    const keys = Object.keys(data);
    return keys.length > 0 ? keys[0] : null;
  }


  normalizeCategory(category) {
    if (!category) return null;

    if (data[category]) {
      return category;
    }

    const normalizedCategory = category
      .toLowerCase()
      .replace(/[^a-zA-Z0-9_-]/g, "");

    const dataKeys = Object.keys(data);
    const foundKey = dataKeys.find((key) => {
      const normalizedKey = key.toLowerCase().replace(/[^a-zA-Z0-9_-]/g, "");
      return normalizedKey === normalizedCategory;
    });

    return foundKey || null;
  }

  init() {
    if (!this.currentFilter) {
      return;
    }
    this.setupEvents();
    setTimeout(() => this.showGallery(), 800);
  }

  setupEvents() {
    const tabSelectors = [
      ".zier-tab-button",
      ".tab-button",
      "[data-filter]",
      ".gallery-tab",
      ".nav-tab",
    ];

    let tabButtons = [];

    for (const selector of tabSelectors) {
      tabButtons = document.querySelectorAll(selector);
      if (tabButtons.length > 0) {
        break;
      }
    }

    if (tabButtons.length === 0) {
      return;
    }

    tabButtons.forEach((btn, index) => {
      btn.onclick = async (e) => {
        e.preventDefault();
        const rawFilter = btn.dataset.filter;
        const normalizedFilter = this.normalizeCategory(rawFilter);

        if (
          this.isLoading ||
          !normalizedFilter ||
          normalizedFilter === this.currentFilter
        ) {
          return;
        }

        tabButtons.forEach((b) =>
          b.classList.remove("zier-active-tab", "active")
        );
        btn.classList.add("zier-active-tab");

        await this.filter(normalizedFilter);
      };
    });

    let defaultTab = null;
    tabButtons.forEach((btn) => {
      const normalizedFilter = this.normalizeCategory(btn.dataset.filter);
      if (normalizedFilter === this.currentFilter) {
        defaultTab = btn;
      }
    });

    if (defaultTab) {
      tabButtons.forEach((b) =>
        b.classList.remove("zier-active-tab", "active")
      );
      defaultTab.classList.add("zier-active-tab");
    }
  }

  preloadImage(src) {
    return new Promise((resolve, reject) => {
      if (this.imageCache.has(src)) {
        resolve(this.imageCache.get(src));
        return;
      }

      const img = new Image();
      img.onload = () => {
        this.imageCache.set(src, img);
        resolve(img);
      };
      img.onerror = reject;
      img.src = src;
    });
  }

  async preloadCategoryImages(category) {
    const items = data[category];
    if (!items || !Array.isArray(items)) {
      return;
    }

    const promises = items.map((item) =>
      Promise.all([this.preloadImage(item.t), this.preloadImage(item.s)])
    );

    try {
      await Promise.all(promises);
      this.loadedCategories.add(category);
    } catch (error) {
      this.loadedCategories.add(category);
    }
  }

  renderCategory(category) {
    const items = data[category];
    if (!items || !Array.isArray(items)) {
      return '<div class="zier-no-data">No data available for this category</div>';
    }

    return items
      .map(
        (item, i) => `
        <div class="zier-gallery-item" style="animation-delay: ${i * 0.1}s">
          <a href="${item.s}" data-fancybox="gallery-${category}" 
             ${
               item.title || item.desc
                 ? `data-caption="<h4>${item.title || ""}</h4><p>${
                     item.desc || ""
                   }</p>"`
                 : ""
             }>
            <img src="${item.t}" alt="${
          item.title || category
        }" class="zier-image-loading">
            <div class="zier-image-overlay">
              <i class="fas fa-expand-arrows-alt"></i>
            </div>
          </a>
        </div>
      `
      )
      .join("");
  }

  showGallery() {
    this.loading.style.display = "none";
    this.gallery.style.display = "block";

    setTimeout(() => {
      this.gallery.classList.add("zier-gallery-loaded");
      this.filter(this.currentFilter);
    }, 50);
  }

  showTabLoading() {
    if (this.gallery) this.gallery.style.display = "none";
    if (this.tabLoading) this.tabLoading.style.display = "flex";
  }

  hideTabLoading() {
    if (this.tabLoading) this.tabLoading.style.display = "none";
    if (this.gallery) this.gallery.style.display = "block";
  }

  async filter(category) {
    if (!data[category]) {
      return;
    }

    this.isLoading = true;

    let btn = null;
    document.querySelectorAll("[data-filter]").forEach((button) => {
      if (this.normalizeCategory(button.dataset.filter) === category) {
        btn = button;
      }
    });

    if (!this.loadedCategories.has(category)) {
      if (btn) btn.classList.add("zier-loading-state");
      this.showTabLoading();

      await this.preloadCategoryImages(category);

      if (btn) btn.classList.remove("zier-loading-state");
    }

    this.currentFilter = category;

    Object.values(this.fancyboxInstances).forEach((instance) => {
      if (instance && instance.destroy) {
        instance.destroy();
      }
    });

    const newContent = this.renderCategory(category);
    this.gallery.innerHTML = newContent;
    this.hideTabLoading();

    setTimeout(() => {
      const images = this.gallery.querySelectorAll("img");
      images.forEach((img, index) => {
        setTimeout(() => {
          img.classList.remove("zier-image-loading");
          img.classList.add("zier-image-loaded");
          img.closest(".zier-gallery-item").classList.add("zier-item-loaded");
        }, index * 100);
      });
    }, 100);

    setTimeout(() => {
      const fancyboxElements = document.querySelectorAll(
        `[data-fancybox="gallery-${category}"]`
      );

      if (fancyboxElements.length > 0) {
        this.fancyboxInstances[category] = Fancybox.bind(
          `[data-fancybox="gallery-${category}"]`,
          {
            Toolbar: {
              display: {
                left: ["infobar"],
                middle: [
                  "zoomIn",
                  "zoomOut",
                  "toggle1to1",
                  "rotateCCW",
                  "rotateCW",
                ],
                right: ["slideshow", "thumbs", "close"],
              },
            },
            Thumbs: { autoStart: false },
            animated: true,
          }
        );
      }

      this.isLoading = false;
    }, 200);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  new Gallery();
});
