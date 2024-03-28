<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentSchedule extends Model
{
    use HasFactory;

    public function determinigAnswer()
    {
        return $this->belongsTo(DeterminigAnswer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
