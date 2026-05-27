<?php
declare(strict_types=1);

namespace Modules\Lesson\Filament\Panel\Admin\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class LessonsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('app.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subjectCategory.name')
                    ->label(__('app.subject_category_id'))
                    ->sortable(),
                TextColumn::make('teacher.user.name')
                    ->label(__('app.teacher_id'))
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label(__('app.sort_order'))
                    ->sortable(),
                ToggleColumn::make('is_published')
                    ->label(__('app.is_published')),
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
