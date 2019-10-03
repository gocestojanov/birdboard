<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $fillable = ['title', 'description'];


    public function path()
    {
        return "/projects/{$this->id}";
    }

}
