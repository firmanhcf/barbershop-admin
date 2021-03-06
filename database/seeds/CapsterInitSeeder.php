<?php

use Illuminate\Database\Seeder;

class CapsterInitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$names = [
			'Putra',
			'Robbi',
			'Zommi',
			'Dooni',
			'Jafar',
			'Dadan',
			'Arif',
			'Alfin',
			'Memet',
			'Toyyib',
			'Sukri',
			'Alfin',
			'Errik',
			'Ebi',
			'Asep',
			'Isap',
			'Rijan',
			'Eful',
			'Wadi',
			'Madi',
			'Ibah',
			'Apep',
			'Dadan',
			'Aji',
			'Mamat',
			'Agus',
			'Rehan',
			'Nanto',
			'Nanang',
			'Angga',
			'Wandi',
			'Bagja',
			'Budi',
			'Asep',
			'Dadang',
			'Wandi',
			'Nanto',
			'Sunanto',
			'Iman',
			'Sugih',
			'Budi',
			'Riyan',
			'Dadan',
			'Anto',
			'Sukri',
			'Kholik',
			'Bandi',
			'Mulyadi',
			'komar',
			'Candra',
			'Jajang',
			'Rizqi',
			'Kamzin',
			'Johan',
			'Pardi',
			'Nanang',
			'Rohman',
			'Yuda',
			'Cecep',
			'Isep',
			'Ari',
			'Kohar',
			'Supyan',
			'Abo',
			'Yoyo',
			'Egi',
			'Andi',
			'Vian',
			'Dadang',
			'Faisal',
			'Yudi',
			'Yana',
			'Sudrajat',
			'Hendi',
			'Eful',
			'Rohmat',
			'Dian',
			'Angga',
			'Suhendar',
			'Acu',
			'Yadi',
			'Mulyana',
			'Dika',
			'Dadan',
			'Supri',
			'Ado',
			'Ujang',
			'Agung',
			'Yudi',
			'Rahmat',
			'Sandi',
			'Edward',
			'Jamal',
			'Rohmat',
			'Rapi',
			'Kohar',
			'Riyan',
			'Yoyo',
			'Nandang',
			'Irfan',
			'Bobi',
			'Gunawan',
			'Dani',
			'Rozak',
			'Adul',
			'Atep',
			'Tohir',
			'Manto'
    	];
    	$niks = [
			'EMP2018089560',
			'EMP2018089561',
			'EMP2018089562',
			'EMP2018089563',
			'EMP2018089564',
			'EMP2018089565',
			'EMP2018089566',
			'EMP2018089567',
			'EMP2018089568',
			'EMP2018089569',
			'EMP2018089570',
			'EMP2018089571',
			'EMP2018089572',
			'EMP2018089573',
			'EMP2018089574',
			'EMP2018089575',
			'EMP2018089576',
			'EMP2018089577',
			'EMP2018089578',
			'EMP2018089579',
			'EMP2018089580',
			'EMP2018089581',
			'EMP2018089582',
			'EMP2018089583',
			'EMP2018089584',
			'EMP2018089585',
			'EMP2018089586',
			'EMP2018089587',
			'EMP2018089588',
			'EMP2018089589',
			'EMP2018089590',
			'EMP2018089591',
			'EMP2018089592',
			'EMP2018089593',
			'EMP2018089594',
			'EMP2018089595',
			'EMP2018089596',
			'EMP2018089597',
			'EMP2018089598',
			'EMP2018089599',
			'EMP2018089600',
			'EMP2018089601',
			'EMP2018089602',
			'EMP2018089603',
			'EMP2018089604',
			'EMP2018089605',
			'EMP2018089606',
			'EMP2018089607',
			'EMP2018089608',
			'EMP2018089609',
			'EMP2018089610',
			'EMP2018089611',
			'EMP2018089612',
			'EMP2018089613',
			'EMP2018089614',
			'EMP2018089616',
			'EMP2018089617',
			'EMP2018089618',
			'EMP2018089619',
			'EMP2018089620',
			'EMP2018089621',
			'EMP2018089622',
			'EMP2018089623',
			'EMP2018089624',
			'EMP2018089625',
			'EMP2018089626',
			'EMP2018089627',
			'EMP2018089628',
			'EMP2018089629',
			'EMP2018089631',
			'EMP2018089632',
			'EMP2018089633',
			'EMP2018089634',
			'EMP2018089635',
			'EMP2018089636',
			'EMP2018089637',
			'EMP2018089638',
			'EMP2018089639',
			'EMP2018089640',
			'EMP2018089641',
			'EMP2018089642',
			'EMP2018089643',
			'EMP2018089644',
			'EMP2018089645',
			'EMP2018089646',
			'EMP2018089647',
			'EMP2018089648',
			'EMP2018089649',
			'EMP2018089650',
			'EMP2018089651',
			'EMP2018089652',
			'EMP2018089653',
			'EMP2018089654',
			'EMP2018089655',
			'EMP2018089656',
			'EMP2018089657',
			'EMP2018089658',
			'EMP2018089659',
			'EMP2018089660',
			'EMP2018089661',
			'EMP2018089662',
			'EMP2018089663',
			'EMP2018089664',
			'EMP2018089665',
			'EMP2018089666',
			'EMP2018089667',
			'EMP2018089668',
			'EMP2018089669'
    	];

    	$emails = [
    		'EMP2018089560@bigsmile.id',
			'EMP2018089561@bigsmile.id',
			'EMP2018089562@bigsmile.id',
			'EMP2018089563@bigsmile.id',
			'EMP2018089564@bigsmile.id',
			'EMP2018089565@bigsmile.id',
			'EMP2018089566@bigsmile.id',
			'EMP2018089567@bigsmile.id',
			'EMP2018089568@bigsmile.id',
			'EMP2018089569@bigsmile.id',
			'EMP2018089570@bigsmile.id',
			'EMP2018089571@bigsmile.id',
			'EMP2018089572@bigsmile.id',
			'EMP2018089573@bigsmile.id',
			'EMP2018089574@bigsmile.id',
			'EMP2018089575@bigsmile.id',
			'EMP2018089576@bigsmile.id',
			'EMP2018089577@bigsmile.id',
			'EMP2018089578@bigsmile.id',
			'EMP2018089579@bigsmile.id',
			'EMP2018089580@bigsmile.id',
			'EMP2018089581@bigsmile.id',
			'EMP2018089582@bigsmile.id',
			'EMP2018089583@bigsmile.id',
			'EMP2018089584@bigsmile.id',
			'EMP2018089585@bigsmile.id',
			'EMP2018089586@bigsmile.id',
			'EMP2018089587@bigsmile.id',
			'EMP2018089588@bigsmile.id',
			'EMP2018089589@bigsmile.id',
			'EMP2018089590@bigsmile.id',
			'EMP2018089591@bigsmile.id',
			'EMP2018089592@bigsmile.id',
			'EMP2018089593@bigsmile.id',
			'EMP2018089594@bigsmile.id',
			'EMP2018089595@bigsmile.id',
			'EMP2018089596@bigsmile.id',
			'EMP2018089597@bigsmile.id',
			'EMP2018089598@bigsmile.id',
			'EMP2018089599@bigsmile.id',
			'EMP2018089600@bigsmile.id',
			'EMP2018089601@bigsmile.id',
			'EMP2018089602@bigsmile.id',
			'EMP2018089603@bigsmile.id',
			'EMP2018089604@bigsmile.id',
			'EMP2018089605@bigsmile.id',
			'EMP2018089606@bigsmile.id',
			'EMP2018089607@bigsmile.id',
			'EMP2018089608@bigsmile.id',
			'EMP2018089609@bigsmile.id',
			'EMP2018089610@bigsmile.id',
			'EMP2018089611@bigsmile.id',
			'EMP2018089612@bigsmile.id',
			'EMP2018089613@bigsmile.id',
			'EMP2018089614@bigsmile.id',
			'EMP2018089616@bigsmile.id',
			'EMP2018089617@bigsmile.id',
			'EMP2018089618@bigsmile.id',
			'EMP2018089619@bigsmile.id',
			'EMP2018089620@bigsmile.id',
			'EMP2018089621@bigsmile.id',
			'EMP2018089622@bigsmile.id',
			'EMP2018089623@bigsmile.id',
			'EMP2018089624@bigsmile.id',
			'EMP2018089625@bigsmile.id',
			'EMP2018089626@bigsmile.id',
			'EMP2018089627@bigsmile.id',
			'EMP2018089628@bigsmile.id',
			'EMP2018089629@bigsmile.id',
			'EMP2018089631@bigsmile.id',
			'EMP2018089632@bigsmile.id',
			'EMP2018089633@bigsmile.id',
			'EMP2018089634@bigsmile.id',
			'EMP2018089635@bigsmile.id',
			'EMP2018089636@bigsmile.id',
			'EMP2018089637@bigsmile.id',
			'EMP2018089638@bigsmile.id',
			'EMP2018089639@bigsmile.id',
			'EMP2018089640@bigsmile.id',
			'EMP2018089641@bigsmile.id',
			'EMP2018089642@bigsmile.id',
			'EMP2018089643@bigsmile.id',
			'EMP2018089644@bigsmile.id',
			'EMP2018089645@bigsmile.id',
			'EMP2018089646@bigsmile.id',
			'EMP2018089647@bigsmile.id',
			'EMP2018089648@bigsmile.id',
			'EMP2018089649@bigsmile.id',
			'EMP2018089650@bigsmile.id',
			'EMP2018089651@bigsmile.id',
			'EMP2018089652@bigsmile.id',
			'EMP2018089653@bigsmile.id',
			'EMP2018089654@bigsmile.id',
			'EMP2018089655@bigsmile.id',
			'EMP2018089656@bigsmile.id',
			'EMP2018089657@bigsmile.id',
			'EMP2018089658@bigsmile.id',
			'EMP2018089659@bigsmile.id',
			'EMP2018089660@bigsmile.id',
			'EMP2018089661@bigsmile.id',
			'EMP2018089662@bigsmile.id',
			'EMP2018089663@bigsmile.id',
			'EMP2018089664@bigsmile.id',
			'EMP2018089665@bigsmile.id',
			'EMP2018089666@bigsmile.id',
			'EMP2018089667@bigsmile.id',
			'EMP2018089668@bigsmile.id',
			'EMP2018089669@bigsmile.id'
    	];
    	$passwords = [
    		'EMP2018089560',
			'EMP2018089561',
			'EMP2018089562',
			'EMP2018089563',
			'EMP2018089564',
			'EMP2018089565',
			'EMP2018089566',
			'EMP2018089567',
			'EMP2018089568',
			'EMP2018089569',
			'EMP2018089570',
			'EMP2018089571',
			'EMP2018089572',
			'EMP2018089573',
			'EMP2018089574',
			'EMP2018089575',
			'EMP2018089576',
			'EMP2018089577',
			'EMP2018089578',
			'EMP2018089579',
			'EMP2018089580',
			'EMP2018089581',
			'EMP2018089582',
			'EMP2018089583',
			'EMP2018089584',
			'EMP2018089585',
			'EMP2018089586',
			'EMP2018089587',
			'EMP2018089588',
			'EMP2018089589',
			'EMP2018089590',
			'EMP2018089591',
			'EMP2018089592',
			'EMP2018089593',
			'EMP2018089594',
			'EMP2018089595',
			'EMP2018089596',
			'EMP2018089597',
			'EMP2018089598',
			'EMP2018089599',
			'EMP2018089600',
			'EMP2018089601',
			'EMP2018089602',
			'EMP2018089603',
			'EMP2018089604',
			'EMP2018089605',
			'EMP2018089606',
			'EMP2018089607',
			'EMP2018089608',
			'EMP2018089609',
			'EMP2018089610',
			'EMP2018089611',
			'EMP2018089612',
			'EMP2018089613',
			'EMP2018089614',
			'EMP2018089616',
			'EMP2018089617',
			'EMP2018089618',
			'EMP2018089619',
			'EMP2018089620',
			'EMP2018089621',
			'EMP2018089622',
			'EMP2018089623',
			'EMP2018089624',
			'EMP2018089625',
			'EMP2018089626',
			'EMP2018089627',
			'EMP2018089628',
			'EMP2018089629',
			'EMP2018089631',
			'EMP2018089632',
			'EMP2018089633',
			'EMP2018089634',
			'EMP2018089635',
			'EMP2018089636',
			'EMP2018089637',
			'EMP2018089638',
			'EMP2018089639',
			'EMP2018089640',
			'EMP2018089641',
			'EMP2018089642',
			'EMP2018089643',
			'EMP2018089644',
			'EMP2018089645',
			'EMP2018089646',
			'EMP2018089647',
			'EMP2018089648',
			'EMP2018089649',
			'EMP2018089650',
			'EMP2018089651',
			'EMP2018089652',
			'EMP2018089653',
			'EMP2018089654',
			'EMP2018089655',
			'EMP2018089656',
			'EMP2018089657',
			'EMP2018089658',
			'EMP2018089659',
			'EMP2018089660',
			'EMP2018089661',
			'EMP2018089662',
			'EMP2018089663',
			'EMP2018089664',
			'EMP2018089665',
			'EMP2018089666',
			'EMP2018089667',
			'EMP2018089668',
			'EMP2018089669'
    	];
    	$outlets = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55];

    	for ($i=0; $i < count($names); $i++) { 
            DB::table('users')->insert([
            'name' => $names[$i],
            'nik' => $niks[$i],
            'email' => $emails[$i],
            'password' => bcrypt($passwords[$i]),
            'staff_position' => '8',
            'staff_status' => '2',
            'outlet_id' => $outlets[$i]
        ]);
        }

        
    }
}
