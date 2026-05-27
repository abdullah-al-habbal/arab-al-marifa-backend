<?php

declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Admin\Pages;

use Modules\VideoFile\Filament\Panel\Admin\VideoFileResource;

class EditVideoFile extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = VideoFileResource::class;
}
