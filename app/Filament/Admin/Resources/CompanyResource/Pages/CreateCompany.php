<?php

namespace App\Filament\Admin\Resources\CompanyResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Models\Company;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\CompanyResource;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected function afterCreate(): void
    {
        $userEnteredEmail = $this->data['mainContact']['email'];
        $companyEnteredEmail = $this->data['email'];

        $userFound = User::where('email', $userEnteredEmail)->first();
        $companyFound = Company::where('email', $companyEnteredEmail)->first();

        $userFound->companies()->attach($companyFound->id, ['is_main_contact' => true]);
        $userFound->is_active = true;
        $userFound->save();
    }
}
