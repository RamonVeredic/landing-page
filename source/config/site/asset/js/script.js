(() => {
  'use strict';

  const form = document.querySelector('.oid-search');
  const input = document.getElementById('oidSearchInput');
  const status = document.getElementById('oidSearchStatus');
  const groups = Array.from(document.querySelectorAll('.oid-reference-group'));
  const categoryView = document.querySelector('[data-documentation-categories]');
  const detailToolbar = document.querySelector('[data-documentation-detail-toolbar]');
  const oidToolbar = document.querySelector('[data-oid-toolbar]');
  const categoryButtons = Array.from(document.querySelectorAll('[data-documentation-open]'));
  const backButton = document.querySelector('[data-documentation-back]');

  if (!form || !input || !status || !categoryView || groups.length === 0) return;

  let activePanel = '';

  const showCategories = () => {
    activePanel = '';
    categoryView.hidden = false;
    if (detailToolbar) detailToolbar.hidden = true;
    if (oidToolbar) oidToolbar.hidden = true;
    status.hidden = true;
    groups.forEach((group) => { group.hidden = true; });
    input.value = '';
    status.textContent = '';
    history.replaceState(null, '', `${location.pathname}${location.search}`);
  };

  const openCategory = (id) => {
    const selected = groups.find((group) => group.dataset.documentationPanel === id);
    if (!selected) return;
    activePanel = id;
    categoryView.hidden = true;
    if (detailToolbar) detailToolbar.hidden = false;
    if (oidToolbar) oidToolbar.hidden = id === 'waha-installation';
    status.hidden = id === 'waha-installation';
    groups.forEach((group) => { group.hidden = group !== selected; });
    input.value = '';
    status.textContent = '';
    history.replaceState(null, '', `#${encodeURIComponent(id)}`);
    selected.scrollIntoView({ behavior: 'smooth', block: 'start' });
  };

  const filterRows = () => {
    const query = input.value.trim().toLocaleLowerCase('id-ID');
    let visibleRows = 0;

    groups.filter((group) => group.dataset.documentationPanel !== 'waha-installation').forEach((group) => {
      let groupRows = 0;
      group.querySelectorAll('tbody tr').forEach((row) => {
        const match = query === '' || row.textContent.toLocaleLowerCase('id-ID').includes(query);
        row.hidden = !match;
        if (match) groupRows += 1;
      });
      group.hidden = activePanel !== '' ? group.dataset.documentationPanel !== activePanel || groupRows === 0 : groupRows === 0;
      visibleRows += groupRows;
    });

    status.textContent = query === ''
      ? ''
      : `${visibleRows} OID ditemukan untuk “${input.value.trim()}”.`;
  };

  form.addEventListener('submit', (event) => {
    event.preventDefault();
    filterRows();
  });

  input.addEventListener('input', () => {
    if (input.value === '') filterRows();
  });

  categoryButtons.forEach((button) => button.addEventListener('click', () => openCategory(button.dataset.documentationOpen || '')));
  backButton?.addEventListener('click', showCategories);

  const initialCategory = decodeURIComponent(location.hash.replace(/^#/, ''));
  if (initialCategory && groups.some((group) => group.dataset.documentationPanel === initialCategory)) openCategory(initialCategory);
  else showCategories();

  const copyText = async (value) => {
    if (navigator.clipboard && window.isSecureContext) {
      await navigator.clipboard.writeText(value);
      return true;
    }
    const temporary = document.createElement('textarea');
    temporary.value = value;
    temporary.setAttribute('readonly', '');
    temporary.style.position = 'fixed';
    temporary.style.opacity = '0';
    temporary.style.pointerEvents = 'none';
    document.body.appendChild(temporary);
    temporary.focus();
    temporary.select();
    temporary.setSelectionRange(0, temporary.value.length);
    const copied = document.execCommand('copy');
    temporary.remove();
    return copied;
  };

  const showCopyResult = (button, copied) => {
    const label = button.querySelector('span');
    if (label) label.textContent = copied ? 'Tersalin' : 'Pilih dan salin';
    window.setTimeout(() => { if (label) label.textContent = 'Salin'; }, 1600);
  };

  document.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-copy-code], [data-copy-text]');
    if (!(button instanceof HTMLButtonElement)) return;
    const code = button.hasAttribute('data-copy-code')
      ? button.closest('.documentation-code-block')?.querySelector('pre code')
      : null;
    const value = code?.textContent || button.dataset.copyText || '';
    if (value === '') return;
    try {
      showCopyResult(button, await copyText(value));
    } catch (error) {
      if (code) {
        const range = document.createRange();
        range.selectNodeContents(code);
        const selection = window.getSelection();
        selection?.removeAllRanges();
        selection?.addRange(range);
      }
      showCopyResult(button, false);
    }
  });
})();
