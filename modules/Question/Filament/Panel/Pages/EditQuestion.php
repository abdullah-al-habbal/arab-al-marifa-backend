<?php

declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Pages;

use Modules\Question\Filament\Panel\QuestionResource;

class EditQuestion extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionResource::class;
}
