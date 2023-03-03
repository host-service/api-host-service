<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model
{
   use HasFactory;
   protected $fillable = [
      'id_package', 'id_category'
   ];
}
