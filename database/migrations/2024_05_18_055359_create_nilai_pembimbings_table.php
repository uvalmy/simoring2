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
        Schema::create('nilai_pembimbings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pkl_id')->constrained('pkls');
            $table->string('nilai_pelaksanaan');
            $table->string('nilai_laporan');
            $table->string('nilai_sertifikat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_pembimbings');
    }
};
