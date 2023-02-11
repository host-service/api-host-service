<?php

namespace Database\Seeders;

use App\Models\Host;
use Illuminate\Database\Seeder;

class HostSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Host::insert([
         [
            'id_user' => 1,
            'ktp' => '123321123',
            'img_ktp' => '/img/profile-default.jpg',
            'img_selfie' => '/img/profile-default.jpg',
         ],
      ]);
   }
}
