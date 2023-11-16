<?php

namespace Gpc\FilamentComponents\Forms\Components;

use Filament\Forms\Components\Field;

class ImagePicker extends Field
{
    protected string $view = 'gpc-filament-components::forms.components.image-picker';

    protected string $filePickerUrl = '';

    public function getFilePickerUrl(): string
    {
        return filled($this->filePickerUrl) ? $this->filePickerUrl : config('gpc-filament-components.file-manager.picker-url');
    }
}
