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
        Schema::create('determinig_answers', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('line_manager_id')->unsigned()->nullable();
            $table->foreign('line_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('health_safety_id')->unsigned()->nullable();
            $table->foreign('health_safety_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('division_id')->unsigned()->nullable();
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->bigInteger('assesment_schedule_id')->unsigned()->nullable();
            $table->foreign('assesment_schedule_id')->references('id')->on('assesment_schedules')->onDelete('cascade');
            $table->string('program_number')->nullable();
            $table->string('work_hour')->nullable();
            $table->string('wow_system')->nullable();
            $table->string('status_title')->nullable();
            $table->string('assign_account')->nullable();
            $table->boolean('user_notification')->default(0);
            $table->boolean('line_manager_notification')->default(0);
            $table->boolean('complined')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('determinig_answers');
    }
};
