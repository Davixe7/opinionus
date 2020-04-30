@extends('layouts.app')
@section('content')
  <h1>Create Banner Ad</h1>
  
  @if( session()->has('message') )
    <div class="alert alert-success align-items-center d-sm-none d-flex">
      {{ session('message') }}
      <i class="ml-auto material-icons">check</i>
    </div>
  @endif
  
  <div class="row">
    <div class="col-md-5 mx-auto">
      <div class="card mb-3">
        <div class="card-body">
          <form action="{{ route('admin.banners.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control">
            </div>
            <div class="form-group">
              <label for="url">URL</label>
              <input type="url" class="form-control">
            </div>
            <div class="form-group">
              <label for="iframe">iFrame</label>
              <textarea name="name" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Banner</button>
          </form>
        </div>
      </div>
      
      <div class="card mb-3">
        @if( session()->has('message') )
          <div class="alert alert-success align-items-center d-none d-sm-flex">
            {{ session('message') }}
            <i class="ml-auto material-icons">check</i>
          </div>
        @endif
        
        @include('admin.banners.table')
      </div>
    </div>
  </div>
@endsection