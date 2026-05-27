<?php
declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ConversationChannelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('lesson_id')
                ->label(__('app.lesson_id'))
                ->relationship('lesson', 'title')
                ->required(),
            Select::make('student_id')
                ->label(__('app.student_id'))
                ->relationship('student', 'id')
                ->required(),
            Select::make('teacher_id')
                ->label(__('app.teacher_id'))
                ->relationship('teacher', 'id')
                ->required(),
        ]);
    }
}
