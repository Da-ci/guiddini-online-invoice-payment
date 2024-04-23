<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected static string $view = 'filament.resources.admin.pages.create-admin';
}
