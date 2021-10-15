<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationConfirmAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_confirm_assistances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personal_data_id')->unsigned();
            $table->foreign('personal_data_id', 'education_pd_id')->references('id')->on('education_personal_data');
            $table->date('submission_at');
            $table->date('mentoring_at');
            $table->string('location');
            $table->integer('participant')->default(0);
            $table->enum('media', ['offline', 'zoom', 'gmeet'])->default('offline');
            $table->string('solution');
            $table->string('final_decision');
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
        Schema::dropIfExists('education_confirm_assistances');
    }
}
