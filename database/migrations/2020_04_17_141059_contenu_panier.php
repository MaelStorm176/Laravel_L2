<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContenuPanier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenu_panier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_panier')->unsigned()->index();
            $table->foreignId('id_pizza')->unsigned()->index();
            $table->unsignedSmallInteger('quantite');
        });

        Schema::table('contenu_panier',function (Blueprint $table){
            $table->foreign('id_panier')->references('id')->on('panier');
            $table->foreign('id_pizza')->references('id')->on('pizza');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenu_panier');
    }
}
