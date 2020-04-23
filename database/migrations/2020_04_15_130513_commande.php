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
            $table->unsignedTinyInteger('prix_total');
            $table->string('num_commande');
            $table->Integer('id_panier');
            $table->string('user_email');
            $table->Integer('user_id');
            $table->string('statut_prepa')->default('En cours');
            $table->string('statut_pay')->default('');//payement
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
        Schema::dropIfExists('commande');
    }
}
