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
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();

            $table->foreignId('specialist_id')->constrained('specialist');

            $table->string('name');
            $table->string('location');
            $table->text('photo')->nullable();

            $table->integer('price')->default(0);
            $table->text('review');
            $table->double('star')->default(0);
            $table->integer('total_review')->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor');
    }
};
