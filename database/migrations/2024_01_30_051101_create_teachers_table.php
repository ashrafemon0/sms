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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->string('day');
            $table->string('assembly');
            $table->string('table_work');
            $table->string('group_work');
            $table->string('adl_activity');
            $table->string('massy_play');
            $table->string('snack_time');
            $table->string('table_work_2');
            $table->string('physical_exercise');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
