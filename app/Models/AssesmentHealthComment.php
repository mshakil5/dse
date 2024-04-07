<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentHealthComment extends Model
{
    use HasFactory;

    public function assesmentHealthProblem()
    {
        return $this->belongsTo(AssesmentHealthProblem::class);
    }
}
