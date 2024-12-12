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
        Schema::create('classes', function (Blueprint $table) {
            $table->id('id');
            $table->enum('greade_level', ['Pre-K','Kindergarten']);
            $table->string('room_number',10);
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id('id');
            $table->string('frist_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth');
            $table->string('parent_phone', 20);
            $table->foreign('id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
        Schema::dropIfExists('students');
    }
};
