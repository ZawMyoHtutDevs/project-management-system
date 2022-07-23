<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'project_id',
        'task_category_id',
        'status',
        'priority',
    ];

    public function taskCategory()
    {
        return $this->belongsTo(\App\Models\TaskCategory::class, 'task_category_id');
    }

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'task_user');
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachmentable');
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

}
