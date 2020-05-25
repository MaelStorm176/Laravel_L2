<?php

use Illuminate\Database\Seeder;

class Droits_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('droits')->insert([
            [
                'user_id' => 1,
                'moderation' => 1,
                'restauration' => 1,
                'parametre' => 1,
                'upgrade' => 1,
                'newsletter' => 1
            ],

            [
                'user_id' => 4,
                'moderation' => 1,
                'restauration' => 1,
                'parametre' => 0,
                'upgrade' => 0,
                'newsletter' => 0
            ],

            [
                'user_id' => 8,
                'moderation' => 1,
                'restauration' => 0,
                'parametre' => 0,
                'upgrade' => 0,
                'newsletter' => 1
            ],

            [   
                'user_id' => 24,
                'moderation' => 1,
                'restauration' => 1,
                'parametre' => 1,
                'upgrade' => 0,
                'newsletter' => 1
            ]
        ]);
    }
}
