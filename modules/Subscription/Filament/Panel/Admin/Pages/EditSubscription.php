<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Admin\Pages;

use Modules\Subscription\Filament\Panel\Admin\SubscriptionResource;

class EditSubscription extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubscriptionResource::class;
}
