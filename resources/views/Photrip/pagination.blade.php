@extends('layouts.app')
<title>PhoTrip</title>
<link rel="stylesheet" href="/css/app.css">
<link rel="stylesheet" href="/css/styles.css">
<script src="/js/app.js" defer></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
function getTableData() {
	//プルダウンで選択されたValueを取得
	var selectVal = $("#todofuken_id").val();
	//getJSONで、別途用意している処理用PHPに必要な値を投げて受け取ります
	$.getJSON("/paginate/get_json"
			, {"todofuken_id": selectVal }			//team_idに取得したValue値を投げます
			, function (data, status) {
				var playerList = $("#player_id");	//連動するプルダウンのID
				playerList.children().remove();	//子要素は毎回全て削除します(初期化)
				for (i in data) {
					var row = data[i];
					//alert(row['id']);
					//取得したデータをAppendで1行ずつ追加
					playerList.append(new Option(row['name'], row['id']));
				}
			 }
	 );
}
</script>
@section('content')
<select id="todofuken_id" name="todofuken_id" onchange="getTableData()">
  <option value="">--都道府県を選択してください--</option>
  @foreach ($ken_array as $key => $value)
	<option value={{$key}}>{{$value}}</option>
  @endforeach
</select>
<select id="player_id" name="player_id">
	<option value="">--市町村を選択してください--</option>
</select>
@endsection
