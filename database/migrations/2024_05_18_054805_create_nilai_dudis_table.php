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
            $table->string('prestasi_kerja');
            $table->string('kehadiran_dan_disiplin');
            $table->string('inisiatif_dan_kreatifitas');
            $table->string('kerjasama');
            $table->string('tanggung_jawab');
            $table->string('sikap');
            $table->string('kompetensi_keahlian');
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
