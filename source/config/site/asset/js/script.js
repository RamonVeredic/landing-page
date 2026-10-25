(() => {
  'use strict';

  // Mobile navigation is available on all pages.
  const toggle = document.querySelector('[data-nav-toggle]');
  const mainNav = document.querySelector('[data-main-nav]');

  const closeNav = () => {
    if (!toggle || !mainNav) return;
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Buka navigasi');
    mainNav.classList.remove('is-open');
    const icon = toggle.querySelector('i');
    if (icon) icon.className = 'bi bi-list';
  };

  toggle?.addEventListener('click', () => {
    if (!mainNav) return;
    const open = toggle.getAttribute('aria-expanded') !== 'true';
    toggle.setAttribute('aria-expanded', String(open));
    toggle.setAttribute('aria-label', open ? 'Tutup navigasi' : 'Buka navigasi');
    mainNav.classList.toggle('is-open', open);
    const icon = toggle.querySelector('i');
    if (icon) icon.className = open ? 'bi bi-x-lg' : 'bi bi-list';
  });

  mainNav?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', closeNav);
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closeNav();
  });

  document.addEventListener('click', (event) => {
    if (!toggle || !mainNav || !(event.target instanceof Node)) return;
    if (!toggle.contains(event.target) && !mainNav.contains(event.target)) closeNav();
  });

  // Documentation panel management; skipped outside /dokumentasi.
  const categoryView = document.querySelector('[data-documentation-categories]');
  const categoryButtons = [...document.querySelectorAll('[data-documentation-open]')];
  const groups = [...document.querySelectorAll('[data-documentation-panel]')];
  const detailToolbar = document.querySelector('[data-documentation-detail-toolbar]');
  const backButton = document.querySelector('[data-documentation-back]');
  const oidToolbar = document.querySelector('[data-oid-toolbar]');
  const searchForm = document.querySelector('.oid-search');
  const searchInput = document.getElementById('oidSearchInput');
  const searchStatus = document.getElementById('oidSearchStatus');

  if (!categoryView || groups.length === 0) return;
  let activePanel = '';

  const showCategories = () => {
    activePanel = '';
    categoryView.hidden = false;
    if (detailToolbar) detailToolbar.hidden = true;
    if (oidToolbar) oidToolbar.hidden = true;
    if (searchStatus) {
      searchStatus.hidden = true;
      searchStatus.textContent = '';
    }
    if (searchInput) searchInput.value = '';
    groups.forEach((group) => { group.hidden = true; });
    history.replaceState(null, '', location.pathname + location.search);
  };

  const openCategory = (id, shouldScroll = true) => {
    const selected = groups.find((group) => group.dataset.documentationPanel === id);
    if (!selected) return false;
    activePanel = id;
    categoryView.hidden = true;
    if (detailToolbar) detailToolbar.hidden = false;
    const isOid = selected.dataset.docKind === 'oid';
    if (oidToolbar) oidToolbar.hidden = !isOid;
    if (searchStatus) {
      searchStatus.hidden = !isOid;
      searchStatus.textContent = '';
    }
    if (searchInput) searchInput.value = '';
    selected.querySelectorAll('tbody tr').forEach((row) => { row.hidden = false; });
    groups.forEach((group) => { group.hidden = group !== selected; });
    history.replaceState(null, '', '#' + encodeURIComponent(id));
    if (shouldScroll) selected.scrollIntoView({ behavior: 'smooth', block: 'start' });
    return true;
  };

  const filterOidRows = () => {
    const panel = groups.find((group) => group.dataset.documentationPanel === activePanel);
    if (!panel || panel.dataset.docKind !== 'oid' || !searchInput) return;
    const query = searchInput.value.trim().toLocaleLowerCase('id-ID');
    let found = 0;
    panel.querySelectorAll('tbody tr').forEach((row) => {
      const matches = query === '' || row.textContent.toLocaleLowerCase('id-ID').includes(query);
      row.hidden = !matches;
      if (matches) found += 1;
    });
    if (searchStatus) searchStatus.textContent = query ? found + ' OID ditemukan untuk “' + searchInput.value.trim() + '”.' : '';
  };

  categoryButtons.forEach((button) => button.addEventListener('click', () => openCategory(button.dataset.documentationOpen || '')));
  backButton?.addEventListener('click', showCategories);
  searchForm?.addEventListener('submit', (event) => { event.preventDefault(); filterOidRows(); });
  searchInput?.addEventListener('input', filterOidRows);

  const startingCategory = decodeURIComponent(location.hash.replace(/^#/, ''));
  if (!startingCategory || !openCategory(startingCategory, false)) showCategories();

  // Copy code samples in technical guides.
  const copyText = async (text) => {
    if (navigator.clipboard && window.isSecureContext) {
      await navigator.clipboard.writeText(text);
      return true;
    }
    const field = document.createElement('textarea');
    field.value = text;
    field.setAttribute('readonly', '');
    field.style.position = 'fixed';
    field.style.opacity = '0';
    document.body.appendChild(field);
    field.select();
    const copied = document.execCommand('copy');
    field.remove();
    return copied;
  };

  document.addEventListener('click', async (event) => {
    if (!(event.target instanceof Element)) return;
    const button = event.target.closest('[data-copy-code], [data-copy-text]');
    if (!(button instanceof HTMLButtonElement)) return;
    const codeBlock = button.closest('.documentation-code-block')?.querySelector('pre');
    const text = button.hasAttribute('data-copy-code') ? (codeBlock?.textContent || '') : (button.dataset.copyText || '');
    if (!text) return;
    const label = button.querySelector('span');
    try {
      const copied = await copyText(text);
      if (label) label.textContent = copied ? 'Tersalin' : 'Pilih dan salin';
    } catch {
      if (label) label.textContent = 'Pilih dan salin';
    }
    window.setTimeout(() => { if (label) label.textContent = 'Salin'; }, 1800);
  });
})();
