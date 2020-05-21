<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pizza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pizza', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('photo');
            $table->string('categorie')->default('pizza');
            $table->mediumText('description_courte')->nullable();
            $table->text('description_longue')->nullable();
            $table->string('statut')->default('Disponible');
            $table->foreignId('nutrition')->unsigned()->index()->default(0);
            $table->unsignedDecimal('prix',8,2)->default(0);
            $table->unsignedDecimal('promo',8,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pizza');
    }
}
