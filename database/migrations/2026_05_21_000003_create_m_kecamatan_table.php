<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kota_id')->constrained('m_kota')->cascadeOnDelete();
            $table->string('kecamatan_kode', 10);
            $table->string('kecamatan_nama', 100);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kecamatan');
    }
}
