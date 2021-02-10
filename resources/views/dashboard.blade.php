@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if( $banner )
      <div class="dashboard-featured-info-wrap">
        <a href="{{ $banner->url }}">
          <img src="{{ $banner->picture_url }}" alt="{{ strtolower($banner->name) }}">
        </a>
      </div>
      @endif
      
      <div class="card mb-3">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          <div class="alert alert-info">Welcome, start managing your content here.</div>
          <div class="row">
            
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <a href="/dashboard/surveys"><i class="material-icons">post_add</i>
                    <span>Manage surveys</span></a>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <a href="/dashboard/banners"><i class="material-icons">photo_filter</i>
                    <span>Manage banners</span></a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>      
    </div>
  </div>
</div>
@endsection
