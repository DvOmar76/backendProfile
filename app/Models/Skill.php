<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded=[];
    public $timestamps=false;
    public function course()
    {
        return $this->belongsToMany(Course::class);

    }
    public function experience()
    {
        return $this->belongsToMany(Experience::class);

    }

}
