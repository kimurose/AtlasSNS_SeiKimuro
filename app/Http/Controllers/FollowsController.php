<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ここで Auth クラスをインポート
use App\User;
use App\Follow;

class FollowsController extends Controller
{
    //topページのフォロー数、フォロワー数の表示の記述
    // 不要な記述
    // public function followList(){
    //     // フォローしている全てのユーザーのリストを取得
    //     // $follows = User::all();
    //     $followsCount = Follow::where('followed_id', Auth::id())->count();
    //     return view('layouts.login', compact('followsCount'));
    // }
    // public function followerList(){
    //     // フォローされている全てのユーザーのリストを取得
    //     // $followers = User::all();
    //     $followersCount = Follow::where('following_id', Auth::id())->count();
    //     return view('layouts.login', compact('followersCount'));
    // }

    // 中間テーブルの役割の機能（フォローしているされているの記述）
    public function follow(Request $request)
    {
        $followerId = Auth::id();
        $followedId = $request->input('following_id');

        // Follow::create([
        //     'followed_id' => $followedId,
        //     'following_id' => $followingId,
        // ]);

        // フォローが既に存在しない場合のみ追加
        if (!Follow::where('following_id', $followerId)->where('followed_id', $followedId)->exists()) {
            Follow::create([
                'following_id' => $followerId,
                'followed_id' => $followedId,
            ]);
        }
        return redirect()->back();
    }

    public function unfollow(Request $request)
    {
        $followerId = Auth::id(); //現在のユーザーID
        $followedId = $request->input('following_id'); //フォロー解除するユーザーID

        Follow::where('following_id', $followerId)->where('followed_id', $followedId)->delete();

        // $user = Auth::user();
        // $following_id = $request->input('following_id');

        // if ($user->following->contains($following_id)) {
        //     $user->following()->detach($following_id);
        // }

        return redirect()->back();
    }
}
