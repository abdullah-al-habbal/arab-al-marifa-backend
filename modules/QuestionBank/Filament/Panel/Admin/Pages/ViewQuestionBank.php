<?php
declare(strict_types=1);

namespace Modules\QuestionBank\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\QuestionBank\Filament\Panel\Admin\QuestionBankResource;

class ViewQuestionBank extends ViewRecord
{
    protected static string $resource = QuestionBankResource::class;
}
