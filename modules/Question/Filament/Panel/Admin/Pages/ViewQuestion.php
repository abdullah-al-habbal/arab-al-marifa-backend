<?php
declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Question\Filament\Panel\Admin\QuestionResource;

class ViewQuestion extends ViewRecord
{
    protected static string $resource = QuestionResource::class;
}
