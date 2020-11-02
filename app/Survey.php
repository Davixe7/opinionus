<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
  protected $fillable = ['name', 'slug', 'user_id', 'expires_at'];
  protected $hidden = ['created_at', 'updated_at'];
  protected $appends = ['votes_count','social_media_links', 'is_expired'];

  public function choices(){
    return $this->hasMany('App\Choice');
  }

  public function votes(){
    return $this->hasMany('App\Vote');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function regenerateSlugs(){
    $surveys = self::all();
    $surveys->each( function($s){
      $s->slug = Str::slug( $s->name);
      $s-save();
    });
  }

  public function scopeByName($query, $name){
    if( !$name ){
      return $query;
    }
    $name = strtolower($name);
    return $query->where('name','like',"%$name%");
  }

  public function scopeByUser($query, $user){
    if( !$user ){
      return $query;
    }
    return $query->where('user_id', $user);
  }

  public function reports(){
    return $this->hasMany('App\Report');
  }

  public function getReportsCountAttribute(){
    return $this->reports()->count();
  }

  public function getVotesCountAttribute(){
    return $this->votes()->count();
  }

  public function getCreatedDateAttribute(){
    return $this->created_at->format('M d Y');
  }

  public function getDaysLeftAttribute(){
    if( !$this->expires_at ){
      return "30 days";
    }
    return \Carbon\Carbon::parse($this->expires_at)->diffForHumans();
  }

  public function getSocialMediaLinksAttribute(){
    $vote_url    = urlencode( route('surveys.vote', ['slug'=>$this->slug]) );
    $results_url = urlencode( route('surveys.results', ['slug'=>$this->slug]) );
    $fb_base_url      = "http://www.facebook.com/sharer.php?u=";
    $twitter_base_url = "https://twitter.com/intent/tweet?text=$this->name";
    return [
      'facebook' => [
        'vote' => $fb_base_url . $vote_url,
        'results' => $fb_base_url . $results_url
      ],
      'twitter' => [
        'vote'    => $twitter_base_url . ' &url=' . $vote_url ,
        'results' => $twitter_base_url . ' &url=' . $results_url
      ],
    ];
  }

  public function getIsExpiredAttribute(){
    if( !$this->expires_at ){ return false; }
    if( $this->expires_at < \Carbon\Carbon::now() ){ return true; }
  }
}
