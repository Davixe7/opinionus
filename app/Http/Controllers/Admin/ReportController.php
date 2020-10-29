<?php

namespace App\Http\Controllers\Admin;

use App\Report;
use App\Survey;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(Request $request){
      $reports = Survey::whereHas('reports')->with('reports')->get();
      return view('admin.reports', ['surveys'=>$reports]);
    }

    public function ignore(Survey $survey){
      $r = $survey->reports()->delete();
      return redirect()->route('admin.reports.index');
    }

    public function create(Request $request){
      $survey = Survey::findOrFail( $request->survey_id );
      return view('reports.create', ['survey'=>$survey]);
    }


    public function store(Request $request, Survey $survey)
    {
      $survey = Survey::findOrFail( $request->survey_id );
      Report::create([
        'survey_id'    => $survey->id,
        'subject'      => $request->subject,
        'description'  => $request->description
      ]);

      $request->session()->flash('message', "Reported the poll {$survey->name} successfully");
      return redirect()->route('admin.reports.create', ['survey_id'=>$survey->id]);
    }


    public function show(Report $report)
    {
      return response()->json(['data'=>$report]);
    }


    public function update(Request $request, Report $report)
    {
      $report->update([
        'subject'      => $request->subject ?: $report->subject,
        'description'  => $request->description ?: $report->description,
        'status'       => $request->status ?: $report->status
      ]);

      return response()->json(['data'=> $report ]);
    }

    public function destroy(Request $request, Report $report)
    {
      $report->delete();
      $request->session()->flash('message', "Report {$report->id} deleted successfully");
      return redirect()->route('admin.reports.index');
    }
}
