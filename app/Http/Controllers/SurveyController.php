<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Banner;
use Illuminate\Http\Request;
use App\Http\Resources\Survey as SurveyResource;
use App\Http\Resources\Choice as ChoiceResource;
use App\Http\Requests\SearchSurvey;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $surveys = SurveyResource::collection( Survey::all() );
      if( request()->expectsJson() ){
        return response()->json(['data'=>$surveys]);
      }
      return view('surveys.index', ['surveys'=>$surveys]);
    }
    
    public function search(SearchSurvey $request){
      $surveys = Survey::enabled()->withChoices();
      if( !$request->has('show_expired') ){ $surveys = $surveys->open(); }
      $surveys = $surveys->byName( $request->name )->dateRange($request->date_from, $request->date_to)->get();
      return view('search', ['surveys' => $surveys]);
    }
    
    public function vote(Request $request)
    {
      $survey = Survey::where('slug', $request->slug)->firstOrFail();
      return view('surveys.vote', ['survey'=>$survey->load('choices')]);
    }
    
    public function results(Request $request)
    {
      $userChoice = null;
      if( $request->has('choice_id') ){
        $userChoice = \App\Choice::findOrFail( $request->choice_id );
      }
      $survey = Survey::where('slug', $request->slug)->firstOrFail();
      return view('surveys.results', [
        'survey'=>$survey->load('choices'),
        'banner'=>Banner::where('is_active', 1)->first(),
        'userChoice' => $userChoice
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
