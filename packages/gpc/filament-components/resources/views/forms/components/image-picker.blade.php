@php
    $previewWidth = $getPreviewWidth();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }"
        x-on:file-selected.window="let target = $event.detail.target; if (target == '{{ $getStatePath() }}') state = $event.detail.path;">
        <x-filament::button
            type="button"
            icon="heroicon-o-document-arrow-up"
            outlined="true"
            x-on:click="window.open('{{ $getFilePickerUrl() }}?target={{ $getStatePath() }}', 'fm', 'width=1100,height=800');"
            x-show="state == null"
        >
            {{ __('Add Media') }}
        </x-filament::button>

        <div class="relative flex flex-col w-full gap-2 rounded-lg  justify-center justify-items-center items-center" x-show="state != null">
            <img
                :src="state"
                class="mb-2 p-1 w-auto border border-gray-300 shadow-sm transition duration-75 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                style="width: {{ $previewWidth }}; object-fit:cover; aspect-ratio:1/1"
            />
            <div class="filament-page-actions filament-form-actions flex flex-wrap justify-center items-center gap-2">
                <x-filament::button
                    type="button"
                    icon="heroicon-o-arrow-path"
                    x-on:click="window.open('{{ $getFilePickerUrl() }}?target={{ $getStatePath() }}', 'fm', 'width=1100,height=800');"
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
