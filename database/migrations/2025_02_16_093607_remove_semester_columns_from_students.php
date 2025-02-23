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
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['first_sem', 'second_sem', 'first_sem_school_year', 'second_sem_school_year']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('first_sem')->default('not enrolled');
            $table->string('second_sem')->default('not enrolled');
            $table->string('first_sem_school_year')->nullable();
            $table->string('second_sem_school_year')->nullable();
        });
    }
};
