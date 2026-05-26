<?php
declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Question\Filament\Panel\QuestionResource;

class ViewQuestion extends ViewRecord
{
    protected static string $resource = QuestionResource::class;
}
