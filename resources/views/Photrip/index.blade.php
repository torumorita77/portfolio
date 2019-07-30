@extends('layouts.app')
<title>PhoTrip</title>
<!-- <link rel="stylesheet" href="/css/app.css"> -->
<link rel="stylesheet" href="/css/styles.css">
<script src="/js/app.js" defer></script>
@section('content')
<div class="container bg-white">
  <!-- {{str_replace('public/', 'storage/', $posts[1]->image_url)}} -->
  <div class="mato">
    <a href="/phot/{{$mainpost->id}}"><img src ="/{{ str_replace('public/', 'storage/', $mainpost->image_url) }}" width="400px" height="300px"class="img-arrange mt-3"></a>
  </div>
<h1 class="mt-4 mb-4">カテゴリー</h1>
<!-- カテゴリー毎の記事のループ処理 -->
@foreach($category_array as $key => $value)
<div class="category mt-3">
  <a href="/category/{{$key}}" class="all mr-1  btn btn-sm btn-primary">一覧→</a>
    <h2 class="">{{$value}}</h2>
      <ul class="popo{{$key}} phott mb-0">
        <div class="col_3">
        @if($loop->iteration == $key)
          @foreach(${"category".$key} as $post)
            @if($post->category_id == $key)
            <div>
              <li class="">
                <a href="/phot/{{$post->id}}"><img src ="/{{ str_replace('public/', 'storage/', $post->image_url) }}" class="img-arrange"></a>
              </li>
            </div>
            @endif
          @endforeach
        @endif
        </div>
      </ul>
      <p class="btn btn-primary momo{{$key}} ">もっと見る</p>
</div>
@endforeach
<!-- エリア記事 -->
<h1 class="mt-4 mb-4">エリア</h1>
  <div class="container">
  <div class="row">
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/1">北海道</a></div>
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/2">東北</a></div>
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/3">関東</a></div>
  </div>
  <div class="row">
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/4">中部</a></div>
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/5">近畿</a></div>
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/6">中国</a></div>
  </div>
  <div class="row">
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/7">四国</a></div>
      <div class="col-11 col-sm-3 col-md-3 mb-2 area"><a href="area/8">九州・沖縄</a></div>
      <div class="col-11 col-sm-3 col-md-3 mb-2 area-point"></div>
  </div>
  </div>
</div>
@endsection
