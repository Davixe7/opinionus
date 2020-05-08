<?php

namespace App\Http\Controllers\Dashboard;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Resources\Banner as BannerResource;
use App\Traits\Uploads;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    
    use Uploads;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $banners = auth()->user()->banners;
      if( request()->expectsJson() ){
        return BannerResource::collection( $banners );
      }
      return view('dashboard.banners.index', ['banners'=>$banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $banners = auth()->user()->banners;
      return view('dashboard.banners.create', ['banners'=>$banners]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $banner = Banner::create([
        'name'      => $request->name,
        'image'     => $this->upload( $request, 'image'),
        'url'       => $request->url,
        'duration'  => $request->duration,
        'is_active' => auth()->user()->banners()->count() ? 0 : 1,
        
        'user_id'  => auth()->id()
      ]);
      
      if( $request->expectsJson() ){
        return new BannerResource( $banner );
      }
      
      $request->session()->flash('message', 'Banner Ad Created Successfully!');
      return redirect()->route('dashboard.banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
      if( request()->expectsJson() ){
        return new BannerResource( $banner );
      }
      return view('dashboard.banners.create', $banner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
      $banners = auth()->user()->banners;
      return view('dashboard.banners.edit', ['banner'=>$banner, 'banners'=>$banners]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
      $updated_file = $this->upload( $request, 'image');
      
      $banner->update([
        'name'      => $request->name   ?: $banner->name,
        'image'     => $updated_file    ?: $banner->image,
        'url'       => $request->url    ?: $banner->url,
        'duration'  => $request->duration ?: $banner->duration,
        'enabled'   => $request->has('enabled') ? $request->enabled : $banner->enabled
      ]);
      
      if( $request->expectsJson() ){
        return response()->json( ['data'=>$banner] );
      }
      $request->session()->flash('message', 'Banner Ad Updated Successfully!');
      return redirect()->route('dashboard.banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banner $banner)
    {
      $banner->delete();
      if( $request->expectsJson() ){
        return response()->json(['data'=>"Banner {$banner->id} deleted successfully"]);
      }
      $banners = auth()->user()->banners;
      $request->session()->flash('message', "Banner {$banner->id} deleted Successfully!");
      return redirect()->route('dashboard.banners.index');
    }
}
