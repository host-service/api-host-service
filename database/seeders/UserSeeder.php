<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      User::insert([
         [
            'nama_lengkap' => 'Super Admin',
            'username' => 'superadmin',
            'no_telepon'    => '0123123123',
            'jenis_kelamin' => 'laki-laki',
            'tempat_lahir' => 1,
            'tanggal_lahir' => '1994-12-12',
            'email' => 'superadmin@email.com',
            'password' => bcrypt('superadmin'),
         ],
      ]);
   }
}
