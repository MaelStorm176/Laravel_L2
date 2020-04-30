<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nutrition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('Sodium',6,1)->comment('mg');
            $table->unsignedDecimal('Fibres',6,1)->comment('g');
            $table->unsignedDecimal('Dont_satures',6,1)->comment('g');
            $table->unsignedDecimal('Lipides',6,1)->comment('g');
            $table->unsignedDecimal('Dont_sucres',6,1)->comment('g');
            $table->unsignedDecimal('Glucides',6,1)->comment('g');
            $table->unsignedDecimal('Proteines',6,1)->comment('g');
            $table->unsignedDecimal('Energies',6,1)->comment('kcal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutrition');
    }
}
