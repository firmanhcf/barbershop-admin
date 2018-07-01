<?php

use Illuminate\Database\Seeder;

class OperationalItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Alat Tulis Kantor', 
            'Transpotasi', 
            'Bagi Hasil Capster', 
            'Promosi', 
            'Tisu', 
            'Bedak', 
            'Silet', 
            'Hairtonix', 
            'Stella', 
            'Pembersih Kaca', 
            'Sabun Cair Refill', 
            'Krim Pijat', 
            'Listrik', 
            'Minyak Pijat', 
            'Busa Pembersih Wajah', 
            'Minyak Mesin Cukur', 
            'Masker Wajah', 
            'Pomade/Gatsby', 
            'Sabun Cuci/Laundry', 
            'Biaya Perawatan Alat ', 
            'Air Galon', 
            'Uang sampah', 
            'Super Pel', 
            'Pam', 
            'WiFi', 
            'Uang Lingkungan', 
            'Service AC'
        ];

        $purposes = [1, 1, 2, 3, 4, 4, 4, 4, 4, 4, 4, 4, 5, 4, 4, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5];
        $units = [3, 3, 3, 3, 2, 4, 4, 1, 1, 1, 1, 1, 3, 1, 4, 1, 4, 1, 1, 3, 4, 3, 1, 3, 3, 3, 3];

        for ($i=0; $i < count($names); $i++) { 
            DB::table('operational_items')->insert([
                'name' => $names[$i],
                'purpose' => $purposes[$i],
                'unit' => $units[$i]
            ]);
        }
        

        
    }
}
