@extends('layouts.app')
@section('content')
<div class="row results-row">
  <div class="col-md-6">
    <results
      :choices="{{ json_encode( $survey->choices ) }}"
      :survey="{{ json_encode( $survey ) }}"/>
  </div>
  <div class="col-md-3 offset-md-3">
    @if( $banner )
      @if( $banner->iframe )
        {!! $banner->iframe !!}
      @elseif( $banner->image )
        <a href="{{ $banner->url }}">
          <img src="{{ str_replace('public', '/storage', $banner->image) }}" style="max-width: 100%;">
        </a>
      @endif
      <div class="text-center d-block d-sm-none">
        <i class="material-icons bounce">keyboard_arrow_down</i>
      </div>
    @endif
  </div>
</div>
@endsection
@section('footer')
<style>
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