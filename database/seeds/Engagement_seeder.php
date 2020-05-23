<?php

use Illuminate\Database\Seeder;

class Engagement_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=5; $i++){

            DB::table('engagement')->insert([
                'titre' => 'Titre'.$i,
                'description_courte' => '-------------------------------------------------------Engagement_description'.$i.'----------------------------------------------------------------------------',
                'photo' => 'images/img_seed/enga'.$i.'.jpg'
            ]);

        }
    }
}
