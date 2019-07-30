<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Log;

class PhotripController extends Controller
{
    public function index(){
      $category_array = config('const.CATEGORY');
      $category1 = Post::where('category_id', 1)->latest()->take(6)->get();
      $category2 = Post::where('category_id', 2)->latest()->take(6)->get();
      $category3 = Post::where('category_id', 3)->latest()->take(6)->get();
      $category4 = Post::where('category_id', 4)->latest()->take(6)->get();
      $category5 = Post::where('category_id', 5)->latest()->take(6)->get();
      $category6 = Post::where('category_id', 6)->latest()->take(6)->get();
      $category7 = Post::where('category_id', 7)->latest()->take(6)->get();
      $category8 = Post::where('category_id', 8)->latest()->take(6)->get();
      $posts = Post::latest()->get();
      $mainpost = Post::inRandomOrder()->first();
      $hokkaidou = Post::where('todofuken_id', 1)->get();
      $touhoku = Post::whereBetween('todofuken_id', [2,7])->get();
      $kantou = Post::whereBetween('todofuken_id', [8,14])->get();
      $tyubu = Post::whereBetween('todofuken_id', [15,23])->get();
      $kinki = Post::whereBetween('todofuken_id', [24,30])->get();
      $tyugoku = Post::whereBetween('todofuken_id', [31,35])->get();
      $shikoku = Post::whereBetween('todofuken_id', [36,39])->get();
      $kyusyu = Post::whereBetween('todofuken_id', [40,47])->get();
      // $address = \DB::table('ad_address')->where('city_id', 1102)->distinct()->select('city_name')->get();
      $ken_array = config('const.KEN');
      //市区町村を取得
      // $city_code = [];
      // foreach ($ken_array as $key => $value) {}
      // $req =  'http://www.land.mlit.go.jp/webland/api/CitySearch?area=10';
      // $json = file_get_contents($req);
      // $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
      // $addcode = json_decode($json, true);'addcode',
      // $city_code += array($key =>array("pref-code" => $key , "pref-name" => $value ,'data' => $addcode['data']));
      return view('Photrip.index',compact('category_array','posts','ken_array',
      'mainpost','category1','category2','category3','category4','category5','category6','category7','category8',
      'hokkaidou','touhoku','kantou','tyubu','kinki','tyugoku','shikoku','kyusyu'
    ));
    }
    //カテゴリーページ
    public function category($id){
      // $posts = Post::latest()->get();
      // $posts = Post::find($id);
      $posts = Post::where('category_id', $id)->paginate(15);
      $category_array = config('const.CATEGORY');
      return view('Photrip.category',compact('category_array','posts','id'));
    }
    //画像登録
    public function showCreateForm(){
      $category_array = config('const.CATEGORY');
      $ken_array = config('const.KEN');
      return view('Posts.create',compact('category_array','ken_array'));
    }
    public function ajax_get_json(Request $request) {
        $todofukenId = $request->input('todofuken_id');
        $req =  'http://www.land.mlit.go.jp/webland/api/CitySearch?area='.$todofukenId;
        $json = file_get_contents($req);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $addcode = json_decode($json, true);

        /* get:json */
            $json = $addcode["data"];
            return $json;
    }
    public function create(Request $request){
       $this->validate($request, [
        'title' => 'required',
        'content' => 'required',
        'image_url' => 'required',
        'category_id' => 'required',
            ]);
       // Postモデルのインスタンスを作成する
       $post = new Post();
       // タイトル
       $post->title = $request->title;
       //コンテンツ
       $post->content = $request->content;
       //画像アップロード
       $time = date("Ymdhis");
       $post->image_url = $request->image_url->storeAs('public/post_images', $time.'_'.Auth::user()->id . '.jpg');
       //登録ユーザーからidを取得
       $post->user_id = Auth::user()->id;
       //カテゴリー
       $post->category_id = $request->category_id;
       //都道府県データ
       $post->todofuken_id = $request->todofuken_id;
       //市町村データ
       $post->city_id = $request->city_id;
       // インスタンスの状態をデータベースに書き込む
       $post->save();
       //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
       return redirect()->route('posts.detail', [
           'id' => $post->id,
      ]);
    }
     //詳細ページ
     public function detail(Post $post){
       $category_array = config('const.CATEGORY');
       return view('Posts.detail', [
          'image_url' => str_replace('public/', 'storage/', $post->image_url),
          'title' => $post->title,
          'content' => $post->content,
          'user_id' => $post->user_id,
          'id' => $post->id,
          'category_id' => $post->category_id,
      ],compact('category_array'));
     }
     //編集ページ
     public function edit(Post $post) {
       $category_array = config('const.CATEGORY');
       return view('Posts.edit',compact('category_array','post',));
     }
     public function update(Request $request,Post $post) {
       $this->validate($request, [
        'title' => 'required|min:3',
        'cntent' => 'required',
        'image_url' => 'required',
        'category_id' => 'required',
            ]);
       $post->title = $request->title;
       $post->content = $request->content;
       $post->category_id = $request->category_id;
       $post->save();
       return redirect()->route('posts.detail', [
           'id' => $post->id,
      ]);
     }
     //画像ページ
     public function phot(Post $post){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       return view('Photrip.phot', [
          'image_url' => str_replace('public/', 'storage/', $post->image_url),
          'title' => $post->title,
          'content' => $post->content,
          'user_id' => $post->user_id,
          'id' => $post->id,
          'category_id' => $post->category_id,
          'todofuken_id' => $post->todofuken_id,
      ],compact('category_array','ken_array'));
     }
     //削除機能
     public function delete (Request $request){
       Post::find($request->id)->delete();
       return redirect('/home');
     }
     public function hokkaidou(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $hokkaidou = Post::where('todofuken_id', 1)->paginate(15);
       return view('Photrip.area.hokkaidou',compact('category_array','ken_array','hokkaidou',));
     }
     public function touhoku(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $touhoku = Post::whereBetween('todofuken_id', [2,7])->paginate(15);
       return view('Photrip.area.touhoku',compact('category_array','ken_array','touhoku',));
     }
     public function kantou(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $kantou = Post::whereBetween('todofuken_id', [8,14])->paginate(15);
       return view('Photrip.area.kantou',compact('category_array','ken_array','kantou',));
     }
     public function tyubu(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $tyubu = Post::whereBetween('todofuken_id', [15,23])->paginate(15);
       return view('Photrip.area.tyubu',compact('category_array','ken_array','tyubu',));
     }
     public function kinki(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $kinki = Post::whereBetween('todofuken_id', [24,30])->paginate(15);
       return view('Photrip.area.kinki',compact('category_array','ken_array','kinki',));
     }
     public function tyugoku(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $tyugoku = Post::whereBetween('todofuken_id', [31,35])->paginate(15);
       return view('Photrip.area.tyugoku',compact('category_array','ken_array','tyugoku',));
     }
     public function shikoku(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $shikoku = Post::whereBetween('todofuken_id', [36,39])->paginate(15);
       return view('Photrip.area.shikoku',compact('category_array','ken_array','shikoku',));
     }
     public function kyusyu(){
       $category_array = config('const.CATEGORY');
       $ken_array = config('const.KEN');
       $kyusyu = Post::whereBetween('todofuken_id', [40,47])->paginate(15);
       return view('Photrip.area.kyusyu',compact('category_array','ken_array','kyusyu',));
     }
}
