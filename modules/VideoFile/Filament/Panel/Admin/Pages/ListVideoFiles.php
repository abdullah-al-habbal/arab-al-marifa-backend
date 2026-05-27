<?php

declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel\Admin\Pages;

use Modules\VideoFile\Filament\Panel\Admin\VideoFileResource;

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
