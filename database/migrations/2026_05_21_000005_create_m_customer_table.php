<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCustomerTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_customer', function (Blueprint $table) {
            $table->id();
            $table->string('customer_nama', 100);
            $table->string('customer_npwp', 25)->nullable();
            $table->text('customer_alamat');
            $table->string('customer_kontak', 50);
            $table->string('customer_email', 100);
            $table->string('customer_status', 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_customer');
    }
}
