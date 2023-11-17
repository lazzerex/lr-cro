<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostTagResource\Pages;
use App\Filament\Resources\PostTagResource\RelationManagers;
use App\Filament\Services\TagResourceService;
use App\Models\PostTag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostTagResource extends Resource
{
    protected static ?string $model = PostTag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('Bài viết');
    }

    public static function getNavigationLabel(): string
    {
        return __('Post tag');
    }

    public static function getModelLabel(): string
    {
        return __('post tag');
    }

    public static function getPluralModelLabel(): string
    {
        return __('post tag');
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
            'index' => Pages\ManagePostTags::route('/'),
        ];
    }
}
