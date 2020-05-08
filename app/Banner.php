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
      return $query;
    }
    return $query->where('user_id', $user);
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
  
}
