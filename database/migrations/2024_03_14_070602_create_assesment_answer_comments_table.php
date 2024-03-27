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
        Schema::create('assesment_answer_comments', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('assesment_answer_id')->unsigned()->nullable();
            $table->foreign('assesment_answer_id')->references('id')->on('assesment_answers')->onDelete('cascade');
            $table->bigInteger('line_manager_id')->unsigned()->nullable();
            $table->foreign('line_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('health_safety_id')->unsigned()->nullable();
            $table->foreign('health_safety_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('expert_id')->unsigned()->nullable();
            $table->foreign('expert_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('expert_manager_id')->unsigned()->nullable();
            $table->foreign('expert_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('comment')->nullable();
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
        Schema::dropIfExists('assesment_answer_comments');
    }
};
