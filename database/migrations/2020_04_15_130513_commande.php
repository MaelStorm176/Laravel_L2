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
            $table->unsignedTinyInteger('prix_p');
            $table->string('nom_p');
            $table->Integer('id_pizza');
            $table->string('user_name');
            $table->Integer('user_id');
            $table->string('statut_prepa')->default('En cours');
            $table->string('statut_p')->default('');//payement
            $table->Integer('user_prepa')->default('');
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
        //
    }
}
