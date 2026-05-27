<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Admin\Pages;

use Modules\Subscription\Filament\Panel\Admin\SubscriptionResource;

class CreateSubscription extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = SubscriptionResource::class;
}
