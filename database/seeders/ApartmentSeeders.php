<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apartment::truncate();
        $color =
        [
            [
            'city_id' => '57826',
            'terms_id' => '1',
            'how_manu_rooms' => 'dfdfd',
            'description' => 'sfgfg',
            'proce' => '100',
            'is_free' => '1',
            'address' => 'addddddddd',
            ],
    
        ];
        foreach($color as $c){
            Apartment::create($c);
        }
        //  \App\Models\Apartment::factory(5)->create();

        //   \App\Models\Apartment::factory()->create([
        //     'city_id' => '57826',
        //     'terms_id' => '1',
        //     'how_manu_rooms' => 'dfdfd',
        //     'description' => 'sfgfg',
        //     'proce' => '100',
        //     'is_free' => '1',
        //     'address' => 'addddddddd',
        // ]);
    }
}
