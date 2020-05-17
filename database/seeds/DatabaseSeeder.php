<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(Categorie_seeder::class);
        $this->call(Nutrition_seeder::class);
        $this->call(Pizza_seeder::class);
        $this->call(Coupon_Seeder::class);
        $this->call(Carousel_seeder::class);
        $this->call(Horaires_seeder::class);
        $this->call(Partenaires_seeder::class);
        $this->call(Commentaire_seeder::class);
        $this->call(Panier_seeder::class);
        $this->call(Commande_seeder::class);
        $this->call(Feriee_seeder::class);
        $this->call(Fermeture_seeder::class);
        $this->call(Parametres_seeder::class);

    }
}
