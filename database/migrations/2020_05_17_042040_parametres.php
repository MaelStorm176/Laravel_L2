<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parametres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametres', function (Blueprint $table){
            $table->id();
            $table->string('telephone');
            $table->string('adresse');
            $table->integer('codePostal');
            $table->string('ville');
            $table->string('iframe',500);
            $table->decimal('ptsEquivalent');
            $table->integer('ptsGain');
            $table->integer('ptsNbComm');
            $table->decimal('ptsMinTotal');
            $table->string('facebook');
            $table->string('twitter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parametres');
    }
}
