<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablePenkesPersonalDataChangeHealthScoreToDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penkes_personal_data', function (Blueprint $table) {
            $table->decimal('health_score')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penkes_personal_data', function (Blueprint $table) {
            // rollback healt_score to integer
            $table->integer('health_score')->default(0)->change();
        });
    }
}
