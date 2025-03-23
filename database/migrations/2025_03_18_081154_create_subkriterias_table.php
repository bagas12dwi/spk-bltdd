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
        Schema::create('subkriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kriteria'); // Sesuai dengan id_kriteria dari tabel kriteria
            $table->string('nama_subkriteria');
            $table->integer('bobot');
            $table->timestamps();
            $table->foreign('id_kriteria')->references('id')->on('kriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkriterias');
    }
};
