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
        Schema::create('jenis_fleet', function (Blueprint $table) {
            $table->id('jns_fleet_id')->unsigned();
            $table->string('jns_fleet_kode',10);
            $table->string('jns_fleet_nama',100);
            $table->string('jns_fleet_tonase',100);
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
        Schema::dropIfExists('jenis_fleet');
    }
};
