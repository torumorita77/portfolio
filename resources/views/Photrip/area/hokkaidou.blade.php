@extends('layouts.app')
<title>PhoTrip</title>
<link rel="stylesheet" href="/css/app.css">
<link rel="stylesheet" href="/css/styles.css">
<script src="/js/app.js" defer></script>
@section('content')
<div class="container">
  <h1>北海道</h1>
  @foreach($hokkaidou as $post)
  <a href="/phot/{{$post->id}}">
  <img src ="/{{ str_replace('public/', 'storage/', $post->image_url) }}" width="200px" height="200px" class="mr-3 mb-3">
  </a>
  @endforeach

  <div class="d-flex justify-content-center mt-3">
    {{ $hokkaidou->links() }}
  </div>
@endsection
