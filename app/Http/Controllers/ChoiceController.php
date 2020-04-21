<?php

namespace App\Http\Controllers;

use App\Choice;
use Illuminate\Http\Request;
use App\Http\Resources\Choice as ChoiceResource;
use App\Traits\Uploads;

class ChoiceController extends Controller
{
    
    use Uploads;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $choices = Choice::all();
      if( request()->expectsJson() ){
        return ChoiceResource::collection( $choices );
      }
      return view('choices.index', ['choices'=>$choices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('choices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $choice = Choice::create([
        'name'      => $request->name,
        'image'     => $this->upload( $request, 'image'),
        'link_text' => $request->link_text,
        'link_url'  => $request->link_url,
        'survey_id' => $request->survey_id
      ]);
      
      return new ChoiceResource( $choice );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function show(Choice $choice)
    {
      if( request()->expectsJson() ){
        return new ChoiceResource( $choice );
      }
      return view('choices.create', $choice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function edit(Choice $choice)
    {
      return view('choices.edit', $choice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Choice $choice)
    {
      $updated_file = $this->upload( $request, 'image');
      
      $choice->update([
        'name'      => $request->name ?: $choice->name,
        'image'     => $updated_file ?: $choice->image,
        'link_text' => $request->link_text ?: $choice->link_text,
        'link_url'  => $request->link_url  ?: $choice->link_url,
      ]);
      return new ChoiceResource( $choice );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Choice $choice)
    {
      $choice->delete();
      return response()->json(['data'=>"Choice {$choice->id} deleted successfully"]);
    }
}
