<?php
declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StaticPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('slug')
                ->label(__('app.slug'))
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
            TextInput::make('title')
                ->label(__('app.title'))
                ->required()
                ->maxLength(255),
            RichEditor::make('content')
                ->label(__('app.content')),
            Toggle::make('is_published')
                ->label(__('app.is_published'))
                ->default(false),
            TextInput::make('meta_title')
                ->label(__('app.meta_title'))
                ->maxLength(255),
            TextInput::make('meta_description')
                ->label(__('app.meta_description'))
                ->maxLength(255),
            TextInput::make('sort_order')
                ->label(__('app.sort_order'))
                ->integer()
                ->default(0),
        ]);
    }
}
