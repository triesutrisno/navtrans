<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMLokasiAddErdFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('m_lokasi', function (Blueprint $table) {
            if (! Schema::hasColumn('m_lokasi', 'lokasi_kode')) {
                $table->string('lokasi_kode', 20)->nullable()->after('kecamatan_id');
            }
            if (! Schema::hasColumn('m_lokasi', 'is_plant')) {
                $table->string('is_plant', 2)->nullable()->after('lokasi_kode');
            }
            if (! Schema::hasColumn('m_lokasi', 'is_shipto')) {
                $table->string('is_shipto', 2)->nullable()->after('is_plant');
            }
            if (! Schema::hasColumn('m_lokasi', 'latitude1')) {
                $table->string('latitude1', 50)->nullable()->after('is_shipto');
            }
            if (! Schema::hasColumn('m_lokasi', 'longitude1')) {
                $table->string('longitude1', 50)->nullable()->after('latitude1');
            }
            if (! Schema::hasColumn('m_lokasi', 'radius1')) {
                $table->string('radius1', 50)->nullable()->after('longitude1');
            }
            if (! Schema::hasColumn('m_lokasi', 'lokasi_pic')) {
                $table->string('lokasi_pic', 100)->nullable()->after('radius1');
            }
            if (! Schema::hasColumn('m_lokasi', 'lokasi_status')) {
                $table->string('lokasi_status', 2)->nullable()->after('lokasi_pic');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('m_lokasi', function (Blueprint $table) {
            if (Schema::hasColumn('m_lokasi', 'lokasi_status')) {
                $table->dropColumn('lokasi_status');
            }
            if (Schema::hasColumn('m_lokasi', 'lokasi_pic')) {
                $table->dropColumn('lokasi_pic');
            }
            if (Schema::hasColumn('m_lokasi', 'radius1')) {
                $table->dropColumn('radius1');
            }
            if (Schema::hasColumn('m_lokasi', 'longitude1')) {
                $table->dropColumn('longitude1');
            }
            if (Schema::hasColumn('m_lokasi', 'latitude1')) {
                $table->dropColumn('latitude1');
            }
            if (Schema::hasColumn('m_lokasi', 'is_shipto')) {
                $table->dropColumn('is_shipto');
            }
            if (Schema::hasColumn('m_lokasi', 'is_plant')) {
                $table->dropColumn('is_plant');
            }
            if (Schema::hasColumn('m_lokasi', 'lokasi_kode')) {
                $table->dropColumn('lokasi_kode');
            }
        });
    }
}
