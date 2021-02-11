<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Choice extends Model
{
  protected $fillable = ['name', 'image', 'link_text', 'link_url', 'survey_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $appends = ['votes_count', 'picture'];

  public function getPictureAttribute(){
    return str_replace('public','/storage',$this->image);
  }

  public function survey(){
    return $this->belongsTo('App\Survey');
  }

  public function votes(){
    return $this->hasMany('App\Vote');
  }

  public function getVotesCountAttribute(){
    return $this->votes()->count();
  }

  public function getVotesPercentAttribute(){
    if( $this->votes_count ){
      $percent = ($this->votes_count / $this->survey->votes_count) * 100;
      return substr($percent,0,5);
    }
    return 0;
  }

  public static function regenerateThumbnails(){
    $choices = self::all();

    foreach( $choices as $choice ){
      $image = $choice->image;
      $filename = str_replace('public/images', '', $image);
      $path = storage_path( "app/{$image}" );

      $thumbnail_small = Image::make( $path )->fit(70,70);
      $thumbnail_small->save(storage_path("app/public/thumbnails/70/{$filename}"));

      $thumbnail_medium = Image::make( $path )->fit(300,300);
      $thumbnail_medium->save(storage_path("app/public/thumbnails/300/{$filename}"));

      $thumbnail_large = Image::make( $path )->fit(500,500);
      $thumbnail_large->save(storage_path("app/public/thumbnails/500/{$filename}"));
    }
  }
}
