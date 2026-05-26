<?php

declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Pages;

use Modules\VideoFile\Filament\Panel\VideoFileResource;

class EditVideoFile extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = VideoFileResource::class;
}
