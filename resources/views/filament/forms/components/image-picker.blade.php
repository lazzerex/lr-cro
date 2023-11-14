<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }"
        x-on:file-selected.window="state = $event.detail.url">
        <x-filament::button
            type="button"
            icon="heroicon-o-document-arrow-up"
            outlined="true"
            x-on:click="window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');"
            x-show="state == null"
        >
            {{ __('Add Media') }}
        </x-filament::button>

        <div class="relative block h-64 w-full gap-4 overflow-hidden rounded-lg border border-gray-300 shadow-sm transition duration-75 dark:border-gray-600 dark:bg-gray-700 dark:text-white" x-show="state != null">
            <img
                :src="state"
                class="checkered h-full w-full object-cover mb-3"
            />
            <div class="filament-page-actions filament-form-actions flex flex-wrap items-center justify-start gap-4 p-3">
                <x-filament::button
                    type="button"
                    icon="heroicon-o-arrow-path"
                    x-on:click="window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');"
                >
                    {{ __('Change Media') }}
                </x-filament::button>

                <x-filament::button
                    color="danger"
                    type="button"
                    icon="heroicon-o-x-circle"
                    x-on:click="state = null"
                >{{ __('Clear Media') }}
                </x-filament::button>
            </div>
        </div>
    </div>
</x-dynamic-component>
