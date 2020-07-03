<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $fillable = ['name', 'image', 'url', 'iframe', 'is_active', 'enabled', 'duration', 'user_id'];
  protected $hidden = ['created_at'];
  
  protected $casts = [
      'enabled' => 'Boolean',
      'is_active' => 'Boolean'
  ];
  
  public function scopeByUser($query, $user){
    if( !$user ){
      return $query->where('user_id', '!=', null);
    }
    return $query->where('user_id', $user);
  }
  
  public function scopeActiveOrEnabled($query){
    return $query->where('is_active','=',1)->orWhere('enabled', 1)->orderByDesc('is_active')->limit(1);
  }
  
  public function getExpireDateAttribute(){
    return $this->updated_at->toDate()->add( new \DateInterval('PT' . $this->duration . 'S') );
  }
  
  public function isExpired(){
    $now = new \DateTime();
    return ($now->getTimestamp() - $this->expireDate->getTimestamp() > 0);
  }
  
  public function scopeNextEnabled($query, $banner){
    if( !$banner ){
      return null;
    }
    return $query->where('user_id', $banner->user_id)->where('enabled', 1)->where('id', '>', $banner->id);
  }
  
  public static function rotateIfExpired( $banner ){
    if( $banner && $banner->isExpired() ){
      $nextBanner = self::nextEnabled( $banner )->first();
      $nextBanner = ($nextBanner && $nextBanner->id) ? $nextBanner : self::where('user_id', $banner->user_id)->where('enabled', 1)->first();
    
      $banner->update(['is_active'=>0]);
      $nextBanner->update(['is_active'=>1]);
      return $nextBanner;
    }
    return $banner;
  }
  
}
