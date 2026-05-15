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
        Schema::create('supir', function (Blueprint $table) {
            $table->id('supir_id')->unsigned();
            // foreign key ke tabel jenis_sim
            $table->foreignId('jns_sim_id')
                  ->references('jns_sim_id')
                  ->on('jenis_sim')
                  ->nullable();
            // foreign key ke tabel transporter
            $table->foreignId('transporter_id')
                  ->references('transporter_id')
                  ->on('transporter')
                  ->nullable();
            $table->string('driver_nama',100);
            $table->string('driver_ktp',20);
            $table->string('driver_hp',20);
            $table->string('driver_no_sim',20);
            $table->string('driver_no_bpjs',20);
            $table->date('tgl_exipred_sim');
            $table->string('flag_blokir',2);
            $table->string('driver_status',2);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->string('flag_deleted',2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supir');
    }
};
