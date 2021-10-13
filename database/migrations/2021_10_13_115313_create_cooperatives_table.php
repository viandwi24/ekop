<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCooperativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique()->nullable();
            $table->string('name');
            $table->string('legal_entity_number');
            $table->date('legal_entity_date');
            $table->string('legal_entity_approval');
            $table->string('cooperative_domicile');
            $table->string('notary');
            $table->string('npwp');
            $table->string('address');
            $table->string('phone_hp');
            $table->string('phone_company');
            $table->string('facsimile');
            $table->string('email');
            $table->string('website');
            $table->string('note');
            $table->boolean('status')->default(true);
            $table->boolean('isbig')->default(true);
            $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('cooperatives');
    }
}
