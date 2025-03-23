<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('hasil_akhir', function (Blueprint $table) {
            $table->id('id_hasil_akhir');
            $table->unsignedBigInteger('id_data_warga');
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('id_subkriteria');
            $table->decimal('nilai_akhir', 8, 2);
            $table->timestamps();

            $table->foreign('id_data_warga')->references('id')->on('data_wargas')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('id')->on('kriterias')->onDelete('cascade');
            $table->foreign('id_subkriteria')->references('id')->on('subkriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_akhir');
        Schema::dropIfExists('kriteria_warga');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('data_wargas');
        Schema::dropIfExists('subkriteria');
        Schema::dropIfExists('kriteria');
    }
};
