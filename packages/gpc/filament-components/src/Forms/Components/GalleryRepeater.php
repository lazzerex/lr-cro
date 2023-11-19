<?php
namespace Gpc\FilamentComponents\Forms\Components;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class GalleryRepeater
{
    public static function make(string $field, string $label = '', string $statePath = 'gallery_data', int $maxItems = 0)
    {
        $repeater = Repeater::make($field)
            ->schema([
                ImagePicker::make('image')
                    ->previewWidth('100px'),
                Group::make([
                    TextInput::make('caption'),
                    Textarea::make('description'),
                ])
            ])
            ->collapsible()
            ->columns(['md' => 2])
            ->itemLabel(fn (array $state): ?string => $state['caption'] ?? null);

        if (filled($label)) {
            $repeater->label($label);
        }

        if ($maxItems > 0) {
            $repeater->maxItems($maxItems);
        }

        return $repeater;
    }
}