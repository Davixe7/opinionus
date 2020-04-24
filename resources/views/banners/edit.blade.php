@extends('layouts.app')
@section('content')
  <h1>Update Banner Ad</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          @if( !empty($banner->image) )
            <div style="height: 300px; overflow: hidden;">
              <img src="{{ Storage::url($banner->image) }}" alt="" style="max-width: 100%;">
            </div>
          @endif
          <form action="{{ route('banners.update', ['banner'=>$banner->id]) }}" method="POST" enctype="multipart/form-data">
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
              <label for="iframe">iFrame</label>
              <textarea name="iframe" class="form-control" rows="4">{{ $banner->iframe }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
    
    <div class="col-md-7 offset-md-1">
      
      @if( session()->has('message') )
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
      @endif
      
      <div class="card mb-3">
        @include('banners.table')
      </div>
    </div>
    
  </div>
@endsection