



(() => {
  'use strict';

  const META = {
    success: { title: 'Berhasil', icon: 'bi-check-lg', timeout: 3400 },
    error: { title: 'Gagal', icon: 'bi-x-lg', timeout: 6200 },
    waiting: { title: 'Tunggu Sebentar', icon: 'bi-arrow-repeat', timeout: 5600 },
    warning: { title: 'Perhatian', icon: 'bi-exclamation-lg', timeout: 5200 },
    info: { title: 'Informasi', icon: 'bi-info-lg', timeout: 4800 }
  };

  const ensureStage = () => {
    let stage = document.querySelector('[data-notification-stage]');
    if (stage) return stage;

    stage = document.createElement('div');
    stage.className = 'notification-stage';
    stage.setAttribute('data-notification-stage', '');
    stage.setAttribute('aria-live', 'assertive');
    stage.setAttribute('aria-atomic', 'false');
    document.body.appendChild(stage);
    return stage;
  };

  const dismiss = (card) => {
    if (!card || card.dataset.dismissed === '1') return;
    card.dataset.dismissed = '1';
    card.classList.add('is-leaving');

    window.setTimeout(() => {
      card.remove();
      const stage = document.querySelector('[data-notification-stage]');
      if (stage && !stage.querySelector('[data-notification]')) {
        stage.remove();
      }
    }, 280);
  };

  const present = (card, index = 0) => {
    const timeout = Math.max(
      1800,
      Number.parseInt(card.dataset.timeout || '4500', 10) || 4500
    );

    card.style.setProperty('--notification-timeout', `${timeout}ms`);

    window.setTimeout(() => {
      card.classList.add('is-visible');
    }, 30 + (index * 80));

    const timer = window.setTimeout(() => dismiss(card), timeout);

    card.querySelector('[data-notification-close]')?.addEventListener('click', () => {
      window.clearTimeout(timer);
      dismiss(card);
    });
  };

  const buildCard = (type, message) => {
    const meta = META[type] || META.info;
    const card = document.createElement('section');
    card.className = `center-notification ${type}`;
    card.setAttribute('data-notification', '');
    card.setAttribute('data-timeout', String(meta.timeout));
    card.setAttribute('role', type === 'error' ? 'alert' : 'status');
    card.innerHTML = '<button class="notification-close" type="button" data-notification-close aria-label="Tutup notifikasi">'
      + '<i class="bi bi-x" aria-hidden="true"></i></button>'
      + `<div class="notification-symbol ${type}" aria-hidden="true"><span class="notification-symbol-ring"></span>`
      + `<i class="bi ${meta.icon}"></i></div>`
      + `<strong class="notification-title">${meta.title}</strong>`
      + `<p class="notification-message"></p>`
      + '<div class="notification-progress" aria-hidden="true"><span></span></div>';
    card.querySelector('.notification-message').textContent = String(message || '');
    return card;
  };

  window.nmsNotify = (type, message) => {
    const normalized = String(type || 'info').toLowerCase();
    const card = buildCard(META[normalized] ? normalized : 'info', message);
    ensureStage().appendChild(card);
    present(card);
    return card;
  };

  Array.from(document.querySelectorAll('[data-notification]')).forEach((card, index) => present(card, index));
})();

