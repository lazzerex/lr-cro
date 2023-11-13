<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioTagResource\Pages;
use App\Filament\Resources\PortfolioTagResource\RelationManagers;
use App\Filament\Services\TagResourceService;
use App\Models\PortfolioTag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortfolioTagResource extends Resource
{
    protected static ?string $model = PortfolioTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getNavigationGroup(): ?string
    {
        return __('Portfolio');
    }

    public static function getNavigationLabel(): string
    {
        return __('Portfolio tag');
    }

    public static function getModelLabel(): string
    {
        return __('portfolio tag');
    }

    public static function getPluralModelLabel(): string
    {
        return __('portfolio tag');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(TagResourceService::formSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(TagResourceService::tableSchema())
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePortfolioTags::route('/'),
        ];
    }
}
