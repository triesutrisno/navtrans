<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menurole', function (Blueprint $table) {
            $table->bigIncrements('menurole_id')->unsigned();
            $table->smallInteger('menu_id');
            $table->string('role_nama',50);
            $table->string('menurole_status',2)->nullable();
            $table->string('mrc',2)->nullable();
            $table->string('mrr',1)->nullable();
            $table->string('mru',1)->nullable();
            $table->string('mrd',1)->nullable();
            $table->string('mr01',1)->nullable();
            $table->string('mr02',1)->nullable();
            $table->string('mr03',1)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menurole');
    }
}
