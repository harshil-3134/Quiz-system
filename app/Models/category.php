<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    function quizzes(){
        return $this->hasMany(Quiz::class);
    }
}
