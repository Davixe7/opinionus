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

<div id="results">
  @if( $admin_banner )
  <div class="banner admin-banner">
    <img src="{{ $admin_banner->picture_url }}" alt="">
  </div>
  @endif

  <div class="results-main">
    <h1 class="text-primary">Survey Results</h1>
    <article>
      <div class="results-header">
        <h1>{{ $survey->name }}</h1>
        @if( isset($choice) )
        <div class="vote-confirmation">
          <div class="sup">Your vote was:</div>
          <div class="choice-name">{{ $choice->name }}</div>
        </div>
        @endif
      </div>
      <div class="survey-result-choices">
      @if( $choice )
        <div class="survey-results-choice selected">
          <div class="picture-wrap">
            <img src="{{ asset($choice->small_picture) }}" alt="{{ $choice->name }}">
          </div>
          <div class="details">
            <div class="name">{{ $choice->name }}</div>
            <div class="progress-bar">
              <div style="width:{{ $choice->votes_percent }}%" class="progress">{{ $choice->votes_percent }}%</div>
            </div>
            <div class="votes-count">
              {{ $choice->votes_count }}
            </div>
          </div>
        </div>
      @endif
      @foreach( $survey->choices as $c )
        <div class="survey-results-choice"
          class="@if($c->name == 'Cocacola') first @endif">
          <div class="picture-wrap">
            <img src="{{ asset($c->picture) }}" alt="#">
          </div>
          <div class="details">
            <div class="name">{{ $c->name }}</div>
            <div class="progress-bar">
              <div style="width:{{ $c->votes_percent }}%" class="progress">{{ $c->votes_percent }}%</div>
            </div>
            <div class="votes-count">
              {{ $c->votes_count }}
            </div>
          </div>
        </div>
      @endforeach
      </div>

      <hr>

      <div class="results-total">
        <div class="legend">Total Votes:</div>
        <div style="width: 100%;">
          <div class="votes-count">
            {{ $survey->votes_count }}
          </div>
          <div class="dates">
            <div>{{ $survey->created_date }}</div>
            <div>{{ $survey->days_left }}</div>
          </div>
        </div>
      </div>

      @if($banner)
      <div class="banner" style="margin-top: 15px;">
        <img src="{{ $banner->picture_url }}" alt="">
      </div>
      @endif

      @include('partials.sharer', ['survey'=>$survey,'mode'=>'results', 'horizontal'=>true])
    </article>
  </div>
</div>
@endsection
