<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
  public function index(){
    $siteconfig = Storage::get('/frontend-config.json');
    return response()->json(['data'=>$siteconfig]);
  }
  
  public function store(Request $request){
    $siteconfig = json_encode( $request->siteconfig );
    Storage::put('/frontend-config.json', $siteconfig);
    return response()->json(['data'=>$siteconfig]);
  }
}
