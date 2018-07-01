<?php

use Illuminate\Database\Seeder;

class AssetItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$names = [
            'Meja', 
            'Cermin', 
            'Banner', 
            'Billboard', 
            'Bangku Tungu', 
            'Gunting', 
            'Kursi Barber', 
            'Mesin Cukur', 
            'TV', 
            'AC', 
            'Handuk Barber', 
            'Sisir', 
            'Kerokan', 
            'Kemoceng', 
            'Sapu', 
            'Sikat', 
            'Cap', 
            'Kuas', 
            'Semprotan', 
            'Lampu', 
            'Dispenser', 
            'Lemari', 
            'Meja Kasir', 
            'Tempat Sampah', 
            'Pel', 
            'Bangku Massage', 
            'Matras', 
            'Gorden', 
            'Baskom', 
            'Termos', 
            'Kompor', 
            'Tabung Gas', 
            'Kursi Keramas', 
            'Keran Keramas', 
            'Handuk Massage', 
            'Sprei', 
            'Alat Bekam', 
            'Partisi Kaca'
        ];

        $ages = [ 5, 5, 3, 3, 5, 2, 5, 2, 5, 5, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 5, 5, 2, 1, 3, 3, 3, 1, 1, 3, 3, 5, 5, 1, 1, 3, 5 ];
        $units = [ 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4 ];

        for ($i=0; $i < count($names); $i++) { 
            DB::table('asset_items')->insert([
                'name' => $names[$i],
                'economic_age' => $ages[$i],
                'unit' => $units[$i]
            ]);
        }
    }
}
