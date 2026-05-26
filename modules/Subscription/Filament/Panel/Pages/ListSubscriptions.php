<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Pages;

use Modules\Subscription\Filament\Panel\SubscriptionResource;

class ListSubscriptions extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
