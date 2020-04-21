<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
  protected $fillable = ['name', 'image', 'link_text', 'link_url', 'survey_id'];
  protected $hidden = ['created_at', 'updated_at'];
  
  public function survey(){
    return $this->belongsTo('App\Survey');
  }
}
