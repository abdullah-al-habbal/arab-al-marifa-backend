<?php

declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Admin\Pages;

use Modules\VideoFile\Filament\Panel\Admin\VideoFileResource;

class CreateVideoFile extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = VideoFileResource::class;
}
