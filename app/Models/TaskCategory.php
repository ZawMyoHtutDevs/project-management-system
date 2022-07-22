<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'department_id',
    ];


    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class, 'task_category_id');
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id');
    }
}
