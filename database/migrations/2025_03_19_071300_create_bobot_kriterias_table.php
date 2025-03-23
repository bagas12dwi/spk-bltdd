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
        Schema::create('bobot_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria_id_1'); // First criterion
            $table->unsignedBigInteger('kriteria_id_2'); // Compared against
            $table->integer('bobot'); // Assigned weight
            $table->timestamps();

            // Foreign key constraints (assuming 'kriterias' table exists)
            $table->foreign('kriteria_id_1')->references('id')->on('kriterias')->onDelete('cascade');
            $table->foreign('kriteria_id_2')->references('id')->on('kriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_kriterias');
    }
};
