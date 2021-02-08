@extends('layouts.app')
@section('content')
  <h1>Update Banner Ad</h1>
  
  @if( session()->has('message') )
    <div class="alert alert-success align-items-center d-sm-none d-flex">
      {{ session('message') }}
      <i class="ml-auto material-icons">check</i>
    </div>
  @endif
  
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          @if( !empty($banner->image) )
            <div style="overflow: hidden;">
              <img src="{{ Storage::url($banner->image) }}" alt="" style="max-width: 100%;">
            </div>
          @endif
          <form action="{{ route('admin.admin-banners.update', ['banner'=>$banner->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $banner->name }}">
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <label for="url">URL</label>
              <input type="url" class="form-control" name="url" required value="{{ $banner->url }}">
            </div>
            <div class="form-group">
              <div class="form-check form-check-inline" onclick="document.querySelector('#iframe-input').classList.remove('d-none')">
                <input class="form-check-input" type="radio" name="type" id="type-radio1" value="results" @if($banner->type == 'results') checked @endif>
                <label class="form-check-label" for="type-radio1">Results</label>
              </div>
              <div class="form-check form-check-inline" onclick="document.querySelector('#iframe-input').classList.add('d-none')">
                <input class="form-check-input" type="radio" name="type" id="type-radio2" value="dashboard" @if($banner->type == 'dashboard') checked @endif>
                <label class="form-check-label" for="type-radio2">Dashboard</label>
              </div>
            </div>
            <div class="form-group @if( $banner->type == 'dashboard' ) d-none @endif" id="iframe-input">
              <label for="iframe">iFrame</label>
              <textarea name="iframe" class="form-control" rows="4">{{ $banner->iframe }}</textarea>
            </div>
            <label>Duration</label>
            <div class="form-row">
              <div class="form-group col-7">
                <time-picker :selector="'#timepicker2'" :duration="{{ $banner->duration }}"/>
              </div>
              <div class="col d-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            
            <input type="hidden" name="duration" id="timepicker2" required>
          </form>
        </div>
      </div>
    </div>
    
    <div class="col-md-7 offset-md-1">
      
      @if( session()->has('message') )
        <div class="alert alert-success align-items-center d-none d-sm-flex">
          {{ session('message') }}
          <i class="ml-auto material-icons">check</i>
        </div>
      @endif
      
      <div class="card mb-3">
        @include('admin.admin-banners.table')
      </div>
      
      <div class="text-right">
        <a href="/admin/banners" class="btn btn-primary">Create new banner</a>
      </div>
    </div>
    
  </div>
@endsection