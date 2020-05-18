<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Telephone_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('telephone')->insert([
            'id' => 1,
            'numero' => '01 23 45 67 89'
        ]);
    }
}
