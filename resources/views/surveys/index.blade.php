@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="col-md-9">
      
      <div class="row">
        <div class="col-md-6">
          <h1>Select a survey</h1>
          <span class="subheading">Showing results: 37</span>
        </div>
        <div class="col-md-6 d-flex align-items-center">
          <input type="search" class="form-control" style="border-radius: 30px;">
        </div>
      </div>
      
      <div class="row">
        @foreach( $surveys as $survey )
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body pb-0">
                <survey-content :survey="{{ json_encode($survey) }}"></survey-content>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-3 ads-column">
      <div class="card ad-banner">
        <div class="card-body">
          <h4>Best choices</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus sunt, animi asperiores, error obcaecati perferendis quisquam </p>
        </div>
      </div>
      <div class="card ad-banner">
        <div class="card-body">
          <h4>Best choices</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus sunt, animi asperiores, error obcaecati perferendis quisquam </p>
        </div>
      </div>
      <div class="card ad-banner">
        <div class="card-body">
          <h4>Cool ad here</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus sunt, animi asperiores, error obcaecati perferendis quisquam </p>
        </div>
      </div>
    </div>
  </div>
@endsection