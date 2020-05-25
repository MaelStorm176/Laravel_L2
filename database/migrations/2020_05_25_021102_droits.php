<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Droits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('droits', function (Blueprint $table){
            $table->id();
            $table->boolean('moderation')->default(FALSE);
            $table->boolean('restauration')->default(FALSE);
            $table->boolean('parametre')->default(FALSE);
            $table->boolean('upgrade')->default(FALSE);
            $table->boolean('newsletter')->default(FALSE);
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('droits');
    }
}
