<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded=[];
    public $timestamps=false;
    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
