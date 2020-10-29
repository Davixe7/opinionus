@extends('layouts.app')
@section('content')
<div class="container">

  @if( session()->has('message') )
    <div class="alert alert-success align-items-center d-flex">
      {{ session('message') }}
      <i class="ml-auto material-icons">check</i>
    </div>
  @endif

  <div class="row">
    <div class="col-md-12">
      <div class="card" style="border-radius: 5px; border: none; box-shadow: 0 1px 12px 1px rgba(0,0,0,.2);">
        <div class="card-body">
          <h1>All reports</h1>
          @if( isset( $surveys ) && $surveys->count() )
          <div class="table-responsive">
            <table class="table w-100">
              <thead>
                <th>Survey ID</th>
                <th>Survey Name</th>
                <th>Reports</th>
                <th class="text-right">Actions</th>
              </thead>
              <tbody>
                @foreach( $surveys as $survey )
                <tr>
                  <td>{{ $survey->id }}</td>
                  <td>
                    <a href="/surveys/{{$survey->slug}}/vote" title="{{ $survey->name }}">{{ $survey->name }}</a>
                  </td>
                  <td>{{ $survey->reports_count }}</td>
                  <td class="text-right">
                    <form id="form-{{$survey->id}}"
                      method="POST"
                      action="{{route('admin.surveys.destroy', [
                        'survey'=>$survey->id
                      ])}}">
                      @csrf
                      @method('DELETE')
                    </form>
                    <form id="delete-user-form-{{$survey->id}}"
                      method="POST"
                      action="{{route('admin.users.destroy', [
                        'user' => $survey->user_id
                      ])}}">
                      @csrf
                      @method('DELETE')
                    </form>
                    <form id="ignore-form-{{$survey->id}}"
                      method="POST"
                      action="{{route('admin.reports.ignore', [
                        'survey' => $survey->id
                      ])}}">
                      @csrf
                      @method('DELETE')
                    </form>
                    <div class="btn-group">
                      <a href="#"
                        onclick="confirm('Are you sure you want to remove all reports?') ? document.querySelector('#ignore-form-{{$survey->id}}').submit() : '' "
                        class="btn btn-secondary btn-link" title="ignore">
                        Ignore
                      </a>
                      <a
                        href="#"
                        onclick="confirm('Are you sure you want to delete the survey?') ? document.querySelector('#form-{{$survey->id}}').submit() : '' "
                        class="btn btn-secondary btn-link"
                        title="delete">
                        Delete survey
                      </a>
                      <a
                        href="#"
                        onclick=" confirm('Are you sure you want to delete the user and all his data?') ? document.querySelector('#delete-user-form-{{$survey->id}}').submit() : '' "
                        class="btn btn-secondary btn-link"
                        title="delete">
                        Delete user
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
            <div class="alert alert-info d-flex align-items-center">
              <i class="material-icons mr-3">info</i>
              No reports have been registered yet
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
