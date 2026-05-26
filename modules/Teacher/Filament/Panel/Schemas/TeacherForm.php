<?php
declare(strict_types=1);

namespace Modules\Teacher\Filament\Panel\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('user_id')
                ->label(__('app.user_id'))
                ->relationship('user', 'name')
                ->required(),
            RichEditor::make('bio')
                ->label(__('app.bio')),
            TextInput::make('profile_photo_path')
                ->label(__('app.profile_photo_path'))
                ->maxLength(255),
            TextInput::make('specialization')
                ->label(__('app.specialization'))
                ->maxLength(255),
        ]);
    }
}
