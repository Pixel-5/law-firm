<?php

use App\Venue;
use Illuminate\Database\Seeder;
    use Illuminate\Support\Str;

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
                'slug'     => Str::slug('High Court'),
                'location' => 'Gaborone'
            ],
            [
                'id'       => 2,
                'name'     => 'Broadhurst Magistrate',
                'slug'     => Str::slug('Broadhurst Magistrate'),
                'location' => 'Gaborone'
            ],
            [
                'id'       => 3,
                'name'     => 'Ex 10 Magistrate',
                'slug'     => Str::slug('Ex 10 Magistrate'),
                'location' => 'Gaborone'
            ],
            [
                'id'       => 4,
                'name'     => 'Molepolole Magistrate',
                'slug'     => Str::slug('Molepolole Magistrate'),
                'location' => 'Molepolole'
            ],
            [
                'id'       => 5,
                'name'     => 'Lobatse Magistrate',
                'slug'     => Str::slug('Lobatse Magistrate'),
                'location' => 'Lobatse'
            ],
        ];
        Venue::insert($venues);
    }
}
