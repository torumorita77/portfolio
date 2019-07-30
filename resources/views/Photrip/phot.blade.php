@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-sm-12 col-md-7 det">
@if ($image_url)
<p><img src ="/{{ $image_url }}" class="img-arrange"></p>
@endif
</div>
<div class="col-sm-12 col-md-5 mt-2">
<p>タイトル：{{ $title }}</p>
<p>詳細内容：{{ $content }}</p>
<p>カテゴリー：{{$category_array[$category_id]}}</p>
@if ($todofuken_id != 0)
<p>エリア：{{$ken_array[sprintf('%02d', $todofuken_id)]}}</p>
@endif
<div><a href="/"><span class="btn btn-primary mb-2">HOME</span></a><div>
<div><a href="/category/{{$category_id}}"><span class="btn btn-primary mb-2">カテゴリーへ</span></a><div>
</div>
@endsection
