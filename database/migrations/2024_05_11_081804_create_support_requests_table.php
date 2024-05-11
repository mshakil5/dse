<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('address_first_line')->nullable();
            $table->string('address_second_line')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('postcode')->nullable();
            $table->string('home_contact_number')->nullable();
            $table->string('work_contact_number')->nullable();
            $table->string('employee_email')->nullable();
            $table->string('division')->nullable();
            $table->string('department')->nullable();
            $table->string('job_title')->nullable();
            $table->string('length_post_time')->nullable();
            $table->string('referral_reason')->nullable();
            $table->string('signature')->nullable();
            $table->string('assign')->nullable();
            $table->boolean('status')->default(0);
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_requests');
    }
};
