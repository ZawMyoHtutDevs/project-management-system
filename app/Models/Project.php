<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'priority',
        'client_id',
        'category_id',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'project_user');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class, 'project_id');
    }
}
