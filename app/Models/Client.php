<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'website',
        'phone',
        'asset',
        'address',
        'description',
    ];

    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class, 'client_id');
    }
}
