<?php

declare(strict_types=1);

namespace Modules\Question\Filament\Panel\Admin\Pages;

use Modules\Question\Filament\Panel\Admin\QuestionResource;

class EditQuestion extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = QuestionResource::class;
}
