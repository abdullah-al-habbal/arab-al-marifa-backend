<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Admin\Pages;

use Modules\QuestionOption\Filament\Panel\Admin\QuestionOptionResource;

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
