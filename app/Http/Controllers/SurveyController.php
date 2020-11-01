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
    public function index(Request $request)
    {
      $results = Survey::has('choices', '>=', 2)->with('choices')->byName($request->name)->get();

      if( request()->expectsJson() ){
        return SurveyResource::collection( $surveys );
      }
      return view('search', ['results'=>$results]);
    }

    public function vote(Request $request)
    {
      $survey = Survey::where('slug', $request->slug)->firstOrFail();
      return view('vote', ['survey'=>$survey->load('choices')]);
    }

    public function results(Request $request)
    {
      $survey = Survey::where('slug', $request->slug)->with('choices')->firstOrFail();
      $choice = $survey->choices->find( $request->choice_id );

      if( $choice ){
        $survey->choices = $survey->choices->filter(function($c)use($choice){
          return $c->id != $choice->id;
        });
      }

      if( !$banner = $survey->user->banners()->active()->first() ){
        $banner = Banner::restartRound( $survey->user->banners()->enabled()->get() );
      }

      if( !$admin_banner = Banner::where('user_id', null)->active()->first() ){
        $admin_banner = Banner::restartRound( Banner::where('user_id', null)->enabled()->get() );
      }

      return view('results', [
        'choice' => $choice,
        'survey' => $survey,
        'admin_banner' => $admin_banner,
        'banner' => $banner
      ]);
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
