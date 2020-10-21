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
    <div class="col-md-6">
      <h1>Report survey</h1>
      <p>This form is used to report a poll as inappropiate.
        You are reporting the poll:
        <a href="{{ route('surveys.vote', ['slug'=>$survey->slug]) }}">{{ $survey->name }}</a>
      </p>
      <p>Please fill in the following fields</p>
      <form action="{{ route('reports.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="">Select subject</label>
          <select name="subject" id="" class="form-control">
            <option value="a">Option A</option>
            <option value="b">Option B</option>
            <option value="c">Option C</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <textarea name="description" id="description" rows="7" class="form-control" required></textarea>
        </div>
        <input type="hidden" name="survey_id" value="{{ $survey->id }}">
        <div class="form-group text-right">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
