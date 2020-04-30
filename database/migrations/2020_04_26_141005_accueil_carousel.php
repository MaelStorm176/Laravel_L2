<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccueilCarousel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accueil_carousel', function (Blueprint $table) {
            $table->id();
            $table->string('image_carousel');
            $table->string('titre_carousel')->nullable();
            $table->string('titre_couleur')->nullable();
            $table->string('texte_carousel')->nullable();
            $table->string('texte_couleur')->nullable();
            $table->string('fond_couleur')->nullable();
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
