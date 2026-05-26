<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Pages;

use Modules\QuestionBank\Filament\Panel\QuestionBankResource;

class ListQuestionBanks extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = QuestionBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
