@extends('layouts.app')
@section('content')
  <h1>Choices</h1>
  <choices :choices="{{ json_encode($choices) }}"/>
  <a href="{{ route('choices.deleteAll') }}" class="btn btn-danger">Delete Choices</a>
@endsection