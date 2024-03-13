<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QnCategory extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function assesmentAnswers()
    {
        return $this->hasMany(AssesmentAnswer::class);
    }
}
