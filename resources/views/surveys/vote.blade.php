@extends('layouts.app')
@section('content')
  <h1>{{ $survey->name }}</h1>
  <vote :choices="{{ json_encode( $survey->choices ) }}"/>
@endsection