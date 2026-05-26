<?php

declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Pages;

use Modules\Question\Filament\Panel\QuestionResource;

class CreateQuestion extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionResource::class;
}
