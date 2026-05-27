<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Admin\Pages;

use Modules\QuestionBank\Filament\Panel\Admin\QuestionBankResource;

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
