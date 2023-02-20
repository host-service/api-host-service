<?php

namespace App\Http\Controllers;

// use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
   public function register(Request $request)
   {
      $data = $request->only(
         'nama_lengkap',
         'username',
         'no_telepon',
         'jenis_kelamin',
         'tempat_lahir',
         'tanggal_lahir',
         'email',
         'password',
      );
      $validator = Validator::make($data, [
         'nama_lengkap' => 'required|string',
         'username' => 'required|string|unique:users,username',
         'no_telepon' => 'required|string',
         'jenis_kelamin' => 'required|in:laki-laki,perempuan',
         'tempat_lahir' => 'required|integer',
         'tanggal_lahir' => 'required|date',
         'email' => 'required|email|unique:users',
         'password' => 'required|string|min:6|max:50'
      ]);

      //Send failed response if request is not valid
      if ($validator->fails()) {
         return response()->json(['error' => $validator->messages()], 200);
      }

      //Request is valid, create new user
      $user = User::create([
         'nama_lengkap' => $request->nama_lengkap,
         'username' => $request->username,
         'no_telepon' => $request->no_telepon,
         'jenis_kelamin' => $request->jenis_kelamin,
         'tempat_lahir' => $request->tempat_lahir,
         'tanggal_lahir' => $request->tanggal_lahir,
         'email' => $request->email,
         'password' => bcrypt($request->password)
      ]);

      //User created, return success response
      return response()->json([
         'success' => true,
         'message' => 'User created successfully',
         'data' => $user
      ], Response::HTTP_OK);
   }

   public function authenticate(Request $request)
   {
      $credentials = $request->only('email', 'password');

      //valid credential
      $validator = Validator::make($credentials, [
         'email' => 'required|email',
         'password' => 'required|string|min:6|max:50'
      ]);

      //Send failed response if request is not valid
      if ($validator->fails()) {
         return response()->json(['error' => $validator->messages()], 200);
      }

      //Request is validated
      //Crean token
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

      //Token created, return with success response and jwt token
      return response()->json([
         'success' => true,
         'token' => $token,
         'user' => auth()->user(),
      ]);
   }

   public function logout(Request $request)
   {
      //valid credential
      $validator = Validator::make($request->only('token'), [
         'token' => 'required'
      ]);

      //Send failed response if request is not valid
      if ($validator->fails()) {
         return response()->json(['error' => $validator->messages()], 200);
      }

      //Request is validated, do logout        
      try {
         JWTAuth::invalidate($request->token);

         return response()->json([
            'success' => true,
            'message' => 'User has been logged out'
         ]);
      } catch (JWTException $exception) {
         return response()->json([
            'success' => false,
            'message' => 'Sorry, user cannot be logged out'
         ], Response::HTTP_INTERNAL_SERVER_ERROR);
      }
   }

   public function get_user(Request $request)
   {
      // $this->validate($request, [
      //    'token' => 'required'
      // ]);

      $user = JWTAuth::authenticate($request->token);

      return response()->json(['user' => $user]);
   }
}
