<?php
declare(strict_types=1);

namespace Modules\User\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label(__('app.name'))
                ->required()
                ->maxLength(255),
            TextInput::make('phone')
                ->label(__('app.phone'))
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('email')
                ->label(__('app.email'))
                ->email()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
            Select::make('role')
                ->label(__('app.role'))
                ->required()
                ->options([
                    'admin' => __('app.admin'),
                    'teacher' => __('app.teacher'),
                    'student' => __('app.student'),
                ]),
            Select::make('status')
                ->label(__('app.status'))
                ->required()
                ->options([
                    'active' => __('app.active'),
                    'suspended' => __('app.suspended'),
                ]),
            TextInput::make('password')
                ->label(__('app.password'))
                ->password()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->hiddenOn('edit')
                ->maxLength(255),
        ]);
    }
}
