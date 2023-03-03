<?php

namespace App\Http\Controllers;

use App\Models\PackageGallery;
use Illuminate\Http\Request;

class PackageGalleryController extends Controller
{
   public function store(Request $request, $package)
   {
      $request->validate([
         'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
      ]);
      // $name = $request->file('image')->getClientOriginalName();
      $ext = $request->file('image')->getClientOriginalExtension();
      // $path = $request->file('image')->store('public/images');
      $path = $request->file('image')->storeAs('public/images', time() . '.' . $ext);
      PackageGallery::create(
            [
               'id_package' => $package,
               'img' => $path
            ]
         );
      return response()->json([
         'success' => true,
         'message' => 'Image has been upload',
         'data' => $path
      ], 200);
   }
}
