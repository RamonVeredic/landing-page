(() => {
    'use strict';

    const form = document.querySelector('.feedback-form');
    const fields = form ? [...form.querySelectorAll('input[required], textarea[required]')] : [];
    if (!form || fields.length === 0) return;

    const wrapperOf = (field) => field.closest('[data-tip]') || field.parentElement;
    fields.forEach((field) => {
        const wrapper = wrapperOf(field);
        if (wrapper) wrapper.dataset.tipDefault = wrapper.dataset.tip || '';
    });

    const messageFor = (field) => {
        if (field.validity.valueMissing) return 'Harap isi bidang ini';
        if (field.validity.tooShort) return 'Minimal ' + field.minLength + ' karakter';
        if (field.validity.tooLong) return 'Maksimal ' + field.maxLength + ' karakter';
        return 'Periksa kembali isian ini';
    };

    const hideTip = (field) => {
        const wrapper = wrapperOf(field);
        if (!wrapper) return;
        wrapper.dataset.tip = wrapper.dataset.tipDefault || wrapper.dataset.tip || '';
        wrapper.classList.remove('is-tip-open', 'is-tip-error');
    };

    const showTip = (field) => {
        const wrapper = wrapperOf(field);
        if (!wrapper) return;
        wrapper.dataset.tip = messageFor(field);
        wrapper.classList.add('is-tip-open', 'is-tip-error');
    };

    form.addEventListener('submit', (event) => {
        const invalid = fields.find((field) => !field.checkValidity());
        if (!invalid) return;
        event.preventDefault();
        fields.forEach(hideTip);
        showTip(invalid);
        invalid.focus({ preventScroll: true });
        invalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    fields.forEach((field) => {
        const refresh = () => {
            if (field.checkValidity()) {
                hideTip(field);
            } else if (wrapperOf(field)?.classList.contains('is-tip-open')) {
                showTip(field);
            }
        };
        field.addEventListener('input', refresh);
        field.addEventListener('change', refresh);
    });
})();
