<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
