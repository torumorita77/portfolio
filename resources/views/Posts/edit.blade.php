@extends('layouts.app')
@section('content')
<div class="container">
<form method="post" action="{{ url('/post',$post->id) }}">
  {{ csrf_field() }}
  {{ method_field('patch')}}
  <p>
    <input type="text" name="title" placeholder="enter title" value="{{ old('title',$post->title) }}">
    @if ($errors->has('title'))
    <span class="error">{{ $errors->first('title') }}</span>
    @endif
  </p>
  <p>
    <textarea name="content" placeholder="enter content">{{ old('content',$post->content) }}</textarea>
    @if ($errors->has('content'))
    <span class="error">{{ $errors->first('content') }}</span>
    @endif
  </p>
  <div class="form-category">
    <label for="category" class="form-category">カテゴリー</label>
    <select name="category_id">
      <option value="">選択してください</option>
      <option value="1">山</option>
      <option value="2">海</option>
      <option value="3">花、植物</option>
      <option value="4">寺社仏閣</option>
      <option value="5">城、城跡</option>
      <option value="6">遺産</option>
      <option value="7">動物、生き物</option>
      <option value="8">料理、食べ物</option>
    </select>
    @if ($errors->has('category_id'))
    <span class="error">{{ $errors->first('category_id') }}</span>
    @endif
  <p>
    <input type="submit" value="完了">
  </p>
</form>
</div>
@endsection
