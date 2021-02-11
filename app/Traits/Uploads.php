<?php

namespace App\Traits;
use Illuminate\Http\Request;
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
      
      $thumbnail_small = Image::make( storage_path( "app/" . $original ) )->fit(300,300);
      $thumbnail_small->save(storage_path("app/public/thumbnails/300/{$newFileName}"));
      
      $thumbnail_medium = Image::make( storage_path( "app/" . $original ) )->fit(500,500);
      $thumbnail_medium->save(storage_path("app/public/thumbnails/500/{$newFileName}"));
      
      $thumbnail_medium = Image::make( storage_path( "app/" . $original ) )->fit(70,70);
      $thumbnail_medium->save(storage_path("app/public/thumbnails/40/{$newFileName}"));
      
      return $original;
    }
    return null;
  }
}