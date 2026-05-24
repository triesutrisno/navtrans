<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMLokasiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_lokasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('m_kecamatan')->cascadeOnDelete();
            $table->string('lokasi_nama', 100);
            $table->text('lokasi_alamat');
            $table->string('lokasi_tipe', 50);
            $table->string('lokasi_kontak', 50);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_lokasi');
    }
}
