<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    public $fillable = ['title', 'description', 'notes', 'owner_id'];


    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function addTask($body)
    {
        return  $this->tasks()->create(compact('body'));
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function activity()
    {
        return $this->hasMany(Activity::class);

    }


}
