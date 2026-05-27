<?php
declare(strict_types=1);

namespace Modules\User\Filament\Panel\Admin\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Panel\Admin\UserResource;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;
}
