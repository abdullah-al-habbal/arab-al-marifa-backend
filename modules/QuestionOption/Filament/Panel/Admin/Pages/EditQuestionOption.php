<?php

declare(strict_types=1);

namespace Modules\QuestionOption\Filament\Panel\Admin\Pages;

use Modules\QuestionOption\Filament\Panel\Admin\QuestionOptionResource;

class EditQuestionOption extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionOptionResource::class;
}
