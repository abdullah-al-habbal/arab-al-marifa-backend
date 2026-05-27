<?php

declare(strict_types=1);

namespace Modules\User\Filament\Panel\Admin\Pages;

use Modules\User\Filament\Panel\Admin\UserResource;

class CreateUser extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = UserResource::class;
}
