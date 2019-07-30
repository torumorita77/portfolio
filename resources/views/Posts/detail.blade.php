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
<div>
<a href="{{ url('/post') }}"><span class="btn btn-primary btn-sm mb-2">画像登録</span></a>
</div>
<div>
<a href="/post/{{$id}}/edit" class="edit"><span class="btn btn-primary btn-sm mb-2">編集</span></a>
</div>
<div>
<form method="post" action="/post/delete/{{$id}}">
@csrf
<input type="submit" value="削除" class="btn btn-danger btn-sm mb-2" onclick='return confirm("本当に削除して大丈夫ですか？")';>
</form>
</div>
<div>
<a href="/home"><span class="btn btn-primary btn-sm mb-2">マイページ</span></a>
</div>
</div>
</div>
</div>
@endsection
