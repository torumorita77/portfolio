<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  public function showCreateForm(){
    return view('Posts.create');
  }
  public function create(Request $request){
     // Postモデルのインスタンスを作成する
     $post = new Post();
     // タイトル
     $post->title = $request->title;
     //コンテンツ
     $post->content = $request->content;
     //登録ユーザーからidを取得
     $post->user_id = Auth::user()->id;
     // インスタンスの状態をデータベースに書き込む
     $post->save();
     //「投稿する」をクリックしたら投稿情報表示ページへリダイレクト
     return redirect()->route('posts.detail', [
         'id' => $post->id,
     ]);
   }
   /**
   * 詳細ページ
   */
   public function detail(Post $post){
    return view('posts/detail', [
        'title' => $post->title,
        'content' => $post->content,
        'user_id' => $post->user_id,
    ]);
   }
}
