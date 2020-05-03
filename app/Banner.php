<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  protected $fillable = ['name', 'image', 'url', 'iframe', 'is_active', 'duration'];
  protected $hidden = ['created_at'];
  
}
