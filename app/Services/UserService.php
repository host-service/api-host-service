<?php

namespace App\Services;

use App\Models\User;

class UserService
{
   public function list()
   {
      return User::all();
   }
   public function show($id)
   {
      return User::findOrFail($id);
   }
   public function store($request)
   {
      return User::create($request);
   }
   public function destroy($id)
   {
      $user = User::findOrFail($id);
      $user->delete();
      return $user;
   }
   public function update($request, $id)
   {
      return tap(User::findOrFail($id))->update($request);
   }
}
