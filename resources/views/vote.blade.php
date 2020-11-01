@extends('layouts.public')
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
@include('partials.sharer', ['survey'=>$survey,'mode'=>'vote'])
<voting :survey="{{ json_encode( $survey ) }}"></voting>
@endsection
