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
        Schema::create('assesment_health_problems', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('program_number')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('assesment_schedule_id')->unsigned()->nullable();
            $table->foreign('assesment_schedule_id')->references('id')->on('assesment_schedules')->onDelete('cascade');

            $table->bigInteger('determinig_answer_id')->unsigned()->nullable();
            $table->foreign('determinig_answer_id')->references('id')->on('determinig_answers')->onDelete('cascade');

            
            $table->string('otherqn', 20)->nullable();
            $table->longText('question')->nullable();
            $table->string('lowback', 20)->nullable();
            $table->string('upperback', 20)->nullable();
            $table->string('neck', 20)->nullable();
            $table->string('shoulders', 20)->nullable();
            $table->string('arms', 20)->nullable();
            $table->string('hand_fingers', 20)->nullable();
            $table->string('exercise', 20)->nullable();
            $table->string('taught_exercise', 20)->nullable();

            $table->boolean('question_solved')->default(0);
            $table->boolean('exercise_solved')->default(0);
            $table->boolean('taught_exercise_solved')->default(0);
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
        Schema::dropIfExists('assesment_health_problems');
    }
};
