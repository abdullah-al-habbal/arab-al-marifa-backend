<?php

declare(strict_types=1);

namespace Modules\StaticPage\Filament\Panel\Admin\Pages;

use Modules\StaticPage\Filament\Panel\Admin\StaticPageResource;

class ListStaticPages extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = StaticPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
