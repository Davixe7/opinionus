<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Illuminate\Support\Facades\Storage;

class Choice extends Model
{
  protected $fillable = ['name', 'image', 'link_text', 'link_url', 'survey_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $appends = ['votes_count'];
  
  public function survey(){
    return $this->belongsTo('App\Survey');
  }
  
  public function votes(){
    return $this->hasMany('App\Vote');
  }
  
  public function getVotesCountAttribute(){
    return $this->votes()->count();
  }
  
  public static function regenerateThumbnails(){
    $choices = self::all();
    $count = 0;
    foreach( $choices as $choice ){
      echo( $count++ );
      $image = $choice->image;
      $filename = str_replace('public/images', '', $image);
      $path = storage_path( "app/{$image}" );
      
      $sizes = ['300', '500', '40', '70'];
      foreach( $sizes as $size ){
        if( !Storage::exists( $folder = "public/thumbnails/$size" ) ){
          Storage::makeDirectory($folder);
        }
        $thumbnail = Image::make( $path )->fit($size);
        $thumbnail->save( storage_path( "app/" . $folder . "/" . $filename ));
      }
    }
  }
}
