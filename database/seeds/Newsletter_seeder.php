<?php

use Illuminate\Database\Seeder;

class Newsletter_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=20; $i++){
            DB::table('newsletter')->insert([
                'email' => 'email'.$i.'@test.fr',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
