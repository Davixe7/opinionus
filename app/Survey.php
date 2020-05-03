<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $fillable = ['name'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $appends = ['votes_count'];
  
  public function choices(){
    return $this->hasMany('App\Choice');
  }
  
  public function votes(){
    return $this->hasMany('App\Vote');
  }
  
  public function getVotesCountAttribute(){
    return $this->votes()->count();
  }
  
  public static function regenerateThumbnails(){
    $choices = $self::all();

    foreach( $choices as $choice ){
      $image = $choice->image;
      $thumbnail_route = str_replace('public/images', '', $image);
      $thumbnail_medium = Image::make( storage_path( "app/" . $image ) )->fit(40,40);
      $thumbnail_medium->save(storage_path("app/public/thumbnails/40{$thumbnail_route}"));
      
      $thumbnail_medium = Image::make( storage_path( "app/" . $image ) )->fit(300,300);
      $thumbnail_medium->save(storage_path("app/public/thumbnails/300{$thumbnail_route}"));
      
      $thumbnail_medium = Image::make( storage_path( "app/" . $image ) )->fit(500,500);
      $thumbnail_medium->save(storage_path("app/public/thumbnails/500{$thumbnail_route}"));
    }
  }
}
