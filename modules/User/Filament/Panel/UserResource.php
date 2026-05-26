<?php
declare(strict_types=1);

namespace Modules\User\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\User\Models\User;
use Modules\User\Filament\Panel\Pages\ListUsers;
use Modules\User\Filament\Panel\Pages\CreateUser;
use Modules\User\Filament\Panel\Pages\ViewUser;
use Modules\User\Filament\Panel\Pages\EditUser;
use Modules\User\Filament\Panel\Schemas\UserForm;
use Modules\User\Filament\Panel\Schemas\UserInfolist;
use Modules\User\Filament\Panel\Tables\UsersTable;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-users';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.people');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function getNavigationLabel(): string
    {
        return __('app.users');
    }

    public static function getModelLabel(): string
    {
        return __('app.user');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.users');
    }

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
