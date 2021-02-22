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
      $request->validate([
        'date_from' => 'nullable|date',
        'date_to'   => 'nullable|date'
      ]);

      $results = Survey::has('choices', '>=', 2)->with('choices')
                                                ->where('created_at', '>=', $request->date_from ?: '2020-01-01')
                                                ->where('created_at', '<=', $request->date_to   ?: \Carbon\Carbon::now())
                                                ->byName($request->name)->get();

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
      $user_choice = $survey->choices->find( $request->choice_id );

      if( $user_choice ){
        $survey->choices = $survey->choices->filter(function($c)use($user_choice){
          return $c->id != $user_choice->id;
        });
      }

      $banner = $survey->banner;

      if( !$banner && !$banner = $survey->user->banners()->active()->first() ){
        $banner = Banner::restartRound( $survey->user->banners()->enabled()->get() );
      }

      if( !$admin_banner = Banner::where('user_id', null)->active()->first() ){
        $admin_banner = Banner::restartRound( Banner::where('user_id', null)->enabled()->get() );
      }

      return view('results', [
        'choice' => $user_choice,
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
