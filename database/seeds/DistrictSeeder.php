<?php

use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete users table records
       DB::table('districts')->delete();

       DB::table('districts')->insert(
        [
        [ 'name'=>"Achham"         ] ,
        [ 'name'=>"Arghakhanchi"   ] ,
        [ 'name'=>"Baglung"        ] ,
        [ 'name'=>"Baitadi"        ] ,
        [ 'name'=>"Bajhang"        ] ,
        [ 'name'=>"Bajura"         ] ,
        [ 'name'=>"Banke"          ] ,
        [ 'name'=>"Bara"           ] ,
        [ 'name'=>"Bardiya"        ] ,
        [ 'name'=>"Bhaktapur"      ] ,
        [ 'name'=>"Bhojpur"        ] ,
        [ 'name'=>"Chitwan"        ] ,
        [ 'name'=>"Dadeldhura"     ] ,
        [ 'name'=>"Dailekh"        ] ,
        [ 'name'=>"Dang Deukhuri"  ] ,
        [ 'name'=>"Darchula"       ] ,
        [ 'name'=>"Dhading"        ] ,
        [ 'name'=>"Dhankuta"       ] ,
        [ 'name'=>"Dhanusa"        ] ,
        [ 'name'=>"Dholkha"        ] ,
        [ 'name'=>"Dolpa"          ] ,
        [ 'name'=>"Doti"           ] ,
        [ 'name'=>"Gorkha"         ] ,
        [ 'name'=>"Gulmi"          ] ,
        [ 'name'=>"Humla"          ] ,
        [ 'name'=>"Ilam"           ] ,
        [ 'name'=>"Jajarkot"       ] ,
        [ 'name'=>"Jhapa"          ] ,
        [ 'name'=>"Jumla"          ] ,
        [ 'name'=>"Kailali"        ] ,
        [ 'name'=>"Kalikot"        ] ,
        [ 'name'=>"Kanchanpur"     ] ,
        [ 'name'=>"Kapilvastu"     ] ,
        [ 'name'=>"Kaski"          ] ,
        [ 'name'=>"Kathmandu"      ] ,
        [ 'name'=>"Kavrepalanchok" ] ,
        [ 'name'=>"Khotang"        ] ,
        [ 'name'=>"Lalitpur"       ] ,
        [ 'name'=>"Lamjung"        ] ,
        [ 'name'=>"Mahottari"      ] ,
        [ 'name'=>"Makwanpur"      ] ,
        [ 'name'=>"Manang"         ] ,
        [ 'name'=>"Morang"         ] ,
        [ 'name'=>"Mugu"           ] ,
        [ 'name'=>"Mustang"        ] ,
        [ 'name'=>"Myagdi"         ] ,
        [ 'name'=>"Nawalparasi"    ] ,
        [ 'name'=>"Nuwakot"        ] ,
        [ 'name'=>"Okhaldhunga"    ] ,
        [ 'name'=>"Palpa"          ] ,
        [ 'name'=>"Panchthar"      ] ,
        [ 'name'=>"Parbat"         ] ,
        [ 'name'=>"Parsa"          ] ,
        [ 'name'=>"Pyuthan"        ] ,
        [ 'name'=>"Ramechhap"      ] ,
        [ 'name'=>"Rasuwa"         ] ,
        [ 'name'=>"Rautahat"       ] ,
        [ 'name'=>"Rolpa"          ] ,
        [ 'name'=>"Rukum"          ] ,
        [ 'name'=>"Rupandehi"      ] ,
        [ 'name'=>"Salyan"         ] ,
        [ 'name'=>"Sankhuwasabha"  ] ,
        [ 'name'=>"Saptari"        ] ,
        [ 'name'=>"Sarlahi"        ] ,
        [ 'name'=>"Sindhuli"       ] ,
        [ 'name'=>"Sindhupalchok"  ] ,
        [ 'name'=>"Siraha"         ] ,
        [ 'name'=>"Solukhumbu"     ] ,
        [ 'name'=>"Sunsari"        ] ,
        [ 'name'=>"Surkhet"        ] ,
        [ 'name'=>"Syangja"        ] ,
        [ 'name'=>"Tanahu"         ] ,
        [ 'name'=>"Taplejung"      ] ,
        [ 'name'=>"Terhathum"      ] ,
        [ 'name'=>"Udayapur"       ]
        ]);

   }
}
