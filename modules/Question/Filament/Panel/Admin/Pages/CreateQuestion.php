<?php

declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Admin\Pages;

use Modules\Question\Filament\Panel\Admin\QuestionResource;

class CreateQuestion extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = QuestionResource::class;
}
