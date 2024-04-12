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
        Schema::create('class_lesson_assignments_submission_grades', function (Blueprint $table) {
            $table->id();
            $table->string("assignment_sub_grade_id")->index();
            $table->string("assignment_sub_id");
            $table->string('assignment_id');
            $table->string('class_id');
            $table->string('lesson_id');
            $table->string('user_id');
            $table->string("grade");
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->foreign('lesson_id')->references('lesson_id')->on('class_lessons');
            $table->foreign('assignment_id')->references('assignment_id')->on('assignments');
            $table->foreign('assignment_sub_id')->references('assignment_sub_id')->on('class_lesson_assignments_submisions');
            $table->foreign('user_id')->references('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_lesson_assignments_submission_grades');
    }
};
