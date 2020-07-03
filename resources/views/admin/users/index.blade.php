@extends('layouts.app')
@section('content')
<div class="container">
<div class="card" style="border-radius: 5px; box-shadow: 0 1px 12px 1px rgba(0,0,0,.2);">
  <div class="card-body">
    <h1>Users management</h1>
    <users-table :data="{{ json_encode( $users ) }}"/>
  </div>
</div>
</div>
@endsection