<?php
namespace App\Filament\Services;

use App\Models\Enums\TagTypes;
use Filament\Forms;
use Filament\Tables;

class TagResourceService
{
    public static function formSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->translateLabel()
                ->required(),
            Forms\Components\TextInput::make('slug')
                ->translateLabel(),
            Forms\Components\TextInput::make('display_order')
                ->translateLabel()
                ->numeric()
                ->default(0),
        ];
    }

    public static function tableSchema(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->translateLabel()
                ->sortable(),
            Tables\Columns\TextColumn::make('slug')
                ->translateLabel()
                ->searchable(),
            Tables\Columns\TextColumn::make('display_order')
                ->translateLabel()
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->translateLabel()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->translateLabel()
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
