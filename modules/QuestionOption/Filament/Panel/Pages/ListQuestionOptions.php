<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Pages;

use Modules\QuestionOption\Filament\Panel\QuestionOptionResource;

class ListQuestionOptions extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = QuestionOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
