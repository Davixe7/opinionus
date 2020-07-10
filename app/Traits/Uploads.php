<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

trait Uploads
{    
  public function upload(Request $request, String $inputfilename, String $fileGroupName = 'images')
  {
    if( $file = $request->file( $inputfilename ) ){
      if( is_array( $file ) ) $file = $file[0];
      $nameWithoutExtension = str_replace(" ", "", pathinfo( $file->getClientOriginalName(), PATHINFO_FILENAME ));
      $extension = "." . $file->getClientOriginalExtension();
      $newFileName = $nameWithoutExtension . "_" . time() . $extension;
      
      $original = $file->storeAs('public/' . $fileGroupName, $newFileName);
      
      $sizes = ['300', '500', '40', '70'];
      foreach( $sizes as $size ){
        $path = storage_path("app/public/thumbnails/$size");
        if( !Storage::exists( $path ) ){
          Storage::makeDirectory($path, $mode = 0777, true, true);
        }
        $thumbnail = Image::make( storage_path( "app/" . $original ) )->fit($size);
        $thumbnail->save(storage_path("$path/{$newFileName}"));
      }
      
      return $original;
    }
    return null;
  }
}