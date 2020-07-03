@extends('layouts.app')
@section('content')
  <h1>Surveys</h1>
  @if( isset($user) && $user->id )
    <p>User: {{ $user->name }}</p>
  @endif
  <div class="row">
    @if( session()->has('message') )
      <div class="col-md-12">
        <div class="alert alert-success d-flex align-items-center">
          {{ session('message') }}
          <i class="material-icons ml-auto">check</i>
        </div>
      </div>
    @endif
    @if( $surveys && $surveys->count() )
      @foreach($surveys as $survey)
        <div class="col-md-4 mb-3 survey-content">
          <div class="card">
            <div class="card-body">
              <h5>{{ $survey->name }}</h5>
              <div class="input-group mb-2">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="material-icons">pie_chart</i>
                  </div>
                </div>
                <input
                  class="form-control form-control-disabled"
                  value="{{ route('surveys.results', ['slug'=>$survey->slug]) }}"
                  onclick=" window.location.href=event.target.value "/>
              </div>
              
              <div class="input-group mb-2">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="material-icons">how_to_vote</i>
                  </div>
                </div>
                <input
                  class="form-control form-control-disabled"
                  value="{{ route('surveys.vote', ['slug'=>$survey->slug]) }}"
                  onclick=" window.location.href=event.target.value "/>
              </div>
              
              <div class="actions">
                <form id="form-{{$survey->id}}" action="{{route('dashboard.surveys.destroy', ['survey'=>$survey->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                </form>
                <button 
                    onclick=" confirm('Are you sure you want to delete the survey?') ? document.querySelector('#form-{{$survey->id}}').submit() : '' " 
                    class="btn btn-link">Delete</button>
                <a href="/dashboard/surveys/{{ $survey->id }}/edit" class="btn btn-link">Edit</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <div class="alert alert-info">
        No surveys to show here, add a new one
      </div>
    @endif
  </div>
  
  
  <a href="{{ route('dashboard.surveys.create') }}" class="btn btn-danger fab-fixed fab">
    <i class="material-icons">add</i>
  </a>
@endsection