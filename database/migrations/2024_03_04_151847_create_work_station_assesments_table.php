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
        Schema::create('work_station_assesments', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('determinig_answer_id')->unsigned()->nullable();
            $table->foreign('determinig_answer_id')->references('id')->on('determinig_answers')->onDelete('cascade');
            $table->string('work_station_number')->nullable();
            $table->string('part_time_work_hour')->nullable();
            $table->string('job_type')->nullable();
            $table->string('continuous_spell')->nullable();
            $table->string('continuous_spell_time')->nullable();
            $table->string('average_using_dse')->nullable();
            $table->string('software')->nullable();
            $table->string('others_software')->nullable();
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
        Schema::dropIfExists('work_station_assesments');
    }
};
