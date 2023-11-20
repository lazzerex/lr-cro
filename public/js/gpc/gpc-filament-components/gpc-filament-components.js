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
            const categoryFieldset = document.querySelectorAll('.select-categories');
            if (! categoryFieldset.length) return;

            categoryFieldset.forEach(function (elem) {
                let tree = elem.querySelector('[x-ref="tree"]');
                let primarySelect = elem.querySelector('.primary-category');

                tree.addEventListener('input', function (e) {
                    let selected = e.detail;
                    let primaryId = primarySelect.value;
                    primarySelect.querySelectorAll('option:not(:first-child)').forEach(item => item.remove() );

                    selected.forEach(function (item) {
                        let selectedElement = tree.querySelector('.treeselect-input__tags-element[tag-id="' + item + '"]');

                        let label = selectedElement.getAttribute('title');
                        var element = document.createElement("option");
                        element.innerText = label;
                        element.value = item;
                        if (item == primaryId) {
                            element.selected = true;
                        }
                        primarySelect.appendChild(element);
                    });
                });

            })

        });
    }
}

(new SEOInputHandler()).init();
(new SelectTreeExtension()).init();