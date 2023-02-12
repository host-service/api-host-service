<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
   protected $user;
   private $userService;

   public function __construct(UserService $userService)
   {
      $this->user = JWTAuth::parseToken()->authenticate();
      $this->userService = $userService;
   }
   public function index(Request $request)
   {
      try {
         $user = JWTAuth::authenticate($request->token);
         return response()->json([
            'status' => true,
            'message' => 'Data berhasil didapatkan',
            'data' => $user,
         ], 200);
      } catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => 'Data gagal didapatkan',
         ], 400);
      }
   }
   public function show($id)
   {
      try {
         $user = $this->userService->show($id);
         return response()->json([
            'status' => true,
            'message' => 'User berhasil didapatkan',
            'data' => $user,
         ], 200);
      } catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => 'User gagal didapatkan',
         ], 400);
      }
   }
   public function list()
   {
      try {
         $user = $this->userService->list();
         return response()->json([
            'status' => true,
            'message' => 'List user berhasil didapatkan',
            'data' => $user,
         ], 200);
      } catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => 'List user gagal didapatkan',
         ], 400);
      }
   }
   public function update(Request $request)
   {
      try {
         $user = $this->userService->update($request->all(), $this->user->id);
         return response()->json([
            'status' => true,
            'message' => 'User berhasil diubah',
            'data' => $user,
         ], 200);
      } catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => 'User gagal diubah',
         ], 400);
      }
   }
   public function destroy($id)
   {
      try {
         $user = $this->userService->destroy($id);
         return response()->json([
            'status' => true,
            'message' => 'User berhasil dihapus',
            'data' => $user,
         ], 200);
      } catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => 'User gagal dihapus',
         ], 400);
      }
   }
}
