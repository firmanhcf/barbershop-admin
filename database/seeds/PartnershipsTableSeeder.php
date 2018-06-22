<?php

use Illuminate\Database\Seeder;

class PartnershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partnerships')->insert([
            'title' => 'Standart',
            'alias' => 'standart',
            'description' => 'standart',
            'price' => 40000000
        ]);

        DB::table('partnerships')->insert([
            'title' => 'Gold',
            'alias' => 'gold',
            'description' => 'gold',
            'price' => 60000000
        ]);

        DB::table('partnerships')->insert([
            'title' => 'Platinum',
            'alias' => 'platinum',
            'description' => 'platinum',
            'price' => 80000000
        ]);
    }
}
