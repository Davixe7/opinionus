@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mb-3">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          <div class="alert alert-info">Welcome, start managing your content here.</div>
          <div class="row">
            
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <a href="{{ route('admin.surveys.index') }}"><i class="material-icons">post_add</i>
                    <span>Manage surveys</span></a>
                </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <a href="{{ route('admin.banners.index') }}"><i class="material-icons">photo_filter</i>
                    <span>Manage banners</span></a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Update site logo</div>
            <div class="card-body">
              <update-logo :logo="'{{ asset('storage/brand-logo.png') }}'" />
            </div>
          </div>
        </div>
      </div>
      
      <siteconfig :siteconfig="{{ $siteconfig }}"/>
      
    </div>
  </div>
</div>
@endsection
