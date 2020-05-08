<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth:web,admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if( auth('admin')->check() ){
        $siteconfig = Storage::get('/frontend-config.json');
        return view('home', ['siteconfig'=>$siteconfig]);
      }
      abort(403, 'Youre not a root user or system administrator');
    }
    
    public function dashboard()
    {
      return view('dashboard');
    }
}
