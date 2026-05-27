<?php
declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\QuestionOption\Filament\Panel\Admin\QuestionOptionResource;

class ViewQuestionOption extends ViewRecord
{
    protected static string $resource = QuestionOptionResource::class;
}
