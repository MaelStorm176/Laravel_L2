<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Creneaux extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creneaux', function (Blueprint $table) {
            $table->id();
            $table->string('creneaux');
            $table->string('jour');
            $table->Integer('livreur_matin')->default(0);
            $table->Integer('livreur_soir')->default(0);
            $table->foreignId('client')->unsigned()->index()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
