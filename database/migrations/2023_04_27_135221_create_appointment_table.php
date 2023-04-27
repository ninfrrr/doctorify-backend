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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();

            // Subject
            $table->text('subject');
            $table->string('explanation');

            // Start and end date
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location')->nullable()->default('online');

            // Total Price
            $table->integer('total_price')->default(0);

            // Relation to User and Doctor
            $table->foreignId('user_id')->constrained();
            $table->foreignId('doctor_id')->constrained();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
