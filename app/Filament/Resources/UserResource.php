<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Phân quyền';

    protected static ?string $navigationLabel = 'Thành viên';

    public static function getModelLabel(): string
    {
        return 'thành viên';
    }

    public static function getPluralLabel(): ?string
    {
        return 'thành viên';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Thông tin tài khoản')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->translateLabel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('username')
                            ->translateLabel()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->readOnlyOn('edit'),
                        Forms\Components\TextInput::make('email')
                            ->translateLabel()
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload(),
                        Forms\Components\TextInput::make('password')
                            ->translateLabel()
                            ->password()
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->hidden(fn (string $operation): bool => $operation === 'edit'),
                        Forms\Components\FileUpload::make('avatar_url')
                            ->label(__('Hình đại diện'))
                            ->directory('avatars')
                            ->image()
                            ->columnSpanFull(),
                    ])
                    ->columns(['md' => 2])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('')
                    ->circular(),
                BadgeableColumn::make('name')
                    ->translateLabel()
                    ->searchable()
                    ->suffixBadges([
                        Badge::make('locked')
                            ->label(__('Đã khoá'))
                            ->color('danger')
                            ->visible(fn(Model $record) => $record->is_locked),
                    ]),
                Tables\Columns\TextColumn::make('username')
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label(__('Nhóm'))
                    ->badge(),
                Tables\Columns\TextColumn::make('locked_at')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->label(__('Nhóm thành viên'))
                    ->relationship('roles', 'name')
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('change_status')
                        ->label(fn($record) => ! $record->is_locked ? 'Khoá' : 'Mở')
                        ->icon(fn($record) => ! $record->is_locked ? 'heroicon-o-lock-closed' : 'heroicon-o-lock-open')
                        ->color(fn($record) => ! $record->is_locked ? 'warning' : 'success')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->locked_at = $record->is_locked ? null : now();
                            $record->save();
                            Notification::make()
                                ->title('Đã lưu')
                                ->success()
                                ->send();
                        })
                        ->visible(fn (User $record): bool => auth()->user()->can('update', $record)),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
