<?php

namespace App\Http\Controllers;

use App\Report;
use App\Survey;
use Illuminate\Http\Request;

class ReportController extends Controller
{

  public function create(Request $request){
    $survey = Survey::findOrFail( $request->survey_id );
    return view('reports.create', ['survey'=>$survey]);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request, Survey $survey)
  {
    $survey = Survey::findOrFail( $request->survey_id );
    Report::create([
      'survey_id'    => $survey->id,
      'subject'      => $request->subject,
      'description'  => $request->description
    ]);

    $request->session()->flash('message', "Reported the poll {$survey->name} successfully");
    return redirect()->route('reports.create', ['survey_id'=>$survey->id]);
  }

}
