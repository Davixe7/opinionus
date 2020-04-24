<?php

namespace App\Http\Controllers;

use App\Survey;
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
      $surveys = Survey::all();
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
      return view('surveys.results', ['survey'=>$survey->load('choices')]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $survey = Survey::create([
        'name' => $request->name
      ]);
      return new SurveyResource( $survey );
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
      $survey->choices = ChoiceResource::collection($survey->choices);
      return view('surveys.edit', [
        'survey'=>$survey
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
      $survey->update([
        'name' => $request->name
      ]);
      return new SurveyResource( $survey );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Survey $survey)
    {
      $survey->choices()->delete();
      $survey->delete();
      if($request->expectsJson()){
        return response()->json(['data'=>"Survey {$survey->id} deleted successfully"]);
      }
      $request->session()->flash('message', "Survey $survey->id deleted successfully");
      return redirect()->route('surveys.index');
    }
    
    public function deleteAll(Request $request){
      Survey::all()->each(function($c){ $c->choices()->delete(); $c->delete(); });
      if( $request->expectsJson() ){
        return response()->json(['data'=>'Surveys deleted succesfully']);
      }
      return redirect()->route('surveys.index');
    }
}
