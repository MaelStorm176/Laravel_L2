<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Coupon_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        for ($i=1; $i<=10; $i++) {

            $rand = (Str::random(4));
            for($j=0; $j<3; $j++) {
                $rand = $rand."-";
                $rand = $rand.(Str::random(4));
            }

            $remise = random_int(1,50);
            $timestamps = mktime(0,0,0, date("m"), date("d")+random_int(1,30), date("Y"));
            $date = date("Y-m-d", $timestamps);

            DB::table('coupon')->insert([
                'code' => $rand,
                'remise' => $remise,
                'date_limite' => $date,
                'valide' => 1
            ]);
        }
    }
}
