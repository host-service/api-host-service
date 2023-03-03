<?php

namespace App\Http\Controllers;

use App\Models\PackageSchedule;
use Illuminate\Http\Request;

class PackageScheduleController extends Controller
{
   public function store(Request $request, $packages)
   {
      $request->merge(["id_package" => $packages]);
      $data = $request->only('id_package', 'tanggal_mulai', 'tanggal_selesai', 'waktu', 'jumlah_dewasa', 'jumlah_anak');
      $packages = PackageSchedule::create($data);
      return response()->json([
         'success' => true,
         'message' => 'Package created successfully',
         'data' => $packages
      ], 200);
   }
}
