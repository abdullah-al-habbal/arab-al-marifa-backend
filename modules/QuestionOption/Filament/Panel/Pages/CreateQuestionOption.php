<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Pages;

use Modules\QuestionOption\Filament\Panel\QuestionOptionResource;

class CreateQuestionOption extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionOptionResource::class;
}
