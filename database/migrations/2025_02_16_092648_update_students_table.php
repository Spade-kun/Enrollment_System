<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('first_sem')->default('not enrolled');
            $table->string('second_sem')->default('not enrolled');
            $table->dropColumn('status'); // Remove old status column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['first_sem', 'second_sem']);
            $table->string('status')->default('not enrolled'); // Rollback
        });
    }
};
