@extends('layouts.app')
@section('content')
  <results :choices="{{ json_encode( $survey->choices ) }}" :survey="{{ json_encode( $survey ) }}" :banner="{{json_encode($banner)}}"/>
@endsection
@section('footer')
<style>.atss-left {display: none !important;}</style>
@endsection