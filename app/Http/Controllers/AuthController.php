<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
   private $userService;
   public function __construct(UserService $userService)
   {
      $this->userService = $userService;
   }
   public function register(UserRequest $request)
   {
      try {
         $user = $this->userService->store($request->form());
         return response()->json([
            'status' => true,
            'message' => 'User berhasil dibuat',
            'data' => $user,
         ], 200);
      } catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => 'User gagal dibuat',
            'data' => $th->getMessage(),
         ], $th->getCode());
      }
   }
   public function authenticate(Request $request)
   {
      $credentials = $request->only('email', 'password');
      $validator = Validator::make($credentials, [
         'email' => 'required|email',
         'password' => 'required|string|min:6|max:50'
      ]);
      if ($validator->fails()) {
         return response()->json(['error' => $validator->messages()], 200);
      }
      try {
         if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
               'success' => false,
               'message' => 'Login credentials are invalid.',
            ], 400);
         }
      } catch (JWTException $e) {
         return $credentials;
         return response()->json([
            'success' => false,
            'message' => 'Could not create token.',
         ], 500);
      }
      return response()->json([
         'success' => true,
         'token' => $token,
         'user' => auth()->user(),
      ]);
   }
}
