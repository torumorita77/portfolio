@extends('layouts.app')
<title>PhoTrip</title>
<link rel="stylesheet" href="/css/app.css">
<link rel="stylesheet" href="/css/styles.css">
<script src="/js/app.js" defer></script>
@section('content')
<div class="container">
  <h1>{{$category_array[$id]}}</h1>
  <div class="col_3">
  @foreach($posts as $post)
  <div>
  <a href="/phot/{{$post->id}}">
  <img src ="/{{ str_replace('public/', 'storage/', $post->image_url) }}" class="img-arrange">
  </a>
  </div>
  @endforeach
  </div>
  <div class="d-flex justify-content-center mt-3">
    {{ $posts->links() }}
  </div>
@endsection
