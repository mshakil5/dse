<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentAnswerComment extends Model
{
    use HasFactory;


    public function assesmentAnswers()
    {
        return $this->belongsTo(AssesmentAnswer::class);
    }

}
