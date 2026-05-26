<?php

declare(strict_types=1);

namespace Modules\Message\Filament\Panel\Pages;

use Modules\Message\Filament\Panel\MessageResource;

class ListMessages extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
