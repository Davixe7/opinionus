<?php

namespace App\Http\Controllers\Admin;

use App\Survey;
use App\User;
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
     * @return \Illuminate\Http\Responses
     */
    public function index(Request $request)
    {
      $user = null;
      if( $request->user_id ){
        $user = User::findOrFail($request->user_id);
      }

      $surveys = Survey::byUser( $request->user_id )->get();
      if( request()->expectsJson() ){
        return SurveyResource::collection( $surveys );
      }
      return view('admin.surveys', ['surveys'=>$surveys, 'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $banners = auth()->user()->banners;
      return view('admin.surveys.create', ['banners' => $banners]);
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
        'name'    => $request->name,
        'slug'    => Str::slug($request->name),
        'user_id' => $request->user_id,
        'banner_id' => $request->banner_id,
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
      return view('admin.surveys.create', ['survey'=>$survey]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
      $banners = auth()->user()->banners;
      $survey->choices = ChoiceResource::collection($survey->choices);
      return view('admin.surveys.edit', [
        'survey'  => $survey,
        'banners' => $banners,
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
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'banner_id' => $request->banner_id,
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
