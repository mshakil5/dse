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
        Schema::create('assesment_answers', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('assesmentid')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('assesment_id')->unsigned()->nullable();
            $table->foreign('assesment_id')->references('id')->on('assesments')->onDelete('cascade');
            $table->bigInteger('question_id')->unsigned()->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->bigInteger('qn_category_id')->unsigned()->nullable();
            $table->foreign('qn_category_id')->references('id')->on('qn_categories')->onDelete('cascade');
            $table->string('received_by')->default('manager');
            $table->boolean('solved')->default(0);
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
        Schema::dropIfExists('assesment_answers');
    }
};
