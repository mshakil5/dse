<?php

namespace App\Models;

use App\Models\AssesmentAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    public function qncategory()
    {
        return $this->belongsTo(QnCategory::class);
    }

    public function qncat()
    {
        return $this->belongsTo(QnCategory::class)->select(['id', 'name']);
    }

    public function subquestion()
    {
        return $this->hasMany(SubQuestion::class);
    }

    public function assesmentAnswers()
    {
        return $this->hasOne(AssesmentAnswer::class);
    }


}
