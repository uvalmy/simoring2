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
        Schema::create('nilai_dudis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_id')->constrained('pkls');
            $table->integer('prestasi_kerja');
            $table->integer('kehadiran_dan_disiplin');
            $table->integer('inisiatif_dan_kreatifitas');
            $table->integer('kerjasama');
            $table->integer('tanggung_jawab');
            $table->integer('sikap');
            $table->integer('kompetensi_keahlian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_dudis');
    }
};
