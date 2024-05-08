<?php

namespace App\Models;

use App\Models\CompanyStaff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'legal_status', 'phone_number', 'email', 'main_contact_id'];

    public function mainContact()
    {
        return $this->belongsTo(User::class, 'main_contact_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_main_contact');
    }

}
