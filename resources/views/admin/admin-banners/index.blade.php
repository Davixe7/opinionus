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
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <form action="{{ route('admin.admin-banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" required>
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
              <div class="form-check form-check-inline" onclick="document.querySelector('#iframe-input').classList.remove('d-none')">
                <input class="form-check-input" type="radio" name="type" id="type-radio1" value="results" checked>
                <label class="form-check-label" for="type-radio1">Results</label>
              </div>
              <div class="form-check form-check-inline" onclick="document.querySelector('#iframe-input').classList.add('d-none')">
                <input class="form-check-input" type="radio" name="type" id="type-radio2" value="dashboard">
                <label class="form-check-label" for="type-radio2">Dashboard</label>
              </div>
            </div>
            <div class="form-group" id="iframe-input">
              <label for="iframe">iFrame</label>
              <textarea name="iframe" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group form-row">
              <label class="col" for="duration">Duration</label>
              <time-picker class="col" :selector="'#timepicker2'"/>
            </div>

            <input type="hidden" name="duration" id="timepicker2" value="3600" required>

            <button type="submit" class="btn btn-primary">Save Banner</button>
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
    </div>
  </div>
@endsection
