// faqs
document.addEventListener("DOMContentLoaded", () => {
  const tabs = document.querySelectorAll(".faq__tab");

  if (tabs.length > 0) {
    const contents = document.querySelectorAll(".faq__content");
    const tabsContainer = document.querySelector(".faq__tabs");

    const checkTabsVisibility = () => {
      const visibleTabs = Array.from(tabs).filter((tab) => {
        const tabText = tab.textContent.trim();
        return tabText !== "" && tab.style.display !== "none";
      });

      // Якщо тільки один таб і він без тексту, або взагалі немає табів
      if (visibleTabs.length <= 1) {
        tabsContainer.style.display = "none";
        // Показуємо перший контент
        contents.forEach((content, index) => {
          if (index === 0) {
            content.classList.add("faq__content--active");
          } else {
            content.classList.remove("faq__content--active");
          }
        });
      } else {
        tabsContainer.style.display = "flex";
      }
    };

    // Викликаємо перевірку при завантаженні
    checkTabsVisibility();

    const closeAllAccordions = () => {
      document.querySelectorAll(".faq__item").forEach((i) => {
        const a = i.querySelector(".faq__answer");
        const iconOther = i.querySelector(".faq__icon");
        const questionOther = i.querySelector(".faq__question");

        a.style.maxHeight = null;
        a.style.paddingTop = null;
        a.style.paddingBottom = null;
        a.style.opacity = 0;
        a.classList.remove("open");

        iconOther.textContent = "+";
        questionOther.classList.remove("active");
      });
    };

    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        const target = tab.dataset.tab;

        tabs.forEach((t) => t.classList.remove("faq__tab--active"));
        tab.classList.add("faq__tab--active");
        closeAllAccordions();

        contents.forEach((c) => {
          c.classList.toggle(
            "faq__content--active",
            c.dataset.content === target
          );
        });
      });
    });

    const questions = document.querySelectorAll(".faq__question");

    questions.forEach((q) => {
      q.addEventListener("click", () => {
        const item = q.closest(".faq__item");
        const answer = item.querySelector(".faq__answer");
        const icon = q.querySelector(".faq__icon");
        const isOpen = answer.classList.contains("open");

        // Закриваємо всі інші
        document.querySelectorAll(".faq__item").forEach((i) => {
          if (i !== item) {
            const a = i.querySelector(".faq__answer");
            const iconOther = i.querySelector(".faq__icon");
            const questionOther = i.querySelector(".faq__question");

            a.style.maxHeight = null;
            a.style.paddingTop = null;
            a.style.paddingBottom = null;
            a.style.opacity = 0;
            a.classList.remove("open");

            iconOther.textContent = "+";
            questionOther.classList.remove("active");
          }
        });

        if (!isOpen) {
          answer.classList.add("open");
          answer.style.maxHeight = answer.scrollHeight + "px";
          answer.style.opacity = 1;
          answer.style.paddingTop = "0px";
          answer.style.paddingBottom = "15px";

          q.classList.add("active");
          icon.textContent = "–";
        } else {
          answer.style.maxHeight = answer.scrollHeight + "px";
          requestAnimationFrame(() => {
            answer.style.maxHeight = "0";
            answer.style.opacity = 0;
            answer.style.paddingBottom = "0";
          });

          q.classList.remove("active");
          icon.textContent = "+";

          setTimeout(() => {
            answer.classList.remove("open");
          }, 400);
        }
      });
    });
  }
});

// contact tabs

document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", (e) => {
    const btn = e.target.closest("[data-tab]");
    if (!btn) return;

    const root = btn.closest(".contact-tab");
    if (!root) return;

    const targetId = btn.dataset.tab;

    root
      .querySelectorAll("[data-tab]")
      .forEach((b) =>
        b.classList.toggle("contact-tab__btn--active", b === btn)
      );

    root
      .querySelectorAll(".contact-tab__panel")
      .forEach((p) =>
        p.classList.toggle("contact-tab__panel--active", p.id === targetId)
      );
  });
});

// scroll to tab contact

document.addEventListener('DOMContentLoaded', () => {
  const contactTab = document.querySelector('.contact-tab');
  if (!contactTab) return;

  const normalize = s => (s || '').replace(/\s+/g, ' ').trim().toLowerCase();
  const headerOffset = 150; // 100px header + 50px відступ

  document.addEventListener('click', e => {
    const trigger = e.target.closest('[data-scroll-target]');
    if (!trigger) return;

    const selector = trigger.dataset.scrollTarget;
    const target = selector && document.querySelector(selector);
    if (!target) return;

    e.preventDefault();

    const top = target.getBoundingClientRect().top + window.scrollY - headerOffset;
    window.scrollTo({ top, behavior: 'smooth' });

    const { activateTab: tabId, activateTabTitle: tabTitle } = trigger.dataset;
    if (!tabId && !tabTitle) return;

    setTimeout(() => {
      const root = target.closest('.contact-tab') || document.querySelector('.contact-tab');
      if (!root) return;

      let btn = tabId ? root.querySelector(`[data-tab="${tabId}"]`) : null;
      if (!btn && tabTitle) {
        const want = normalize(tabTitle);
        btn = [...root.querySelectorAll('.contact-tab__btn')]
          .find(b => normalize(b.textContent) === want);
      }
      if (!btn) return;

      const toId = btn.dataset.tab;
      [...root.querySelectorAll('[data-tab]')]
        .forEach(b => b.classList.toggle('contact-tab__btn--active', b === btn));
      [...root.querySelectorAll('.contact-tab__panel')]
        .forEach(p => p.classList.toggle('contact-tab__panel--active', p.id === toId));
    }, 150);
  });
});

// scroll tab the other page
document.addEventListener('DOMContentLoaded', () => {
  const root = document.querySelector('.contact-tab');
  if (!root) return;

  const headerOffset = 150;
  const params = new URLSearchParams(location.search);
  const openId = params.get('open_tab');           
  const openTitle = params.get('open_tab_title');  

  if (location.hash) {
    const t = document.querySelector(location.hash);
    if (t) {
      const top = t.getBoundingClientRect().top + window.scrollY - headerOffset;
      window.scrollTo({ top });
    }
  }

  if (!openId && !openTitle) return;

  const norm = s => (s || '').replace(/\s+/g, ' ').trim().toLowerCase();
  let btn = openId ? root.querySelector(`[data-tab="${openId}"]`) : null;
  if (!btn && openTitle) {
    const want = norm(openTitle);
    btn = [...root.querySelectorAll('.contact-tab__btn')].find(b => norm(b.textContent) === want);
  }
  if (!btn) return;

  const toId = btn.dataset.tab;
  [...root.querySelectorAll('[data-tab]')].forEach(b => b.classList.toggle('contact-tab__btn--active', b === btn));
  [...root.querySelectorAll('.contact-tab__panel')].forEach(p => p.classList.toggle('contact-tab__panel--active', p.id === toId));
});


// custom button form
document.addEventListener("DOMContentLoaded", function () {
  const wrappers = document.querySelectorAll(
    "div.ff_submit_btn_wrapper_custom"
  );

  wrappers.forEach(function (wrapper) {
    const btn = wrapper.querySelector(".ff-btn-submit");
    if (!btn) return;
    if (btn.classList.contains("button-global")) return;
    const btnText = btn.textContent.trim();
    btn.textContent = "";
    btn.classList.add("button-global");
    btn.innerHTML = `
      <span class="button-global__text">${btnText}</span>
      <div class="button-global__liquid"></div>
    `;
  });
});

// custom button bottom disable
document.addEventListener("DOMContentLoaded", function () {
  const footer = document.querySelector("footer");
  const button = document.querySelector(".custom-hardness-wrapper");

  if (!footer || !button) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          button.style.opacity = "0";
          button.style.pointerEvents = "none";
        } else {
          button.style.opacity = "1";
          button.style.pointerEvents = "auto";
        }
      });
    },
    {
      root: null,
      threshold: 0.1,
    }
  );

  observer.observe(footer);
});
