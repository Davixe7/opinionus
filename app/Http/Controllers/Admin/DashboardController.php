<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class DashboardController extends Controller
{
  
  public function updateLogo(Request $request){
    if( $file = $request->file( 'logo' ) ){
      $name = 'brand-logo.' . $file->getClientOriginalExtension();
      $uploadedFile = $file->storeAs('public', $name);
      
      $header_logo = Image::make( storage_path( "app/" . $uploadedFile ) )
      ->resize(null,50, function($constraint){
        $constraint->aspectRatio();
      });
      $header_logo->save(storage_path("app/public/$name"));
      $url = str_replace('public', 'storage', asset($uploadedFile));
      return response()->json(['data'=>$url]);
    }
    return response()->json(['data'=>'No image received']);
  }
}
