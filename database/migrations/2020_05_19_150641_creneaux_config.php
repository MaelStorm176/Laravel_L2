<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreneauxConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creneaux_config', function (Blueprint $table) {
            $table->id();
            $table->string('jour')->unique();
            $table->string('deb_matin');
            $table->string('fin_matin');
            $table->string('deb_soir');
            $table->string('fin_soir');
            $table->integer('livreur_matin')->defaut('1');
            $table->integer('livreur_soir')->defaut('1');
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
