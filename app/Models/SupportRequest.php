<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_name',
        'dob',
        'address_first_line',
        'address_second_line',
        'city',
        'country',
        'postcode',
        'home_contact_number',
        'work_contact_number',
        'employee_email',
        'division',
        'department',
        'job_title',
        'length_post_time',
        'referral_reason',
        'signature',
        'assign',
        'status',
        'updated_by',
        'created_by',
    ];
}
