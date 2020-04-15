<?php

use App\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $venues = [
            [
                'id'       => 1,
                'name'     => 'High Court',
                'location' => 'Gaborone'
            ],
            [
                'id'       => 2,
                'name'     => 'Broadhurst Magistrate',
                'location' => 'Gaborone'
            ],
            [
                'id'       => 3,
                'name'     => 'Ex 10 Magistrate',
                'location' => 'Gaborone'
            ],
            [
                'id'       => 4,
                'name'     => 'Molepolole Magistrate',
                'location' => 'Molepolole'
            ],
            [
                'id'       => 5,
                'name'     => 'Lobatse Magistrate',
                'location' => 'Lobatse'
            ],
        ];
        Venue::insert($venues);
    }
}
