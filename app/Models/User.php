<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject

{
   use  HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'nama_lengkap',
      'username',
      'no_telepon',
      'jenis_kelamin',
      'tempat_lahir',
      'tanggal_lahir',
      'email',
      'password',
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
      'password', 'remember_token',
   ];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
      'email_verified_at' => 'datetime',
   ];

   public function getJWTIdentifier()
   {
      return $this->getKey();
   }
   public function getJWTCustomClaims()
   {
      return [];
   }
   public function products()
   {
      return $this->hasMany(Product::class);
   }
   public function business()
   {
      return $this->hasMany(Business::class);
   }
   public function packages()
   {
      return $this->hasMany(Package::class, 'id_user');
   }
}
