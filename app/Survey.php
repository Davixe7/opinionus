<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $fillable = ['name', 'slug'];
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
  
  public function regenerateSlugs(){
    $surveys = self::all();
    $surveys->each( function($s){ 
      $s->slug = Str::slug( $s->name);
      $s-save(); 
    });
  }
  
}
