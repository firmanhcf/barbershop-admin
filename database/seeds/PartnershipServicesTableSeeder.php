<?php

use Illuminate\Database\Seeder;

class PartnershipServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partnership_services')->insert([
            'partnership_id' => 1,
            'service_id' => 1
        ]);

        DB::table('partnership_services')->insert([
            'partnership_id' => 1,
            'service_id' => 2
        ]);

        DB::table('partnership_services')->insert([
            'partnership_id' => 2,
            'service_id' => 1
        ]);

        DB::table('partnership_services')->insert([
            'partnership_id' => 2,
            'service_id' => 2
        ]);

        DB::table('partnership_services')->insert([
            'partnership_id' => 2,
            'service_id' => 3
        ]);

        DB::table('partnership_services')->insert([
            'partnership_id' => 3,
            'service_id' => 1
        ]);

        DB::table('partnership_services')->insert([
            'partnership_id' => 3,
            'service_id' => 2
        ]);

        DB::table('partnership_services')->insert([
            'partnership_id' => 3,
            'service_id' => 3
        ]);

    }
}
