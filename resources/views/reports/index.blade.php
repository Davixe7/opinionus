@extends('layouts.app')
@section('content')
<div class="container">
  
  @if( session()->has('message') )
    <div class="alert alert-success align-items-center d-flex">
      {{ session('message') }}
      <i class="ml-auto material-icons">check</i>
    </div>
  @endif
  
  <div class="row">
    <div class="col-md-12">
      <div class="card" style="border-radius: 5px; border: none; box-shadow: 0 1px 12px 1px rgba(0,0,0,.2);">
        <div class="card-body">
          <h1>All reports</h1>
          @if( isset( $reports ) && $reports->count() )
          <table class="table table-responsive">
            <thead>
              <th>ID</th>
              <th>Created at</th>
              <th>Survey ID</th>
              <th>Subject</th>
              <th>Description</th>
              <th>Actions</th>
            </thead>
            <tbody>
              @foreach( $reports as $report )
              <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->created_at }}</td>
                <td><a href="{{route('admin.surveys.edit', ['survey'=>$report->survey->id])}}">{{ $report->survey->id }}</a></td>
                <td>{{ $report->subject }}</td>
                <td>{{ $report->description }}</td>
                <td>
                  <form id="form-{{$report->id}}" action="{{route('admin.reports.destroy', ['report'=>$report->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                  </form>
                  <div class="btn-group">
                    <a href="#" class="btn btn-secondary btn-link" title="mark as processed">
                      <i class="material-icons">check</i>
                    </a>
                    <a 
                      onclick=" confirm('Are you sure you want to delete the report?') ? document.querySelector('#form-{{$report->id}}').submit() : '' " 
                      href="#" class="btn btn-secondary btn-link" title="delete">
                      <i class="material-icons">delete</i>
                    </a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <div class="alert alert-info d-flex align-items-center">
              <i class="material-icons mr-3">info</i> 
              No reports have been registered yet
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection