<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $fillable = ['name', 'image', 'url', 'iframe', 'is_active', 'enabled', 'duration'];
  protected $hidden = ['created_at'];
  
  protected $casts = [
      'enabled' => 'Boolean',
      'is_active' => 'Boolean'
  ];
  
  public function getExpiredDateTimeAttribute(){
    return $this->updated_at->toDate()->add( new \DateInterval('PT' . $this->duration . 'S'));
  }
  
  public function getHasExpiredAttribute(){
    $now = new \DateTime();
    $now = $now->getTimestamp();
    return ($now - $this->expiredDateTime->getTimestamp()) > 0;
  }
  
  public function getNextEnabledSibling(){
    return self::whereEnabled(1)->where('id', '>', $this->id)->first() ?: self::whereEnabled(1)->first();
  }
}
