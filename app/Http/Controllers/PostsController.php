<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;

class PostsController extends Controller
{
    //
    public function index(){
        // $posts = Post::get(); //全ての投稿を取得
        // return view('posts.index', ['posts'=>$posts]);
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();
        // userモデルとリレーションする
        return view('posts.index', ['posts' => $posts]);
    }

    public function create(Request $request)
    {
        // $post = new Post;
        // $post->content =$request->content;
        // $post->save();

        // バリデーション
        $request->validate([
            'post' => 'required|string|min:1|max:150',
        ]);

        $user_id = Auth::id();
        $post = $request->input('post');

        Post::create([
            'user_id' => $user_id,
            'post' => $post,
        ]);
        return redirect('top');
    }

   // 編集機能
    public function update(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'post' => 'required|string|max:150',
        ]);
        // 指定されたIDの投稿を取得
        // $post = Post::findOrFail($id);
        // // 投稿が存在し、現在のユーザーがその投稿の作成者である場合のみ編集ページを表示
        // if ($post && $post->user_id == Auth::id()) {
        //     return view('posts.update', ['post' => $post]);
        // }
        $postId = $request->input('id');
        // dd($postId);
        // $post = Post::findOrFail($validated['id']);
        $post = Post::findOrFail($postId);
        // if ($post && $post->user_id == Auth::id()) {
        if ($post->user_id == Auth::id()) {
            $post->post = $validated['post'];
            $post->save();
            return redirect()->back();
        }

        return redirect()->back()->with('error', '投稿の更新に失敗しました');
    }

    // 投稿削除メソッド
    public function delete($id)
    {
        $post = Post::find($id);
        // 投稿が存在し、現在のユーザーがその投稿の作成者である場合のみ削除
        if ($post && $post->user_id == Auth::id()) {
            $post->delete();
        }
        // Post::where('id', $id)->delete();
        return redirect('top');
    }
}
