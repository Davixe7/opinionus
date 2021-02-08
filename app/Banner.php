<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $fillable = ['name', 'image', 'url', 'type', 'iframe', 'expires_at', 'enabled', 'duration', 'user_id'];
  protected $hidden = ['created_at'];
  protected $appends = ['picture_url'];

  protected $casts = [
      'enabled' => 'Boolean'
  ];

  public function getPictureUrlAttribute(){
    return $this->image ? str_replace('public', '/storage', $this->image) : '';
  }

  public static function restartRound($banners){
    $expires_at = \Carbon\Carbon::now();
    foreach( $banners as $banner ){
      $expires_at = $expires_at->addSeconds($banner->duration);
      $banner->update(['expires_at'=>$expires_at->format('Y-m-d H:i:s')]);
    }
    return $banners->first();
  }

  public function scopeActive($query){
    $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
    return $query->enabled()->where('expires_at', '>', $now);
  }

  public function scopeByUser($query, $user){
    if( !$user ){
      return $query->where('user_id', '!=', null);
    }
    return $query->where('user_id', $user);
  }
  public function scopeEnabled($query){
    return $query->whereEnabled(1);
  }

}
