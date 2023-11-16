<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    class="relative z-0"
>
	@php
		$textareaID = 'tiny-editor-' . str_replace(['.', '#', '$'], '', $getId());
	@endphp

    <div
		x-data="{ state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }}, initialized: false }"

        x-init="(() => {
            $nextTick(() => {
				tinymce.init({
					selector: '#{{ $textareaID }}',

					file_picker_callback (callback, value, meta) {
						let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
						let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

						tinymce.activeEditor.windowManager.openUrl({
							url : '{{ $getFilePickerUrl() }}',
							title : 'Laravel File manager',
							width : x * 0.8,
							height : y * 0.8,
							onMessage: (api, message) => {
								callback(message.content, { text: message.text })
							}
						})
					},

					plugins: '{{ $getPlugins() }}',
					statusbar: true,
					promotion: false,
					branding: false,
					resize: true,
					deprecation_warnings: false,

					max_height: {{ $getMaxHeight() }},
					min_height: {{ $getMinHeight() }},

					font_size_input_default_unit: 'px',
					entity_encoding: 'raw',
					relative_urls: false,
					remove_script_host: true,
					convert_urls: true,

					automatic_uploads: true,
					images_reuse_filename: true,
					image_advtab: true,
					image_dimensions: false,

					insertdatetime_formats: [ '%d-%m-%Y', '%d/%m/%Y', '%D', '%Y-%m-%d', '%H:%M:%S', '%I:%M:%S %p', ],

					toolbar_mode: 'wrap',
					toolbar_sticky: {{ $getToolbarSticky() ? 'true' : 'false' }},
					toolbar_sticky_offset: 64,
					toolbar: '{{ $getToolbar() }}',

					quickbars_insert_toolbar: false,
					quickbars_selection_toolbar: 'bold italic forecolor | blocks | quicklink blockquote',

					menubar: {{ $getShowMenuBar() ? 'true' : 'false' }},

					setup: function (editor) {
						if(!window.tinySettingsCopy) {
                            window.tinySettingsCopy = [];
                        }

                        if (!window.tinySettingsCopy.some(obj => obj.id === editor.settings.id)) {
                            window.tinySettingsCopy.push(editor.settings);
                        }

						editor.on('blur', function(e) {
							state = editor.getContent()
						});

						editor.on('init', function(e) {
							if (state != null) {
							    editor.setContent(state)
							}
						});

						editor.on('OpenWindow', function(e) {
							target = e.target.container.closest('.fi-modal')
							if (target) target.setAttribute('x-trap.noscroll', 'false')
						});

						editor.on('CloseWindow', function(e) {
							target = e.target.container.closest('.fi-modal')
							if (target) target.setAttribute('x-trap.noscroll', 'isOpen')
						});

						function putCursorToEnd() {
                            editor.selection.select(editor.getBody(), true);
                            editor.selection.collapse(false);
                        }

						$watch('state', function(newstate) {
                            if (editor.container && newstate !== editor.getContent()) {
                                editor.resetContent(newstate || '');
                                putCursorToEnd();
                            }
                        });
					},

					{{ $getCustomConfigs() }}
				});
            });
        })()"
        x-cloak
        wire:ignore
    >
        @unless($isDisabled())
			<input
                id="{{ $textareaID }}"
				type="hidden"
                x-ref="tinymce"
                placeholder="{{ $getPlaceholder() }}"
            >
        @else
            <div
                x-html="state"
                class="block w-full max-w-none rounded-lg border border-gray-300 bg-white p-3 opacity-70 shadow-sm transition duration-75 prose dark:prose-invert dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            ></div>
        @endunless
    </div>
</x-dynamic-component>

@pushOnce('scripts')
<script>
window.addEventListener('beforeunload', (event) => {
    if (tinymce.activeEditor.isDirty()) {
        event.preventDefault();
		// Included for legacy support, e.g. Chrome/Edge < 119
		event.returnValue = '{{ __("Are you sure you want to leave?") }}';
    }
});
</script>
@endPushOnce