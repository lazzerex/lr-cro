class SEOInputHandler
{
    bindSeoInputEvent(seoInputElement, inputElement) {
        seoInputElement.addEventListener('keyup', (event) => {
            let value = seoInputElement.value;
            if (value.length == 0) {
                value = inputElement.value;
                seoInputElement.placeholder = inputElement.value;
            }

            let length = value.length;
            let maxLength = seoInputElement.dataset.maxLength;

            let $field = seoInputElement.closest('.fi-fo-field-wrp');
            let $fieldHint = $field.querySelector('.fi-fo-field-wrp-hint');
            $fieldHint.innerHTML = length + '/' + maxLength;
        }, false);
    }

    bindInputEvent(inputElement, seoInputElement) {
        inputElement.addEventListener('keyup', (event) => {
            if (seoInputElement.value.length) return;

            let length = inputElement.value.length;
            let maxLength = seoInputElement.dataset.maxLength;
            let $field = seoInputElement.closest('.fi-fo-field-wrp');
            let $fieldHint = $field.querySelector('.fi-fo-field-wrp-hint');
            $fieldHint.innerHTML = length + '/' + maxLength;
            seoInputElement.placeholder = inputElement.value;
        }, false);
    }

    bindEvents(seoInputSelector) {
        let seoInput = document.querySelector(seoInputSelector);
        let inputId = seoInput.dataset.placeholder;
        let input = document.querySelector('#data\\.' + inputId);

        this.bindSeoInputEvent(seoInput, input);
        this.bindInputEvent(input, seoInput);
    }

    init() {
        let _this = this;
        document.addEventListener('livewire:initialized', function () {
            if (document.querySelector('.fi-input-seo-title')) {
                _this.bindEvents('.fi-input-seo-title');
            }
            if (document.querySelector('.fi-input-seo-description')) {
                _this.bindEvents('.fi-input-seo-description');
            }
        });
    }
}

class SelectTreeExtension
{
    init() {
        let _this = this;
        document.addEventListener('livewire:initialized', function () {
            const categoryFieldset = document.querySelector('#selectCategories');
            if (! categoryFieldset) return;

            let tree = categoryFieldset.querySelector('[x-ref="tree"]');
            let primarySelect = categoryFieldset.querySelector('.primary-category');
            tree.addEventListener('input', function (e) {
                let selected = e.detail;
                primarySelect.querySelectorAll("option").forEach(opt => {
                    let value = parseInt(opt.value)
                    console.log(selected, value, selected.includes(value));
                    if (! selected.includes(value)) {
                        opt.disabled = true;
                    } else {
                        opt.disabled = false;
                    }
                });
            });
        });
    }
}

(new SEOInputHandler()).init();
(new SelectTreeExtension()).init();