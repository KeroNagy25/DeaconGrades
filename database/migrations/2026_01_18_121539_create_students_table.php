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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('age')->nullable();
            $table->string('academic_year');
            $table->string('gender')->nullable();
            $table->string('deacon_rank')->nullable();
            $table->string('phone')->nullable();
            $table->integer('attendance_count')->default(0)->nullable();
            $table->float('attendance_grade')->default(0)->nullable();
            $table->float('hymns_grade')->default(0)->nullable();
            $table->float('coptic_grade')->default(0)->nullable();
            $table->float('theology_grade')->default(0)->nullable();
            $table->float('total')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
