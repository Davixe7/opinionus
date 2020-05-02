@extends('layouts.app')
@section('content')
  <h1>Survey Results</h1>
  <results :choices="{{ json_encode( $survey->choices ) }}" :survey="{{ json_encode( $survey ) }}" :banner="{{json_encode($banner)}}"/>
@endsection
@section('footer')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ea225ac6489781d"></script>
@endsection