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
        Schema::create('fleet', function (Blueprint $table) {
            $table->id('fleet_id')->unsigned();
            // foreign key ke tabel jenis_fleet
            $table->foreignId('jns_fleet_id')
                  ->references('jns_fleet_id')
                  ->on('jenis_fleet')
                  ->nullable();            
            // foreign key ke tabel transporter
            $table->foreignId('transporter_id')
                  ->references('transporter_id')
                  ->on('transporter')
                  ->nullable();
            // foreign key ke tabel supir
            $table->foreignId('supir_id')
                  ->references('supir_id')
                  ->on('supir')
                  ->nullable();
            $table->string('fleet_nopol',10);
            $table->string('fleet_nopin',10);
            $table->string('thn_pembuatan',4);
            $table->string('no_stnk',20);
            $table->date('tgl_expired_kir');
            $table->date('tgl_expired_stnk');
            $table->date('tgl_expired_pajak');
            $table->string('flag_blokir',2);
            $table->string('alasan_blokir',100);
            $table->string('fleet_status',4);
            $table->string('vendor_gps',100);
            $table->string('emai',100);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->string('flag_deleted',2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet');
    }
};
