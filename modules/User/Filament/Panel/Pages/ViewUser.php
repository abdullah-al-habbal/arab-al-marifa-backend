<?php
declare(strict_types=1);

namespace Modules\User\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Panel\UserResource;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;
}
