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
        Schema::create('assesment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('line_manager_id')->unsigned()->nullable();
            $table->foreign('line_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('health_safety_id')->unsigned()->nullable();
            $table->foreign('health_safety_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('determinig_answer_id')->unsigned()->nullable();
            $table->foreign('determinig_answer_id')->references('id')->on('determinig_answers')->onDelete('cascade');
            $table->bigInteger('assesment_schedule_id')->unsigned()->nullable();
            $table->foreign('assesment_schedule_id')->references('id')->on('assesment_schedules')->onDelete('cascade');
            $table->string('program_number')->nullable();
            $table->string('assign_from')->nullable();
            $table->string('assign_to')->nullable();
            $table->longText('comment')->nullable();
            $table->string('status_title')->nullable();
            $table->boolean('user_notification')->default(0);
            $table->boolean('line_manager_notification')->default(0);
            $table->boolean('health_notification')->default(0);
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
        Schema::dropIfExists('assesment_logs');
    }
};
