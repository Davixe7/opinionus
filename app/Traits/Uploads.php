<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait Uploads
{    
  public function upload(Request $request, String $inputfilename, String $fileGroupName = 'images')
  {
    if( $file = $request->file( $inputfilename ) ){
      if( is_array( $file ) ) $file = $file[0];
      return  $file->store('public/' . $fileGroupName);
    }
    return null;
  }
}