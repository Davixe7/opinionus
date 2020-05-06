@extends('layouts.app')
@section('head')
<meta property="og:image" content="{{ url(str_replace('public', '/storage', $survey->choices->first()->image)) }}" />
<meta property="og:title" content="{{ $survey->name }}">
@endsection
@section('content')
  <h1>{{ $survey->name }}</h1>
  <vote :survey="{{ json_encode( $survey ) }}"/>
@endsection