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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_id')->index();
            $table->string('class_id');
            $table->string('lesson_id');
            $table->string('user_id');
            $table->string('title');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->foreign('lesson_id')->references('lesson_id')->on('class_lessons');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
