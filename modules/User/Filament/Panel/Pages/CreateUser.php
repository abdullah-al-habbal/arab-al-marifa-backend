<?php

declare(strict_types=1);

namespace Modules\User\Filament\Panel\Pages;

use Modules\User\Filament\Panel\UserResource;

class CreateUser extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = UserResource::class;
}
