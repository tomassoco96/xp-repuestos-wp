/**
 * XP Repuestos · motion + UX
 * ----------------------------------------------------------------
 * Equivalente al script inline del Layout.astro pero standalone.
 * Cargado con `defer` desde inc/enqueue.php.
 */
(function () {
  'use strict';

  /**
   * Scroll reveal — agrega .is-visible a `.xp-reveal` y `.xp-reveal-stagger`
   * cuando entran al viewport. Si no hay IntersectionObserver, los hace
   * visibles directamente para no romper la página.
   */
  function initReveal() {
    var els = document.querySelectorAll('.xp-reveal, .xp-reveal-stagger');
    if (!els.length) return;

    if (!('IntersectionObserver' in window)) {
      els.forEach(function (el) { el.classList.add('is-visible'); });
      return;
    }

    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            io.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12, rootMargin: '0px 0px -60px 0px' }
    );

    els.forEach(function (el) { io.observe(el); });
  }

  /**
   * Tilt 3D suave en elementos con [data-xp-tilt].
   */
  function initTilt() {
    var prefersReduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduce) return;

    var els = document.querySelectorAll('[data-xp-tilt]');
    els.forEach(function (el) {
      el.addEventListener('mousemove', function (e) {
        var rect = el.getBoundingClientRect();
        var x = (e.clientX - rect.left) / rect.width - 0.5;
        var y = (e.clientY - rect.top) / rect.height - 0.5;
        el.style.transform = 'perspective(900px) rotateX(' + (y * -4).toFixed(2) + 'deg) rotateY(' + (x * 4).toFixed(2) + 'deg)';
      });
      el.addEventListener('mouseleave', function () {
        el.style.transform = '';
      });
    });
  }

  /**
   * Mobile nav toggle.
   */
  function initMobileNav() {
    var toggle = document.getElementById('xp-nav-toggle');
    var nav = document.getElementById('xp-mobile-nav');
    if (!toggle || !nav) return;

    toggle.addEventListener('click', function () {
      var isOpen = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', String(isOpen));
      toggle.setAttribute('aria-label', isOpen ? 'Cerrar menú' : 'Abrir menú');
    });

    // Cerrar al click en link interno.
    nav.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        nav.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /**
   * Loading bar al click en navegación interna (simulación de view transition).
   */
  function initProgress() {
    var bar = document.getElementById('xp-progress');
    if (!bar) return;

    document.addEventListener('click', function (e) {
      var anchor = e.target && e.target.closest ? e.target.closest('a[href]') : null;
      if (!anchor) return;
      var href = anchor.getAttribute('href');
      if (!href) return;
      if (anchor.target === '_blank') return;
      if (href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('javascript:')) return;
      // Solo same-origin.
      try {
        var url = new URL(href, location.href);
        if (url.origin !== location.origin) return;
      } catch (err) { return; }

      bar.classList.remove('done');
      bar.classList.add('loading');
    });

    window.addEventListener('beforeunload', function () {
      bar.classList.add('done');
    });
  }

  function init() {
    initReveal();
    initTilt();
    initMobileNav();
    initProgress();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
