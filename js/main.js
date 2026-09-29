document.addEventListener('DOMContentLoaded', () => {
  // Mobile Navigation Drawer Toggle
  const mobileNavToggle = document.getElementById('mobileNavToggle');
  const mobileMenuDrawer = document.getElementById('mobileMenuDrawer');

  if (mobileNavToggle && mobileMenuDrawer) {
    mobileNavToggle.addEventListener('click', () => {
      const isOpen = mobileMenuDrawer.classList.toggle('is-open');
      mobileNavToggle.setAttribute('aria-expanded', String(isOpen));
    });

    // Close mobile drawer when any link is clicked
    const mobileLinks = mobileMenuDrawer.querySelectorAll('.mobile-link');
    mobileLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenuDrawer.classList.remove('is-open');
        mobileNavToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // FAQ Accordion
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(item => {
    const header = item.querySelector('.faq-header');
    const body = item.querySelector('.faq-body');

    if (!header || !body) return;

    header.addEventListener('click', () => {
      const isCurrentlyActive = item.classList.contains('is-active');

      // Close all other accordion items for clean UX
      faqItems.forEach(otherItem => {
        if (otherItem !== item && otherItem.classList.contains('is-active')) {
          otherItem.classList.remove('is-active');
          const otherHeader = otherItem.querySelector('.faq-header');
          const otherBody = otherItem.querySelector('.faq-body');
          if (otherHeader) otherHeader.setAttribute('aria-expanded', 'false');
          if (otherBody) otherBody.style.maxHeight = null;
        }
      });

      // Toggle current item
      if (isCurrentlyActive) {
        item.classList.remove('is-active');
        header.setAttribute('aria-expanded', 'false');
        body.style.maxHeight = null;
      } else {
        item.classList.add('is-active');
        header.setAttribute('aria-expanded', 'true');
        body.style.maxHeight = body.scrollHeight + 'px';
      }
    });
  });
});

