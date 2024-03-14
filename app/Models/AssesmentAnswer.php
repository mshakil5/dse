<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssesmentAnswer extends Model
{
    use HasFactory;
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function qncategory()
    {
        return $this->belongsTo(QnCategory::class);
    }

    public function assesmentAnswerComments()
    {
        return $this->hasMany(AssesmentAnswerComment::class);
    }
}
