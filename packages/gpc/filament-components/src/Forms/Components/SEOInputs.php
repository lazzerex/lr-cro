<?php
namespace Gpc\FilamentComponents\Forms\Components;

use Filament\Forms\Components\Group;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SEOInputs
{
    public static function make(string $titleField = 'title', string $descriptionField = 'excerpt'): Group
    {
        $titleMaxLength = 65;
        $descriptionMaxLength = 160;
        $statePath = 'metas';

        $fields = [
            'title',
            'description',
            'keyword',
            'og_title',
            'og_description',
            'twitter_title',
            'twitter_description',
        ];

        return Group::make([
            Tabs::make()
                ->tabs([
                    Tab::make('Meta tags')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label(__('Meta title'))
                                ->hint(function ($state, $livewire) use ($titleField, $titleMaxLength) {
                                    $length = 0;
                                    $record = $livewire->record;
                                    if (blank($state)) {
                                        $length = $record ? Str::length($record->{$titleField}) : 0;
                                    } else {
                                        $length = Str::length($state);
                                    }

                                    return $length.'/'.$titleMaxLength;
                                })
                                ->placeholder(fn ($livewire) => $livewire->record?->{$titleField})
                                ->extraInputAttributes([
                                    'class' => 'fi-input-seo-title',
                                    'data-placeholder' => $titleField,
                                    'data-max-length' => $titleMaxLength,
                                ]),
                            Forms\Components\TextInput::make('keyword'),
                            Forms\Components\Textarea::make('description')
                                ->rows(4)
                                ->label(__('Meta description'))
                                ->hint(function ($state, $livewire) use ($descriptionField, $descriptionMaxLength) {
                                    $length = 0;
                                    $record = $livewire->record;
                                    if (blank($state)) {
                                        $length = $record ? Str::length($record->{$descriptionField}) : 0;
                                    } else {
                                        $length = Str::length($state);
                                    }

                                    return $length.'/'.$descriptionMaxLength;
                                })
                                ->placeholder(fn ($livewire) => $livewire->record?->{$descriptionField})
                                ->extraInputAttributes([
                                    'class' => 'fi-input-seo-description',
                                    'data-placeholder' => $descriptionField,
                                    'data-max-length' => $descriptionMaxLength,
                                ]),
                        ]),
                    Tab::make('Open Graph')
                        ->schema([
                            Forms\Components\TextInput::make('og_title')
                                ->label(__('Title')),
                            Forms\Components\Textarea::make('og_description')
                                ->label(__('Description'))
                                ->rows(4),
                        ]),
                    Tab::make('Twitter Card')
                        ->schema([
                            Forms\Components\TextInput::make('twitter_title')
                                ->label(__('Title')),
                            Forms\Components\Textarea::make('twitter_description')
                                ->label(__('Description'))
                                ->rows(4),
                        ]),
                    // Tab::make('Nâng cao')
                    //     ->schema([

                    //     ]),

                ]),

        ])
        ->statePath($statePath)
        ->dehydrated(false)
        ->afterStateHydrated(function (?Model $record, Set $set) use ($fields): void {
            if ($record) {
                foreach ($fields as $field) {
                    $set('metas.'.$field, $record->getMeta('seo_'.$field));
                }
            }
        })
        ->saveRelationshipsUsing(function (Model $record, array $state) use ($fields): void {
            $state = collect($state)->map(fn ($value) => $value ?: null)->all();
            $setFields = [];
            $unsetFields = [];
            foreach ($fields as $field) {
                $value = Arr::get($state, $field);
                if (filled($value)) {
                    $setFields['seo_'.$field] = $value;
                } else {
                    $unsetFields[] = 'seo_'.$field;
                }
            }

            if (count($setFields) > 0) {
                $record->setMeta($setFields);
            }

            if (count($unsetFields) > 0) {
                $record->unsetMeta($unsetFields);
            }
        });
    }
}