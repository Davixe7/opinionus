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
<div class="row results-row">
  <div class="col-md-6">
    <results
      :choices="{{ json_encode( $survey->choices ) }}"
      :survey="{{ json_encode( $survey ) }}">
    </results>
    @if( $banner && $banner->image )
    <a class="d-block d-sm-none" href="{{ $banner->url }}">
      <img src="{{ str_replace('public', '/storage', $banner->image) }}" style="max-width: 100%;">
    </a>
    @endif
    @if( $admin_banner && $admin_banner->iframe )
      <div class="d-block d-sm-none">{!! $admin_banner->iframe !!}</div>
    @endif
  </div>
  <div class="col-md-4 offset-md-2">
    @if( $admin_banner && $admin_banner->image )
      <a href="{{ $admin_banner->url }}">
        <img src="{{ str_replace('public', '/storage', $admin_banner->image) }}" style="max-width: 100%;">
      </a>
      <div class="text-center d-block d-sm-none">
        <i class="material-icons bounce">keyboard_arrow_down</i>
      </div>
    @endif
    @if( $banner && $banner->image )
    <a class="d-none d-sm-block" href="{{ $banner->url }}">
      <img src="{{ str_replace('public', '/storage', $banner->image) }}" style="max-width: 100%;">
    </a>
    @endif
    @if( $admin_banner && $admin_banner->iframe )
      <div class="d-none d-sm-block">{!! $admin_banner->iframe !!}</div>
    @endif
  </div>
</div>
@endsection

@section('footer')
<style>
  .bounce {
    animation: bounce .5s infinite alternate linear;
    font-size: 2.5em;
  }
  @keyframes bounce {
    from {transform: translateY(-7px);}
    to {transform: translateY(7px);}
  }
  .atss-left {display: none !important;}
  .results-row {
    flex-direction: column-reverse;
  }
  @media(min-width: 576px){
    .results-row {
      flex-direction: row;
    }
    .results-row .col-md-3 {
      height: auto;
    }
  }
</style>
@endsection
