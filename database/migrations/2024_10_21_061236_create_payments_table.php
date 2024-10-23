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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->decimal('amount', 10, 2);
            $table->integer('months');
            $table->decimal('late_fee', 10, 2)->default(0);
            $table->decimal('discount', 5, 2)->default(0);
            $table->date('payment_date');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
