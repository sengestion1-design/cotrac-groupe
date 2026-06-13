/* ============================================================
   COTRAC — JS Principal
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ---- Header scroll ---- */
  const header = document.querySelector('.header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  /* ---- Menu hamburger ---- */
  const hamburger = document.querySelector('.hamburger');
  const nav = document.querySelector('.nav');
  if (hamburger && nav) {
    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      nav.classList.toggle('open');
    });
    // Fermer au clic sur un lien du menu (mobile)
    nav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        hamburger.classList.remove('active');
        nav.classList.remove('open');
      });
    });
    // Fermer au clic dehors
    document.addEventListener('click', (e) => {
      if (!hamburger.contains(e.target) && !nav.contains(e.target)) {
        hamburger.classList.remove('active');
        nav.classList.remove('open');
      }
    });
  }

  /* ---- Animations au scroll (IntersectionObserver) ---- */
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

  // Attribuer automatiquement les classes d'animation aux éléments de page
  document.querySelectorAll(
    '.animate-fade-up, .animate-fade-left, .animate-fade-right, .animate-zoom-in, .section-tag, .admin-stat, .projet-card:not([data-pole]), .reveal, .temoignage-card, .partenaire-item, .pole-card'
  ).forEach(el => revealObserver.observe(el));

  // Auto-animate sections et contenus courants
  document.querySelectorAll('.section-header:not(.animate-fade-up)').forEach(el => {
    el.classList.add('animate-fade-up');
    revealObserver.observe(el);
  });

  // Titres h2 et h3 hors hero
  document.querySelectorAll('h2:not(.hero-title):not(.page-hero-title):not(.animate-fade-up), h3:not(.animate-fade-up)').forEach(el => {
    if (!el.closest('.page-hero') && !el.closest('.hero') && !el.closest('.header')) {
      el.classList.add('animate-fade-up');
      revealObserver.observe(el);
    }
  });

  // Paragraphes descriptifs des sections
  document.querySelectorAll('.section-desc:not(.animate-fade-up), .pole-desc:not(.animate-fade-up), .intro-text:not(.animate-fade-up)').forEach((el, i) => {
    el.classList.add('animate-fade-up');
    el.style.transitionDelay = '120ms';
    revealObserver.observe(el);
  });

  // Sections CTA : animer les enfants directs du container 2-colonnes
  document.querySelectorAll('.stats-section .container > div > div, .cta-section .container > div').forEach((el, i) => {
    if (!el.classList.contains('animate-fade-up') && !el.classList.contains('animate-fade-left') && !el.classList.contains('animate-fade-right')) {
      el.classList.add(i % 2 === 0 ? 'animate-fade-left' : 'animate-fade-right');
      revealObserver.observe(el);
    }
  });

  document.querySelectorAll('.stat-glass-card').forEach((el, i) => {
    el.classList.add('animate-zoom-in');
    el.style.transitionDelay = (i * 80) + 'ms';
    revealObserver.observe(el);
  });

  // Images : slide depuis gauche/droite en alternance
  document.querySelectorAll('.realisation-img, .about-img, .pole-img, .service-img').forEach((el, i) => {
    el.classList.add(i % 2 === 0 ? 'animate-fade-left' : 'animate-fade-right');
    revealObserver.observe(el);
  });

  // Temoignages
  document.querySelectorAll('.temoignage-card').forEach((el, i) => {
    el.classList.add('animate-fade-up');
    el.style.transitionDelay = (i * 100) + 'ms';
    revealObserver.observe(el);
  });

  // Partenaire logos
  document.querySelectorAll('.partenaire-inst-logo').forEach((el, i) => {
    el.classList.add('animate-zoom-in');
    el.style.transitionDelay = (i * 60) + 'ms';
    revealObserver.observe(el);
  });

  // Stats chiffres hero
  document.querySelectorAll('.stats-item, .stat-card').forEach((el, i) => {
    el.classList.add('animate-fade-up');
    el.style.transitionDelay = (i * 90) + 'ms';
    revealObserver.observe(el);
  });

  /* ---- Compteur animé ---- */
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('.counter').forEach(el => counterObserver.observe(el));

  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    if (isNaN(target)) return;
    const duration = 1800;
    const start = performance.now();
    const suffix = el.dataset.suffix || '';
    const update = (now) => {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target) + suffix;
      if (progress < 1) requestAnimationFrame(update);
      else el.textContent = target + suffix;
    };
    requestAnimationFrame(update);
  }

  /* ---- Filtres réalisations avec animation fluide ---- */
  const filterBtns = document.querySelectorAll('.filter-btn');
  const projetCards = document.querySelectorAll('.projet-card[data-pole]');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const pole = btn.dataset.filter;

      projetCards.forEach(card => {
        const show = pole === 'tous' || card.dataset.pole === pole;

        if (show) {
          // Si caché → réafficher avec animation
          if (card.style.display === 'none' || card.dataset.hidden === '1') {
            card.style.display = '';
            card.dataset.hidden = '0';
            // Forcer reflow pour que la transition soit visible
            void card.offsetWidth;
            card.style.opacity = '1';
            card.style.transform = 'translateY(0) scale(1)';
          }
        } else {
          // Masquer avec animation
          card.style.opacity = '0';
          card.style.transform = 'translateY(16px) scale(0.97)';
          card.dataset.hidden = '1';
          const onTransEnd = () => {
            if (card.dataset.hidden === '1') card.style.display = 'none';
            card.removeEventListener('transitionend', onTransEnd);
          };
          card.addEventListener('transitionend', onTransEnd);
        }
      });
    });
  });

  // Initialiser le style des cartes filtrables pour la transition
  projetCards.forEach(card => {
    card.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
    card.style.opacity = '1';
    card.style.transform = 'translateY(0) scale(1)';
    card.dataset.hidden = '0';
  });

  /* ---- Typewriter effect discret sur le titre hero ---- */
  const heroTitle = document.querySelector('.hero-title, h1.hero-title, .hero .section-title');
  if (heroTitle) {
    const spanEl = heroTitle.querySelector('span');
    if (spanEl) {
      const originalText = spanEl.textContent;
      spanEl.textContent = '';
      spanEl.style.borderRight = '2px solid currentColor';
      let i = 0;
      const type = () => {
        if (i < originalText.length) {
          spanEl.textContent += originalText[i++];
          setTimeout(type, 80);
        } else {
          // Supprimer le curseur clignotant après la fin
          setTimeout(() => { spanEl.style.borderRight = 'none'; }, 800);
        }
      };
      // Lancer après un court délai pour que la page soit visible
      setTimeout(type, 400);
    }
  }

  /* ---- Active nav link ---- */
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';
  document.querySelectorAll('.nav-link, .dropdown a').forEach(link => {
    const href = link.getAttribute('href') || '';
    if (href && currentPath && href.includes(currentPath)) {
      link.classList.add('active');
    }
  });

  /* ---- Smooth scroll ancres ---- */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', (e) => {
      const targetEl = document.querySelector(anchor.getAttribute('href'));
      if (targetEl) {
        e.preventDefault();
        targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* ---- Form contact validation ---- */
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      const nom = contactForm.querySelector('#nom')?.value.trim();
      const email = contactForm.querySelector('#email')?.value.trim();
      const message = contactForm.querySelector('#message')?.value.trim();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!nom || !email || !message) {
        e.preventDefault();
        showFormMsg('Veuillez remplir tous les champs obligatoires.', 'error');
        return;
      }
      if (!emailRegex.test(email)) {
        e.preventDefault();
        showFormMsg('Veuillez entrer une adresse email valide.', 'error');
      }
    });
  }

  function showFormMsg(msg, type) {
    const el = document.querySelector('.form-message');
    if (el) {
      el.textContent = msg;
      el.className = 'form-message ' + type;
    }
  }

  /* ---- Partenaires slider duplication ---- */
  const slider = document.querySelector('.partenaires-slider');
  if (slider) {
    slider.innerHTML += slider.innerHTML;
  }

  /* ---- 2. Header sticky animé — hauteur + logo ---- */
  // Déjà géré par .header.scrolled en CSS, le toggle est en haut du fichier.
  // On enrichit : border-bottom subtil qui disparaît au scroll
  if (header) {
    const onScroll = () => {
      if (window.scrollY > 40) {
        header.style.borderBottomColor = 'transparent';
      } else {
        header.style.borderBottomColor = '';
      }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  /* ---- 3. Section entrance — slide gauche/droite alternés ---- */
  const sectionEnterObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        sectionEnterObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.10, rootMargin: '0px 0px -60px 0px' });

  // Cibler les sections principales (hors hero)
  document.querySelectorAll('section:not(.hero):not(.page-hero):not(.hero-section)').forEach((sec, i) => {
    // Ne pas re-animer si déjà géré par stagger/reveal
    if (!sec.classList.contains('stagger-item') && !sec.classList.contains('animate-fade-up')) {
      sec.classList.add(i % 2 === 0 ? 'section-enter-left' : 'section-enter-right');
      sectionEnterObs.observe(sec);
    }
  });

  /* ---- 6. Back-to-top ---- */
  const btt = document.createElement('button');
  btt.id = 'back-to-top';
  btt.setAttribute('aria-label', 'Retour en haut');
  const bttSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
  bttSvg.setAttribute('viewBox', '0 0 24 24');
  const bttPoly = document.createElementNS('http://www.w3.org/2000/svg', 'polyline');
  bttPoly.setAttribute('points', '18 15 12 9 6 15');
  bttSvg.appendChild(bttPoly);
  btt.appendChild(bttSvg);
  document.body.appendChild(btt);

  window.addEventListener('scroll', () => {
    btt.classList.toggle('visible', window.scrollY > 320);
  }, { passive: true });

  btt.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  /* ---- Scroll progress bar ---- */
  const progressBar = document.createElement('div');
  progressBar.id = 'scroll-progress';
  document.body.prepend(progressBar);
  window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    progressBar.style.width = pct + '%';
  }, { passive: true });

  /* ---- Stagger entrance pour cards ---- */
  const staggerObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        staggerObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.10, rootMargin: '0px 0px -20px 0px' });

  document.querySelectorAll('.pole-card, .valeur-card, .service-item, .projet-card, .tl-item, .equipe-card, .equipement-card, .avantage-item, .etape-card').forEach((el, i) => {
    el.classList.add('stagger-item');
    el.style.transitionDelay = (i % 5) * 80 + 'ms';
    staggerObserver.observe(el);
  });

  /* ---- Parallax hero ---- */
  const heroBg = document.querySelector('.hero-parallax-bg');
  if (heroBg) {
    window.addEventListener('scroll', () => {
      const scrolled = window.scrollY;
      heroBg.style.transform = `translateY(${scrolled * 0.35}px)`;
    }, { passive: true });
  }

  /* ---- Curseur personnalisé (désactivé) ---- */
  if (false && !window.matchMedia('(pointer: coarse)').matches) {
    document.body.classList.add('custom-cursor');

    const cursorDot = document.createElement('div');
    cursorDot.className = 'cursor-dot';
    const cursorRing = document.createElement('div');
    cursorRing.className = 'cursor-ring';
    // Masqué jusqu'au premier mouvement de souris
    cursorDot.style.opacity = '0';
    cursorRing.style.opacity = '0';
    document.body.appendChild(cursorDot);
    document.body.appendChild(cursorRing);

    let moved = false;
    window.addEventListener('mousemove', (e) => {
      if (!moved) {
        cursorDot.style.opacity = '1';
        cursorRing.style.opacity = '1';
        moved = true;
      }
      cursorDot.style.left = e.clientX + 'px';
      cursorDot.style.top  = e.clientY + 'px';
      cursorRing.style.left = e.clientX + 'px';
      cursorRing.style.top  = e.clientY + 'px';
    }, { passive: true });

    document.addEventListener('mouseleave', () => {
      cursorDot.style.opacity = '0';
      cursorRing.style.opacity = '0';
    });
    document.addEventListener('mouseenter', () => {
      if (moved) {
        cursorDot.style.opacity = '1';
        cursorRing.style.opacity = '1';
      }
    });

    const hoverTargets = 'a, button, .btn, .pole-card, .valeur-card, .galerie-item';
    document.querySelectorAll(hoverTargets).forEach(el => {
      el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
      el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
    });
  }

  /* ---- Compteurs animés stats hero ---- */
  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.querySelectorAll('.stat-value[data-target]').forEach(el => {
          if (!el.dataset.animated) {
            el.dataset.animated = '1';
            animateCounter(el);
          }
        });
      }
    });
  }, { threshold: 0.4 });

  document.querySelectorAll('.hero-stats').forEach(el => statsObserver.observe(el));

  /* ---- Ripple effect sur les boutons ---- */
  document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
      const rect = btn.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;
      const ripple = document.createElement('span');
      ripple.className = 'ripple';
      ripple.style.cssText = `width:${size}px;height:${size}px;left:${x}px;top:${y}px;`;
      btn.appendChild(ripple);
      setTimeout(() => ripple.remove(), 600);
    });
  });

  /* ---- Tilt 3D sur les cartes (desktop uniquement) ---- */
  if (window.innerWidth > 768) {
    document.querySelectorAll('.pole-card, .projet-card, .temoignage-card').forEach(card => {
      card.addEventListener('mousemove', function(e) {
        const r = card.getBoundingClientRect();
        const x = (e.clientY - r.top  - r.height / 2) / (r.height / 2);
        const y = (e.clientX - r.left - r.width  / 2) / (r.width  / 2);
        card.style.transform = `perspective(700px) rotateX(${-x * 6}deg) rotateY(${y * 6}deg) translateY(-6px)`;
      });
      card.addEventListener('mouseleave', function() {
        card.style.transform = '';
      });
    });
  }

  /* ---- Badge hero : slide-in depuis la gauche ---- */
  const heroBadge = document.querySelector('.hero-badge');
  if (heroBadge) {
    heroBadge.classList.add('hero-badge--animate');
  }

});
