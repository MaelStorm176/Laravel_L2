<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Engagement_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('engagement')->insert([
            [
                'titre' => 'Provenance française',
                'description_courte' => 'Nous nous engageons à composer tous nos articles avec uniquement de la viande provenant de bovins Français.',
                'photo' => 'images/img_seed/enga4.jpg'
            ],
            [
                'titre' => "Respectueux de l'environnement",
                'description_courte' => "Nous nous engageons à respecter au maximum l'environnement en vous fournissant des emballages entièrement biodégradables.",
                'photo' => 'images/img_seed/enga2.jpg'
            ],
            [
                'titre' => "Service client optimal",
                'description_courte' => "Nous garantissons vous offrir un service client efficace en gardant contact avec chacun de nos clients durant chaque commande.",
                'photo' => 'images/img_seed/enga1.jpg'
            ],
            [
                'titre' => "Hygiène",
                'description_courte' => "Nous respectons scrupuleusement les normes d'hygiène misent en place par le gouvernement, plus de détails ici : https://www.service-public.fr/professionnels-entreprises/vosdroits/F32189",
                'photo' => 'images/img_seed/enga3.jpg'
            ],
            [
                'titre' => "Remboursement",
                'description_courte' => "S'il y a le moindre problème avec votre commande, son remboursement sera autorisé pendant 24h après le paiement de votre commande.",
                'photo' => 'images/img_seed/enga5.jpg'
            ]
        ]);
    }
}
