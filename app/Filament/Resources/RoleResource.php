<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;

use App\Models\Permission;
use App\Models\Role;
use App\Services\PermissionService;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Gpc\FilamentComponents\Forms\Components\CheckboxListGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Phân quyền';

    protected static ?string $navigationLabel = 'Nhóm thành viên';

    public static function getModelLabel(): string
    {
        return 'nhóm thành viên';
    }

    public static function getPluralLabel(): ?string
    {
        return 'nhóm thành viên';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin nhóm thành viên')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên nhóm thành viên')
                            ->required(),
                        CheckboxListGroup::make('permissions')
                            ->label('Quyền hạn')
                            ->columns(4)
                            ->gridDirection('row')
                            ->relationship('permissions')
                            ->options((new PermissionService())->getAsTreeOptions())
                            ->bulkToggleable(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
