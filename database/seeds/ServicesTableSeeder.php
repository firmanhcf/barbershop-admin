<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'Hair Cut',
            'description' => 'Hair Cut'
        ]);

        DB::table('services')->insert([
            'name' => 'Beard Shave',
            'description' => 'Beard Shave'
        ]);

        DB::table('services')->insert([
            'name' => 'Massage',
            'description' => 'Massage'
        ]);

    }
}
