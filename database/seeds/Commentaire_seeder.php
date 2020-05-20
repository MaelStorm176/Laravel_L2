<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Commentaire_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');
        DB::table('commentaire')->insert([
            ['email' => 'jean@gmail.com', 'commentaire' => 'Très très bonne pizzeria !','note'=>'5', 'username'=>'jean', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'pierre@gmail.com', 'commentaire' => 'Très bonne pizzeria !','note'=>'4', 'username'=>'pierre', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'eva_mendez@gmail.com', 'commentaire' => 'Bonne pizzeria !','note'=>'2', 'username'=>'Eva Mendez', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'bastos@gmail.com', 'commentaire' => "J'ai rien compris à ta pizzeria",'note'=>'1', 'username'=>'Bastos_08000', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'pierre_emmanuel@gmail.com', 'commentaire' => "Super bon restaurant, l'ambiance était conviviale. De plus la pizza aux olives était excellente",'note'=>'3', 'username'=>'pierre_emma', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'chris@gmail.com', 'commentaire' => "j'ai adoré l'ambiance et le cadre, je conseille !",'note'=>'4', 'username'=>'chris51', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'poil_aux_dents@gmail.com', 'commentaire' => 'Je ne remettrais plus jamais les pieds ici !','note'=>'1', 'username'=>'PAD51000', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'jean_jacques@gmail.com', 'commentaire' => "Une explosion de saveurs a l'interieur de ma bouche ! J'ai tout bonnement adoré, c'était une expérience merveilleuse",'note'=>'5', 'username'=>'Fratté_08', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => $faker->unique()->email, 'commentaire' => $faker->sentence,'note'=>random_int(1,5), 'username'=>$faker->userName, 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
        ]);
    }
}
