@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
      <h1>Manage User surveys</h1>
      <h4>
        #{{ $user->id }}
        <a href="{{ route('admin.surveys.index', ['user'=>$user->id]) }}">
          {{ $user->email }}
        </a>
      </h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <th>Created At</th>
            <th>Name</th>
            <th>Vote URL</th>
            <th>Results URL</th>
            <th>Choices</th>
            <th>Votes</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @foreach( $surveys as $survey )
            <tr>
              <td>{{ $survey->created_at }}</td>
              <td>{{ $survey->name }}</td>
              <td>
                <a href="{{ route('surveys.vote', ['slug'=>$survey->slug]) }}">
                  {{ route('surveys.vote', ['slug'=>$survey->slug]) }}
                </a>
              </td>
              <td>
                <a href="{{ route('surveys.results', ['slug'=>$survey->slug]) }}">
                  {{ route('surveys.results', ['slug'=>$survey->slug]) }}
                </a>
              </td>
              <td>{{ $survey->choices->count() }}</td>
              <td>{{ $survey->votes_count }}</td>
              <td>
                <form id="delete-survey-{{ $survey->id }}-form"
                  action="{{ route('admin.surveys', ['survey'=>$survey->id]) }}"
                  method="POST">
                  @csrf
                  @method('DELETE')
                </form>
                <button type="button" class="btn btn-link"
                  onclick="
                    if( window.confirm('Are you sure you want to delete the survey?') ){
                      document.querySelector('#delete-survey-{{ $survey->id }}-form')
                    }
                  ">
                  <i class="material-icons">delete</i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
