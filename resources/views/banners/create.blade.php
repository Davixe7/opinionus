@extends('layouts.app')
@section('content')
  <h1>Create Banner Ad</h1>
  <div class="row">
    <div class="col-md-5 mx-auto">
      <div class="card mb-3">
        <div class="card-body">
          <form action="{{ route('banners.store') }}" method="POST">
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
        @include('banners.table')
      </div>
    </div>
  </div>
@endsection