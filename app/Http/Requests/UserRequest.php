<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
   // public function authorize()
   // {
   //    return false;
   // }
   public function rules()
   {
      return [
         'nama_lengkap' => 'required|string',
         'username' => 'required|string|unique:users,username',
         'no_telepon' => 'required|string',
         'jenis_kelamin' => 'required|in:laki-laki,perempuan',
         'tempat_lahir' => 'required|integer',
         'tanggal_lahir' => 'required|date',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|string|min:6|max:50'
      ];
   }
   public function attributes()
   {
      return [
         'nama_lengkap' => 'Nama Lengkap',
         'username' => 'Username',
         'no_telepon' => 'Nomor Telepon',
         'jenis_kelamin' => 'Jenis Kelamin',
         'tempat_lahir' => 'Tempat Lahir',
         'tanggal_lahir' => 'Tanggal Lahir',
         'email' => 'Email',
         'password' => 'Password'
      ];
   }
   public function messages()
   {
      return [
         'nama_lengkap.required' => ':attribute Harus di Isi',
         'username.required' => ':attribute Harus di Isi',
         'no_telepon.required' => ':attribute Harus di Isi',
         'jenis_kelamin.required' => ':attribute Harus di Isi',
         'tempat_lahir.required' => ':attribute Harus di Isi',
         'tanggal_lahir.required' => ':attribute Harus di Isi',
         'email.required' => ':attribute Harus di Isi',
         'password.required' => ':attribute Harus di Isi0'
      ];
   }
   public function form()
   {
      return [
         'nama_lengkap' => $this->nama_lengkap,
         'username' => $this->username,
         'no_telepon' => $this->no_telepon,
         'jenis_kelamin' => $this->jenis_kelamin,
         'tempat_lahir' => $this->tempat_lahir,
         'tanggal_lahir' => $this->tanggal_lahir,
         'email' => $this->email,
         'password' => bcrypt($this->password)
      ];
   }
}
