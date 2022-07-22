<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
    use HasFactory;

    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class, 'category_id');
    }
}
