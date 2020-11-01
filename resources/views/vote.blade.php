@extends('layouts.public')
@section('content')
<voting :survey="{{ json_encode( $survey ) }}"></voting>
@endsection
