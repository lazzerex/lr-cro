<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\PostMeta;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Gpc\FilamentComponents\Forms\Components\ImagePicker;
use Gpc\FilamentComponents\Forms\Components\SEOInputs;
use Gpc\FilamentComponents\Forms\Components\TinyMceEditor;
use Gpc\FilamentComponents\Tables\Columns\StackableColumn;
use Illuminate\Database\Eloquent\Builder;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getNavigationGroup(): ?string
    {
        return __('Bài viết');
    }

    public static function getNavigationLabel(): string
    {
        return __('Bài viết');
    }

    public static function getModelLabel(): string
    {
        return __('bài viết');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['md' => 6])
                    ->schema([
                        Group::make([
                            Tabs::make()
                                ->tabs([
                                    Tab::make('Nội dung')
                                        ->schema([
                                            Forms\Components\TextInput::make('title')
                                                ->required(),
                                            Forms\Components\TextInput::make('slug'),
                                            Forms\Components\Textarea::make('excerpt')
                                                ->default('')
                                                ->columnSpanFull(),
                                            TinyMceEditor::make('content')
                                                ->default('')
                                                ->showMenuBar()
                                                ->columnSpanFull(),
                                        ])->columns(['md' => 2]),
                                    Tab::make('SEO')
                                        ->schema([
                                            SEOInputs::make()
                                        ]),
                                ]),
                        ])->columnSpan(4),
                        Group::make([
                            Section::make('Thông tin')
                                ->schema([
                                    Forms\Components\Select::make('created_by')
                                        ->relationship("creator", 'name')
                                        ->default(auth()->user()->id),
                                    Forms\Components\Placeholder::make('created_at')
                                        ->content(function (Post $record) {
                                            return $record->created_at->formatDateTimeDMY();
                                        })
                                        ->visibleOn('edit'),

                                    Forms\Components\Placeholder::make('updated_by')
                                        ->content(function (Post $record) {
                                            return $record->editor->name;
                                        })
                                        ->visibleOn('edit'),
                                    Forms\Components\Placeholder::make('updated_at')
                                        ->content(function (Post $record) {
                                            return $record->updated_at->formatDateTimeDMY();
                                        })
                                        ->visibleOn('edit'),

                                    Forms\Components\DateTimePicker::make('published_at')
                                        ->format('Y/m/d H:i')
                                        ->displayFormat('d/m/Y H:i')
                                        ->seconds(false)
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-clock')
                                        ->columnSpanFull(),
                                ])->columns(['lg' => 2]),
                            Section::make(__('Hình đại diện'))
                                ->schema([
                                    ImagePicker::make('image')
                                        ->hiddenLabel(),
                                ])
                        ])->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('creator.name')
                    ->label(__('Tác giả')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->tableList())
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
