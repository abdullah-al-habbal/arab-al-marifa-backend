<?php
declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\QuestionBank\Filament\Panel\QuestionBankResource;

class ViewQuestionBank extends ViewRecord
{
    protected static string $resource = QuestionBankResource::class;
}
