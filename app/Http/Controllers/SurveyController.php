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
    
    public function vote(Survey $survey)
    {
      return view('surveys.vote', ['survey'=>$survey->load('choices')]);
    }
    
    public function results(Survey $survey)
    {
      return view('surveys.results', ['survey'=>$survey->load('choices'), 'banner'=>Banner::where('is_active', 1)->first()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
      if( request()->expectsJson() ){
        return new SurveyResource( $survey );
      }
      return view('surveys.create', ['survey'=>$survey]);
    }

}
