@extends('layouts.app')
@section('content')
  <h1>Surveys</h1>
  <div class="row">
    @if( session()->has('message') )
      <div class="col-md-12">
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
      </div>
    @endif
    @foreach($surveys as $survey)
      <div class="col-md-4 mb-3 survey-content">
        <div class="card">
          <div class="card-body">
            <h5>{{ $survey->name }}</h5>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="material-icons">language</i>
                </div>
              </div>
              <input type="text" class="form-control form-control-disabled" value="{{ route('surveys.results', ['survey'=>$survey->id]) }}" disabled>
            </div>
            
            <div class="input-group mb-2">
              <div class="input-group-append">
                <div class="input-group-text">
                  <i class="material-icons">language</i>
                </div>
              </div>
              <input type="text" class="form-control form-control-disabled" value="{{ route('surveys.vote', ['survey'=>$survey->id]) }}" disabled>
              <div class="input-group-append">
                <div class="input-group-text">
                  <a href="/surveys/{{ $survey->id }}/vote"><i class="material-icons">open_in_new</i></a>
                </div>
              </div>
            </div>
            
            <div class="actions">
              <form id="form-{{$survey->id}}" action="{{route('surveys.destroy', ['survey'=>$survey->id])}}" method="POST">
                @csrf
                @method('DELETE')
              </form>
              <button 
                  onclick="document.querySelector('#form-{{$survey->id}}').submit()" 
                  class="btn btn-link">Delete</button>
              <a href="/surveys/{{ $survey->id }}/edit" class="btn btn-link">Edit</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  
  
  <a href="{{ route('choices.deleteAll') }}" class="btn btn-danger">Delete Choices</a>
  <a href="{{ route('surveys.deleteAll') }}" class="btn btn-danger">Delete Surveys</a>
  <a href="{{ route('surveys.create') }}" class="btn btn-danger">Create Survey</a>
@endsection