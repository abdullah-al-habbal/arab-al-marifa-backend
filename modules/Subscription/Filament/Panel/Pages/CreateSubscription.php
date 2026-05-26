<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Pages;

use Modules\Subscription\Filament\Panel\SubscriptionResource;

class CreateSubscription extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = SubscriptionResource::class;
}
