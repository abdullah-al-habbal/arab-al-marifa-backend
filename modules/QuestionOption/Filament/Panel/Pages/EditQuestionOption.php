<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Pages;

use Modules\QuestionOption\Filament\Panel\QuestionOptionResource;

class EditQuestionOption extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionOptionResource::class;
}
