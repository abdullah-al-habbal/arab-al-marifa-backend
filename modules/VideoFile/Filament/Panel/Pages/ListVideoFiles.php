<?php

declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Pages;

use Modules\VideoFile\Filament\Panel\VideoFileResource;

class ListVideoFiles extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = VideoFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
