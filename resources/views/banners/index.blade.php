@extends('layouts.app')
@section('content')
  <h1>Create Banner Ad</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label for="image">Image</label>
              <input type="file" class="form-control" name="image" required>
            </div>
            <div class="form-group">
              <label for="url">URL</label>
              <input type="url" class="form-control" name="url" required>
            </div>
            <div class="form-group">
              <label for="iframe">iFrame</label>
              <textarea name="iframe" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Banner</button>
          </form>
        </div>
      </div>
    </div>
    
    <div class="col-md-7 offset-md-1">
      
      @if( session()->has('message') )
        <div class="alert alert-success d-flex align-items-center">
          {{ session('message') }}
          <i class="ml-auto material-icons">check</i>
        </div>
      @endif
      
      <div class="card mb-3">
        @include('banners.table')
      </div>
    </div>
  </div>
@endsection