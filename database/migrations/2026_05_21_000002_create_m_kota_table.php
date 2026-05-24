<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMKotaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_kota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propinsi_id')->constrained('m_propinsi')->cascadeOnDelete();
            $table->string('kota_kode', 10);
            $table->string('kota_nama', 100);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kota');
    }
}
