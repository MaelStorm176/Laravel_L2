<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Commentaire_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commentaire')->insert([
            ['email' => 'jean@gmail.com', 'commentaire' => 'Très très bonne pizzeria !','note'=>'5', 'username'=>'jean', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'pierre@gmail.com', 'commentaire' => 'Très bonne pizzeria !','note'=>'4', 'username'=>'pierre', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'mouloud@gmail.com', 'commentaire' => 'Bonne pizzeria !','note'=>'2', 'username'=>'mouloud_du_08', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'bastos@gmail.com', 'commentaire' => "J'ai rien compris à ta pizzeria",'note'=>'1', 'username'=>'Bastos_08000', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'pierre_emmanuel@gmail.com', 'commentaire' => "Super bon restaurant, l'ambiance était conviviale. De plus la pizza aux olives était excellente",'note'=>'3', 'username'=>'pierre_emma', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'chris@gmail.com', 'commentaire' => "j'ai adoré l'ambiance et le cadre, je conseille !",'note'=>'4', 'username'=>'chris51', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'poil_aux_dents@gmail.com', 'commentaire' => 'Je ne remttrais plus jamais les pieds ici !','note'=>'1', 'username'=>'PAD51000', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'jean_jacques@gmail.com', 'commentaire' => "Une explosion de saveurs a l'interieur de ma bouche ! J'ai tout bonnement adoré, c'était une expérience merveilleuse",'note'=>'5', 'username'=>'Fratté_08', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'superman@gmail.com', 'commentaire' => 'Avant chaque mission, chaque combat, je viens dans cette pizzeria et je ne suis jamais déçu !','note'=>'4', 'username'=>'SUPERMAN', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
            ['email' => 'bravoloto@gmail.com', 'commentaire' => "J'ai pas d'avis et je sais pas pourquoi je mets un commentaire en faite.",'note'=>'3', 'username'=>'LE_DERNIER', 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')],
        ]);
    }
}
