<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use RalphJSmit\Filament\SEO\SEO;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(['md' => 4])
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
                                            TinyEditor::make('content')
                                                ->default('')
                                                ->showMenuBar()
                                                ->columnSpanFull(),
                                        ])->columns(['md' => 2]),
                                    Tab::make('SEO')
                                        ->schema([
                                            SEO::make()
                                        ])

                                ]),
                        ])->columnSpan(3),
                        Group::make([
                            Section::make('Thông tin')
                                ->schema([
                                    Forms\Components\Select::make('author_id')
                                        ->relationship("author", 'name'),
                                    Forms\Components\Placeholder::make('created_at')
                                        ->content(function (Post $record) {
                                            return __('Created at').': '.$record->created_at->format('d/m/Y');
                                        })
                                        ->hiddenLabel(),
                                    Forms\Components\DateTimePicker::make('published_at')
                                        ->format('Y/m/d H:i')
                                        ->displayFormat('d/m/Y H:i')
                                        ->seconds(false)
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-clock'),
                                ])
                        ]),
                    ]),

                // Forms\Components\Select::make('tags')
                //     ->relationship('tags', 'name')
                //     ->multiple(),

                // Forms\Components\TextInput::make('status')
                //     ->required()
                //     ->maxLength(20)
                //     ->default('publish'),
                // Forms\Components\TextInput::make('comment_status')
                //     ->required()
                //     ->maxLength(20)
                //     ->default('open'),
                // Forms\Components\TextInput::make('comment_count')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
                // Forms\Components\DateTimePicker::make('published_at')
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name'),
                Tables\Columns\TextColumn::make('tags.name')
                    ->badge()
                    ->color(Color::Indigo)
                    ->limitList(1),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
