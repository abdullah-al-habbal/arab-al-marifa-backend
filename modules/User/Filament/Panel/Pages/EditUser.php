<?php

declare(strict_types=1);

namespace Modules\User\Filament\Panel\Pages;

use Modules\User\Filament\Panel\UserResource;

class EditUser extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = UserResource::class;
}
