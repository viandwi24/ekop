<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticCooperativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // NO	KOPERASI	DESA	KECAMATAN	AKTIF	JENIS KOPERASI	KELOMPOK KOPERASI
        Schema::create('static_cooperatives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('village');
            $table->string('districts');
            $table->string('active');
            $table->string('type');
            $table->string('group');
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
        Schema::dropIfExists('static_cooperatives');
    }
}
