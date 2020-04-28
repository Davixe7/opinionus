@extends('layouts.app')
@section('content')
  <h1>{{ $survey->name }}</h1>
  <vote :survey="{{ json_encode( $survey ) }}"/>
@endsection