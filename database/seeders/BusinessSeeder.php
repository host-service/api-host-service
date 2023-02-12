<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      Business::insert([
         [
            'id_host' => 1,
            'nama' => 'PT Host',
            'jenis' => 'sewa jasa',
            'deskripsi' => 'Pembuat app host',
            'lokasi' => 'jln braga',
         ],
      ]);
   }
}
