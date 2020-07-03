<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $fillable = ['subject', 'description', 'read_at', 'survey_id'];
  protected $hidden = ['updated_at'];
  
  public function survey(){
    return $this->belongsTo('App\Survey');
  }
}
