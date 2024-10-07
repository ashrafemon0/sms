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
        Schema::create('subject_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('class_id');
            $table->string('subject_id');
            $table->string('full_mark');
            $table->string('pass_mark');
            $table->string('subjective_mark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_assigns');
    }
};
