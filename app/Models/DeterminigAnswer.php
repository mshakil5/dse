<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeterminigAnswer extends Model
{
    use HasFactory;

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assesmentSchedule()
    {
        return $this->hasMany(AssesmentSchedule::class);
    }
}
