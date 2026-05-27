<?php

declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Admin\Pages;

use Modules\Question\Filament\Panel\Admin\QuestionResource;

class ListQuestions extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
