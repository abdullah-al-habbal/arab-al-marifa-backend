<?php

declare(strict_types=1);

namespace Modules\User\Filament\Panel\Pages;

use Modules\User\Filament\Panel\UserResource;

class ListUsers extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = UserResource::class;

}
