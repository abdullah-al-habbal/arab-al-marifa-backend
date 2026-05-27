<?php

declare(strict_types=1);

namespace Modules\User\Filament\Panel\Admin\Pages;

use Modules\User\Filament\Panel\Admin\UserResource;

class EditUser extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = UserResource::class;
}
