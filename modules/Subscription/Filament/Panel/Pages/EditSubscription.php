<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Pages;

use Modules\Subscription\Filament\Panel\SubscriptionResource;

class EditSubscription extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubscriptionResource::class;
}
