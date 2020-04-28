@extends('layouts.app')
@section('content')
  <h1>Update survey</h1>
  <create-survey :survey="{{ json_encode($survey) }}"/>
@endsection