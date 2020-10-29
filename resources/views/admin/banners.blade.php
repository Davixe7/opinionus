@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card">
    <div class="card-body">
      <h1>Manage User Banners</h1>
      <h5 style="margin-bottom: 20px;">
        #{{ $user->id }}
        <a href="/admin/users/{{ $user->id }}">
          {{ $user->email }}
        </a>
      </h5>
      <div class="table-responsive">
        <div class="form-section-title">
          See All Banners
        </div>
        <table class="table">
          <thead>
            <th>Created At</th>
            <th>Picture</th>
            <th>URL</th>
            <th>Duration</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @foreach( $banners as $banner )
            <tr>
              <td>{{ $banner->created_at }}</td>
              <td>
                <a
                  target="_blank"
                  href="{{ asset( str_replace('public','storage',$banner->image) ) }}">
                  <i class="material-icons">photo</i>
                </a>
              </td>
              <td>{{ $banner->url }}</td>
              <td>{{ $banner->duration }}</td>
              <td>
                <form id="delete-banner-{{ $banner->id }}-form"
                  action="/admin/banners/{{ $banner->id }}"
                  method="POST">
                  @csrf
                  @method('DELETE')
                </form>
                <button type="button" class="btn btn-link"
                  onclick="
                    if( window.confirm( 'Are you sure you want to delete the banner?' ) ){
                      document.querySelector('#delete-banner-{{ $banner->id }}-form').submit()
                    }
                  ">
                  <i class="material-icons">delete</i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
