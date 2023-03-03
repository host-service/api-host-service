<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageCategory;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PackageController extends Controller
{
   protected $user;

   public function __construct()
   {
      $this->user = JWTAuth::parseToken()->authenticate();
   }

   public function index()
   {
      try {
         $package = Package::all();
         return response()->json([
            'status' => true,
            'message' => 'Data berhasil didapatkan',
            'data' => $package,
         ], 200);
      } catch (\Throwable $th) {
         return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
         ], $th->getCode());
      }
   }

   public function store(Request $request)
   {
      $data = $request->only('nama', 'deskripsi', 'jenis', 'terms_condition', 'syarat_refund', 'umur_min', 'umur_max', 'is_refund', 'kategori');

      $kategori = explode(",", $request->kategori);
      $packages = $this->user->packages()->create($data);
      foreach ($kategori as $key => $value) {
         PackageCategory::create([
            'id_package' => $packages->id,
            'id_category' => $value
         ]);
      }
      return response()->json([
         'success' => true,
         'message' => 'Package created successfully',
         'data' => $packages
      ], 200);
   }

   public function show($id)
   {
      $package = $this->user->packages()->with('gallery', 'category', 'schedule', 'item')->find($id);
      if (!$package) {
         return response()->json([
            'success' => false,
            'message' => 'Sorry, package not found.'
         ], 400);
      }

      return response()->json([
         'success' => true,
         'message' => 'Package find successfully',
         'data' => $package
      ], 200);
   }

   public function update(Request $request, Package $package)
   {
      $data = $request->only('nama', 'deskripsi', 'jenis', 'terms_condition', 'syarat_refund', 'umur_min', 'umur_max', 'is_refund');
      //Request is valid, update product
      $package = $package->update($data);

      //Product updated, return success response
      return response()->json([
         'success' => true,
         'message' => 'Package updated successfully',
         'data' => $data
      ], 200);
   }

   public function destroy(Package $package)
   {
      try {
         $package->delete();
         return response()->json([
            'success' => true,
            'message' => 'Package deleted successfully'
         ], 200);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
