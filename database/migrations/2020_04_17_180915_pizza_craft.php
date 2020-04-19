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
            $table->Integer('user_id');
            foreach ($var as $item) {
                $table->string($item->nom_i)->default('');
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
        $this->up();
    }
}
