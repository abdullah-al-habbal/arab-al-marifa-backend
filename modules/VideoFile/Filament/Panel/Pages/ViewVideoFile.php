<?php
declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\VideoFile\Filament\Panel\VideoFileResource;

class ViewVideoFile extends ViewRecord
{
    protected static string $resource = VideoFileResource::class;
}
