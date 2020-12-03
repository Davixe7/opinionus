@extends('layouts.public')
@section('head')
<style>
  .container {
    max-width: 420px;
    margin: 0 auto;
  }
</style>
@endsection
@section('content')
<h1 style="margin-bottom: 10px;">Thank you!</h1>
<p class="voted-help-text">
  Your vote was submit successfully For:<br>
  <span class="choice-name">{{ $choice->name }}</span>
</p>
<vote-choice :voted="true" :choice="{{ json_encode( $choice ) }}" class="selected"></vote-choice>
<span class="voted-tag">VOTED</span>
<div class="vote-page-actions">
  <a class="btn" href="{{ route('surveys.index') }}">Take another</a>
  <a class="btn" href="{{ route('surveys.results', ['slug'=>$slug]) }}/?choice_id={{$choice->id}}">Show results</a>
</div>
@include('partials.sharer', ['survey'=>$choice->survey, 'mode'=>'vote'])
@endsection
