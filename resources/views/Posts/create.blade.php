@extends('layouts.app')
<script type="text/javascript">
function getTableData() {
	//プルダウンで選択されたValueを取得
	var selectVal = $("#todofuken_id").val();
	//getJSONで、別途用意している処理用PHPに必要な値を投げて受け取ります
	$.getJSON("/create/get_json"
			, {"todofuken_id": selectVal }			//team_idに取得したValue値を投げます
			, function (data, status) {
				var cityList = $("#city_id");	//連動するプルダウンのID
				cityList.children().remove();	//子要素は毎回全て削除します(初期化)
				for (i in data) {
					var row = data[i];
					//alert(row['id']);
					//取得したデータをAppendで1行ずつ追加
					cityList.append(new Option(row['name'], row['id']));
				}
			 }
	 );
}
</script>
@section('content')
<div class="container">
<form method="post" action="{{ route('posts.create') }}" enctype="multipart/form-data">
 @csrf
       <div class="form">
           <div class="form-image_url">
             <input type="file" name="image_url">
           </div>

           <div class="form-title">
             <label for="title">タイトル</label>
             <input class="" name="title" value="{{ old('title') }}">
             {{ $errors->first('title') }}
           </div>

           <div class="form-content">
             <label for="content" class="form-content">内容</label>
             <textarea class="" name="content" cols="50" rows="10">{{ old('content') }}</textarea>
           </div>

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
            </div>

            <div class="form-todofuken">
             <label for="todofuken" class="form-todofuken">エリア</label>
             <select id="todofuken_id" name="todofuken_id" onchange="getTableData()">
               <option value="">--都道府県を選択してください--</option>
               @foreach ($ken_array as $key => $value)
             	<option value={{$key}}>{{$value}}</option>
               @endforeach
             </select>
             <select id="city_id" name="city_id">
             	<option value="">--市町村を選択してください--</option>
             </select>
            </div>

           <div class="form-submit mt-2">
             <button type="submit">登録する</button>
           </div>
       </div>
</form>
</div>
@endsection
