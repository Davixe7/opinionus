@extends('layouts.app')
@section('content')
<div class="container">
<h1>Users management</h1>
<users-table :data="{{ json_encode( $users ) }}"/>
</div>
@endsection