<?php

namespace Gpc\FilamentComponents\Forms\Components;

use Filament\Forms\Components\Field;

class ImagePicker extends Field
{
    protected string $view = 'gpc-filament-components::forms.components.image-picker';

    protected string $filePickerUrl = '';

    protected string $previewWidth = '300px';

    public function getFilePickerUrl(): string
    {
        return filled($this->filePickerUrl) ? $this->filePickerUrl : config('gpc-filament-components.file-manager.picker-url');
    }

    public function getPreviewWidth(): string
    {
        return $this->previewWidth;
    }

    public function previewWidth(string $height): static
    {
        $this->previewWidth = $height;

        return $this;
    }
}
