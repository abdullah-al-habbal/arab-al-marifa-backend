<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Pages;

use Modules\QuestionBank\Filament\Panel\QuestionBankResource;

class EditQuestionBank extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionBankResource::class;
}
