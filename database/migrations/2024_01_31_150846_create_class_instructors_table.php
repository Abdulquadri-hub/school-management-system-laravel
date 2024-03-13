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
        Schema::create('class_instructors', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('class_id');
            $table->string('disabled')->default(0);
            $table->foreign('class_id')->references('class_id')->on('classes');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_instructors');
    }
};
