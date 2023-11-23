<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Category;
use App\Models\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostMeta;
use App\Models\ValueObjects\PostOptions;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Gpc\FilamentComponents\Forms\Components\GalleryRepeater;
use Gpc\FilamentComponents\Forms\Components\ImagePicker;
use Gpc\FilamentComponents\Forms\Components\SelectCategories;
use Gpc\FilamentComponents\Forms\Components\SEOInputs;
use Gpc\FilamentComponents\Forms\Components\TinyMceEditor;
use Gpc\FilamentComponents\Tables\Columns\StackableColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\HtmlString;
use RalphJSmit\Filament\SEO\SEO;

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
                                                ->rows(3)
                                                ->columnSpanFull(),
                                            TinyMceEditor::make('content')
                                                ->default('')
                                                ->showMenuBar()
                                                ->columnSpanFull(),
                                        ])->columns(['md' => 2]),
                                    Tab::make('Phân loại')
                                        ->schema([
                                            SelectCategories::make()
                                                ->label(__('Chuyên mục'))
                                                ->primaryIdLabel(__('Chuyên mục chính'))
                                                ->primaryIdAttribute('category_id')
                                                ->primaryIdOptions(fn($record) => $record?->categories->pluck('name', 'id'))
                                                ->relationship('categories', 'name', 'parent_id')
                                                ->build(),

                                            Forms\Components\Select::make('tags')
                                                ->relationship('tags', 'name')
                                                ->multiple()
                                                ->createOptionForm([
                                                    Forms\Components\TextInput::make('name')
                                                        ->required(),
                                                ]),
                                        ]),
                                    Tab::make('SEO')
                                        ->schema([
                                            SEOInputs::make(),
                                        ]),
                                    // Tab::make('Gallery')
                                    //     ->schema([
                                    //         GalleryRepeater::make('gallery_data', 'Hình ảnh'),
                                    //     ]),
                                ]),
                        ])->columnSpan(4),
                        Group::make([
                            Section::make('Thông tin')
                                ->schema([
                                    Forms\Components\Placeholder::make('created_by')
                                        ->content(function (Post $record) {
                                            return $record->creator->name;
                                        })
                                        ->visibleOn('edit'),
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
                                        ->seconds(false)
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-clock')
                                        ->columnSpanFull(),

                                    Forms\Components\Select::make('status')
                                        ->options(PostStatus::class)
                                        ->columnSpanFull(),

                                    Forms\Components\Textarea::make('note')
                                        ->rows(4)
                                        ->columnSpanFull(),

                                ])->columns(['lg' => 2]),
                            Section::make(__('Hình đại diện'))
                                ->schema([
                                    ImagePicker::make('image')
                                        ->hiddenLabel(),
                                ]),

                        ])->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Tables\Columns\TextColumn::make('id')
                        ->sortable()
                        ->tooltip(fn (Post $record): string => $record->note ?? '')
                        ->icon(fn (Post $record): string => $record->note ? 'heroicon-o-chat-bubble-left-ellipsis' : '')
                        ->iconPosition(IconPosition::Before)
                        ->extraAttributes(['class' => 'split-column__flex-col'], true)
                        ->grow(false),

                    Stack::make([
                        Tables\Columns\TextColumn::make('title')
                            ->searchable()
                            ->sortable(),
                        Tables\Columns\TextColumn::make('categories.name')
                            ->badge()
                            ->color(function ($state, Model $record) {
                                $primaryCat = $record->categories?->first(function ($item) use ($record) {
                                    return $item->id == $record->category_id;
                                });

                                $isPrimary = $record->categories->count() == 1 || $state === $primaryCat?->name;
                                return $isPrimary ? 'primary' : 'gray';
                            }),
                    ])->space(1)->grow(true),

                    Stack::make([
                        Tables\Columns\TextColumn::make('status')
                            ->badge()
                            ->grow(false),
                        Tables\Columns\TextColumn::make('published_at')
                            ->dateTime()
                            ->icon('heroicon-o-calendar-days')
                            ->size('xs')
                    ])->space(1),

                    Stack::make([
                        Tables\Columns\TextColumn::make('creator.name')
                            ->tooltip('Tác giả')
                            ->icon('heroicon-o-user-circle'),
                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime()
                            ->icon('heroicon-o-calendar-days')
                            ->size('xs')
                    ])->space(1),
                ])
                ->extraAttributes(['class' => 'gap-4 column-description-small'])
                ->from('md')
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->tableList())
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('categories')
                    ->relationship('categories', 'name'),
                Tables\Filters\SelectFilter::make('status')
                    ->options(PostStatus::class),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Ngày tạo từ')
                            ->native(false),
                        Forms\Components\DatePicker::make('until')
                            ->label('Ngày tạo đến')
                            ->native(false),
                    ])
                    ->columns(['md' => 2])
                    ->columnSpan(2)
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['from'] ?? null) {
                            $indicators[] = Indicator::make('Ngày tạo từ: ' . Carbon::parse($data['from'])->formatDateDMY())
                                ->removeField('from');
                        }

                        if ($data['until'] ?? null) {
                            $indicators[] = Indicator::make('Ngày tạo đến: ' . Carbon::parse($data['until'])->formatDateDMY())
                                ->removeField('until');
                        }

                        return $indicators;
                    })
            ], layout: FiltersLayout::AboveContentCollapsible)
            // ->filtersFormColumns(2)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ])
                ->button()
                ->color('gray')
                ->size(ActionSize::ExtraSmall)
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    private static function getTableSchema()
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->tooltip(fn (Post $record): string => $record->note ?? '')
                ->icon(fn (Post $record): string => $record->note ? 'heroicon-o-chat-bubble-left-ellipsis' : '')
                ->iconPosition(IconPosition::After),
            Tables\Columns\TextColumn::make('categories.name')
                ->badge()
                ->color(function ($state, Model $record) {
                    $primaryCat = $record->categories?->first(function ($item) use ($record) {
                        return $item->id == $record->category_id;
                    });

                    $isPrimary = $record->categories->count() == 1 || $state === $primaryCat?->name;
                    return $isPrimary ? 'primary' : 'gray';
                }),
            Tables\Columns\TextColumn::make('status')
                ->badge(),
            StackableColumn::make('creator')
                ->label(__('Tác giả'))
                ->components([
                    Tables\Columns\TextColumn::make('creator.name')
                        ->label(__('Tác giả')),
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(),
                ]),

            Tables\Columns\TextColumn::make('published_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
