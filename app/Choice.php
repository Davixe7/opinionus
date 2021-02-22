<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Choice extends Model
{
  protected $fillable = ['name', 'image', 'link_text', 'link_url', 'survey_id'];
  protected $hidden   = ['created_at', 'updated_at'];
  protected $appends  = ['votes_count', 'picture', 'medium_picture'];

  public function getPictureAttribute(){
    return asset( str_replace('public', 'storage', $this->image) );
  }

  public function getMediumPictureAttribute(){
    return asset( str_replace('public/images', 'storage/thumbnails/500', $this->image) );
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

      $sizes = [70, 300, 500];

      foreach( $sizes as $size ){
        $thumbnail = Image::make( $path )->fit(70);
        $thumbnail->save(storage_path("app/public/thumbnails/{$size}/{$filename}"));
      }
    }
  }
}
