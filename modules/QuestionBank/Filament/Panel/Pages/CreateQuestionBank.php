<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Pages;

use Modules\QuestionBank\Filament\Panel\QuestionBankResource;

class CreateQuestionBank extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionBankResource::class;
}
