<?php

namespace App\Http\Controllers;

use App\Models\PackageItem;
use Illuminate\Http\Request;

class PackageItemController extends Controller
{
   public function store(Request $request, $packages)
   {
      $request->merge(["id_package" => $packages]);
      $data = $request->only('id_package', 'nama', 'jumlah', 'harga');
      $packages = PackageItem::create($data);
      return response()->json([
         'success' => true,
         'message' => 'Package Item created successfully',
         'data' => $packages
      ], 200);
   }
}
