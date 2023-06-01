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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // Subject
            $table->text('subject');
            $table->string('explanation');

            // Date and time
            $table->date('date');
            $table->time('time');
            $table->string('location')->nullable()->default('online');

            // Total Price
            $table->integer('total_price')->default(0);

            // Status
            $table->enum('status', ['pending', 'accept', 'reject'])->default('pending');

            // Relation to User and Doctor
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('doctor_id')->constrained('doctors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
