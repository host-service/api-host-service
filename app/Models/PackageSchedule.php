<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSchedule extends Model
{
   use HasFactory;
   protected $fillable = [
      'id_package', 'tanggal_mulai', 'tanggal_selesai', 'waktu', 'jumlah_dewasa', 'jumlah_anak'
   ];
}
