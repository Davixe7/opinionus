@extends('layouts.app')
@section('head')
<meta property="og:image" content="{{ url(str_replace('public', '/storage', $survey->choices->first()->image)) }}" />
<meta property="og:title" content="{{ $survey->name }}">
<meta property="og:description" content="Come take this survey now" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ $survey->name }}" />
<meta name="twitter:description" content="Come take this survey now" />
<meta name="twitter:image:src" content="{{ url(str_replace('public', '/storage', $survey->choices->first()->image)) }}" />
@endsection
@section('content')
  <div class="row">
    <div class="col"><h1>{{ $survey->name }}</h1></div>
    <div class="col text-right">
      
      <a href="{{ route('reports.create', ['survey_id'=>$survey->id]) }}">Report this survey</a>
      
    </div>
  </div>
  <vote :survey="{{ json_encode( $survey ) }}"/>
@endsection