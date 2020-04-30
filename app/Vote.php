<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
  protected $fillable = ['survey_id', 'choice_id', 'ip_address'];
  protected $hidden = ['created_at', 'updated_at'];
  
  public function survey(){
    return $this->belongsTo('App\Survey');
  }
}
