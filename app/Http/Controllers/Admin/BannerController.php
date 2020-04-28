<?php

namespace App\Http\Controllers\Admin;

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
      $banners = Banner::all();
      if( request()->expectsJson() ){
        return BannerResource::collection( $banners );
      }
      return view('admin.banners.index', ['banners'=>$banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $banners = Banner::all();
      return view('admin.banners.create', ['banners'=>$banners]);
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
        'iframe'    => $request->iframe,
      ]);
      
      if( $request->expectsJson() ){
        return new BannerResource( $banner );
      }
      
      $request->session()->flash('message', 'Banner Ad Created Successfully!');
      return redirect()->route('banners.index');
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
      return view('admin.banners.create', $banner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
      $banners = Banner::all();
      return view('admin.banners.edit', ['banner'=>$banner, 'banners'=>$banners]);
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
        'iframe'    => $request->iframe ?: $banner->iframe
      ]);
      
      $request->session()->flash('message', 'Banner Ad Updated Successfully!');
      return redirect()->route('banners.index');
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
      $banners = Banner::all();
      $request->session()->flash('message', "Banner {$banner->id} deleted Successfully!");
      return redirect()->route('banners.index');
    }
}
