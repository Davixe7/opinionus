@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="col-md-9">
      @if( $surveys && $surveys->count() < 1 )
        <div class="alert alert-info">Theres no surveys to show</div>
      @else
        <surveys :surveys="{{ json_encode( $surveys ) }}">
      @endif
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