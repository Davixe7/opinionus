<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $fillable = ['name', 'slug', 'user_id'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $appends = ['votes_count'];
  
  public function choices(){
    return $this->hasMany('App\Choice');
  }
  
  public function votes(){
    return $this->hasMany('App\Vote');
  }
  
  public function user(){
    return $this->belongsTo('App\User');
  }
  
  public function getVotesCountAttribute(){
    return $this->votes()->count();
  }
  
  public function regenerateSlugs(){
    $surveys = self::all();
    $surveys->each( function($s){ 
      $s->slug = Str::slug( $s->name);
      $s-save(); 
    });
  }
  
  public function scopeByUser($query, $user){
    if( !$user ){
      return $query;
    }
    return $query->where('user_id', $user);
  }
  
}
