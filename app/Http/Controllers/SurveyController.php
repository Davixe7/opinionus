<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Banner;
use Illuminate\Http\Request;
use App\Http\Resources\Survey as SurveyResource;
use App\Http\Resources\Choice as ChoiceResource;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $surveys = Survey::has('choices', '>=', 2)->with('choices')->get();
      if( request()->expectsJson() ){
        return SurveyResource::collection( $surveys );
      }
      return view('surveys.index', ['surveys'=>$surveys]);
    }
    
    public function vote(Request $request)
    {
      $survey = Survey::where('slug', $request->slug)->firstOrFail();
      return view('surveys.vote', ['survey'=>$survey->load('choices')]);
    }
    
    public function results(Request $request)
    {
      $survey = Survey::where('slug', $request->slug)->with('choices')->firstOrFail();
      $adminBanner = Banner::where('user_id', null)->where('is_active', 1)->first();
      $userBanner  = Banner::where('user_id', $survey->user_id)->where('is_active', 1)->first();
      if( $userBanner && $userBanner->isExpired() ){
        $userBanner->update(['is_active'=>0]);
        if( $nextBanner = Banner::nextEnabled( $userBanner )->first() ){
          $nextBanner->update(['is_active'=>1]);
          $userBanner = $nextBanner;
        }
        else {
          $userBanner = Banner::where('user_id', $survey->user_id)->where('enabled', 1)->first();
          $userBanner->update(['is_active'=>1]);
        }
      }
      
      return view('surveys.results', ['survey'=>$survey, 'admin_banner'=>$adminBanner, 'user_banner'=>$userBanner]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
      $survey = Survey::where('slug', $request->slug)->firstOrFail();
      if( request()->expectsJson() ){
        return new SurveyResource( $survey );
      }
      return view('surveys.create', ['survey'=>$survey]);
    }

}
