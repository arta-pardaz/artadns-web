document.addEventListener('DOMContentLoaded', () => {
  const mobileNavToggle = document.getElementById('mobileNavToggle');
  const mobileMenuDrawer = document.getElementById('mobileMenuDrawer');

  if (mobileNavToggle && mobileMenuDrawer) {
    const desktopMedia = window.matchMedia('(min-width: 1024px)');
    const closeMenu = (restoreFocus = false) => {
      mobileMenuDrawer.classList.remove('is-open');
      mobileNavToggle.setAttribute('aria-expanded', 'false');
      if (restoreFocus) mobileNavToggle.focus();
    };

    mobileNavToggle.addEventListener('click', () => {
      const isOpen = mobileMenuDrawer.classList.toggle('is-open');
      mobileNavToggle.setAttribute('aria-expanded', String(isOpen));
    });

    mobileMenuDrawer.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => closeMenu());
    });

    document.addEventListener('keydown', event => {
      if (event.key === 'Escape' && mobileMenuDrawer.classList.contains('is-open')) {
        closeMenu(true);
      }
    });

    desktopMedia.addEventListener('change', () => closeMenu());
    if (desktopMedia.matches) closeMenu();
  }

  const faqItems = document.querySelectorAll('.faq-item');
  const faqs = [];
  const uniqueId = base => {
    let id = base;
    let suffix = 1;
    while (document.getElementById(id)) id = `${base}-${suffix++}`;
    return id;
  };
  const setFaqOpen = (faq, isOpen) => {
    faq.item.classList.toggle('is-active', isOpen);
    faq.header.setAttribute('aria-expanded', String(isOpen));
    faq.body.hidden = !isOpen;
    faq.body.style.maxHeight = isOpen ? `${faq.body.scrollHeight}px` : '';
  };

  faqItems.forEach((item, index) => {
    const header = item.querySelector('.faq-header');
    const body = item.querySelector('.faq-body');

    if (!header || !body) return;

    if (!body.id) body.id = uniqueId(`faq-${index + 1}`);
    if (!header.id) header.id = uniqueId(`${body.id}-header`);
    header.setAttribute('aria-controls', body.id);
    body.setAttribute('role', 'region');
    body.setAttribute('aria-labelledby', header.id);

    const faq = { item, header, body };
    faqs.push(faq);
    setFaqOpen(faq, item.classList.contains('is-active'));

    header.addEventListener('click', () => {
      const isOpen = !item.classList.contains('is-active');
      faqs.forEach(other => setFaqOpen(other, other === faq && isOpen));
    });
  });

  window.addEventListener('resize', () => {
    faqs.forEach(({ body }) => {
      if (!body.hidden) body.style.maxHeight = `${body.scrollHeight}px`;
    });
  });

  const tiltMedia = window.matchMedia('(hover: hover) and (pointer: fine) and (min-width: 1024px) and (prefers-reduced-motion: no-preference)');
  const resetTilts = [];

  document.querySelectorAll('[data-tilt]').forEach(element => {
    let frame = null;
    let tiltX = 0;
    let tiltY = 0;
    const reset = () => {
      if (frame !== null) window.cancelAnimationFrame(frame);
      frame = null;
      tiltX = 0;
      tiltY = 0;
      element.style.setProperty('--tilt-x', '0deg');
      element.style.setProperty('--tilt-y', '0deg');
    };

    element.addEventListener('pointermove', event => {
      if (!tiltMedia.matches) return;
      const rect = element.getBoundingClientRect();
      if (!rect.width || !rect.height) return;
      tiltX = Math.max(-3, Math.min(3, (0.5 - (event.clientY - rect.top) / rect.height) * 6));
      tiltY = Math.max(-3, Math.min(3, ((event.clientX - rect.left) / rect.width - 0.5) * 6));
      if (frame !== null) return;
      frame = window.requestAnimationFrame(() => {
        frame = null;
        if (!tiltMedia.matches) {
          reset();
          return;
        }
        element.style.setProperty('--tilt-x', `${tiltX}deg`);
        element.style.setProperty('--tilt-y', `${tiltY}deg`);
      });
    });

    element.addEventListener('pointerleave', reset);
    element.addEventListener('pointercancel', reset);
    element.addEventListener('blur', reset, true);
    resetTilts.push(reset);
  });

  const resetAllTilts = () => resetTilts.forEach(reset => reset());
  window.addEventListener('blur', resetAllTilts);
  tiltMedia.addEventListener('change', resetAllTilts);
});
