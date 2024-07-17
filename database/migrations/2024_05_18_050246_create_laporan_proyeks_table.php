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
        Schema::create('laporan_proyeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_id')->constrained('pkls');
            $table->string('judul');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->text('saran');
            $table->json('dokumentasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_proyeks');
    }
};
