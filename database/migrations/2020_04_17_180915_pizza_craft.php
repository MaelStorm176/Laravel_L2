<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PizzaCraft extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('craft_pizza', function (Blueprint $table) {
            $var=DB::table('ingredient')->select('*')->get();
            $table->id();
            $table->unsignedDecimal('prix_total_i',8,2);
            foreach ($var as $item) {
                $table->boolean($item->nom_i)->default(false);
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('craft_pizza');
    }
}
