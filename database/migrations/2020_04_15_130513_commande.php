<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Commande extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Commande', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('prix_total',8,2)->default(0);
            $table->string('num_commande');
            $table->foreignId('user_id');
            $table->foreignId('id_panier');
            $table->string('statut_prepa')->default('En cours');
            $table->string('statut_pay')->default('');//payement
            $table->timestamps();
        });

        Schema::table('Commande',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_panier')->references('id')->on('panier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commande');
    }
}
