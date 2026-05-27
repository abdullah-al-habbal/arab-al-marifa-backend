<?php
declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\Subscription\Filament\Panel\Admin\SubscriptionResource;

class ViewSubscription extends ViewRecord
{
    protected static string $resource = SubscriptionResource::class;
}
