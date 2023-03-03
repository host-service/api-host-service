<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
   use HasFactory;
   protected $fillable = [
      'id_package', 'nama', 'jumlah', 'harga'
   ];
}
