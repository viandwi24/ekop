<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCooperativeEstablishmentConfirmAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooperative_establishment_confirm_assistances', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('personal_data_id')->constrained('cooperative_establishment_personal_data');
            $table->bigInteger('personal_data_id')->unsigned();
            $table->foreign('personal_data_id', 'pd_id')->references('id')->on('cooperative_establishment_personal_data');
            $table->date('submission_at');
            $table->date('mentoring_at');
            $table->string('location');
            $table->string('client_name');
            $table->integer('participant')->default(0);
            $table->enum('media', ['offline', 'zoom', 'gmeet'])->default('offline');
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
        Schema::dropIfExists('cooperative_establishment_confirm_assistances');
    }
}
