<?php

namespace App\Http\Controllers\Dashboard;

use App\Survey;
use App\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\Survey as SurveyResource;
use App\Http\Resources\Choice as ChoiceResource;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $surveys = auth()->user()->surveys;
      if( request()->expectsJson() ){
        return SurveyResource::collection( $surveys );
      }
      return view('dashboard.surveys.index', ['surveys'=>$surveys]);
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
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.surveys.create');
    }

    public function store(Request $request)
    {
      $survey = Survey::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'user_id' => auth()->id()
      ]);
      return new SurveyResource( $survey );
    }
    
    public function edit(Survey $survey)
    {
      $survey->choices = ChoiceResource::collection($survey->choices);
      return view('dashboard.surveys.edit', [
        'survey' =>$survey
      ]);
    }
    
    public function update(Request $request, Survey $survey)
    {
      $survey->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
      ]);
      return new SurveyResource( $survey );
    }


    public function destroy(Request $request, Survey $survey)
    {
      $survey->choices()->delete();
      $survey->delete();
      if($request->expectsJson()){
        return response()->json(['data'=>"Survey {$survey->id} deleted successfully"]);
      }
      $request->session()->flash('message', "Survey $survey->id deleted successfully");
      return redirect()->route('dashboard.surveys.index');
    }
}
