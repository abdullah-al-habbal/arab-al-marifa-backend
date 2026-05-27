<?php
declare(strict_types=1);

namespace Modules\ConversationChannel\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConversationChannelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lesson.title')
                    ->label(__('app.lesson_title'))
                    ->sortable(),
                TextColumn::make('student.id')
                    ->label(__('app.student_id'))
                    ->sortable(),
                TextColumn::make('teacher.id')
                    ->label(__('app.teacher_id'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('app.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
