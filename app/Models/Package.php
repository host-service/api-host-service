<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
   use HasFactory;
   protected $fillable = [
      'id_user', 'nama', 'deskripsi', 'jenis', 'terms_condition', 'syarat_refund', 'umur_min', 'umur_max', 'is_refund'
   ];
   public function user()
   {
      return $this->belongsTo(User::class, 'id_user');
   }
   public function gallery()
   {
      return $this->hasMany(PackageGallery::class, 'id_package');
   }
   public function category()
   {
      return $this->hasMany(PackageCategory::class, 'id_package');
   }
   public function schedule()
   {
      return $this->hasMany(PackageSchedule::class, 'id_package');
   }
   public function item()
   {
      return $this->hasMany(PackageItem::class, 'id_package');
   }
}
