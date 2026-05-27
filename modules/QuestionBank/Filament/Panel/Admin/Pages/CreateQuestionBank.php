<?php

declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Admin\Pages;

use Modules\QuestionBank\Filament\Panel\Admin\QuestionBankResource;

class CreateQuestionBank extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionBankResource::class;
}
