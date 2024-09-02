<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;
use App\Post;

class UsersController extends Controller
{
    //おそらくこう
    public function index()
    {
        $currentUserId = auth()->id();
        $users = User::where('id', '!=', $currentUserId)->get();
        return view('users.search', compact('users'));
    }

    public function search(Request $request){

        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        $search = $request->input('search');
        $currentUserId = auth()->id();
        // 部分一致するユーザーを検索
        $users = User::where('username', 'like', '%' . $search . '%')->where('id', '!=', $currentUserId)->get();
        return view('users.search', compact('users','search'));
    }
    
    // ログインユーザープロフィール
    public function show(){
        $user = auth()->user();
        // $followsCount = $user->following()->count();
        // $followersCount = $user->followes()->count();
        // return view('users.profile', compact('followsCount', 'followersCount'));
        return view('users.profile', ['user' =>$user]);
    }

    // プロフィール更新処理
    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'username' => 'required|min:2|max:12',
            'mail' => 'required|min:5|max:40|email:strict|unique:users,mail,' . $user->id,
            'bio' => 'max:150',
            'password' => 'required|alpha_dash|min:8|max:20|confirmed',
            'password_confirmation' => 'required|alpha_dash|min:8|max:20|',
            'images' => 'nullable|image|mimes:jpg,png,bmp,gif,svg|max:2048',
        ]);
            $validator->Validate();
            $user->username = $request->input('username');
            $user->mail = $request->input('mail');
            $user->bio = $request->input('bio');
            $user->password = bcrypt($request->input('password'));
            // アイコン画像の更新処理
            if ($request->hasFile('images')) {
                // 古い画像ファイルの削除
                if ($user->images && file_exists(public_path('images/' . $user->images))) {
                    unlink(public_path('images/' . $user->images));
                }
                // 新しい画像ファイルの保存
                $image = $request->file('images');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                // ユーザーのアイコンカラムを更新
                $user->images = $imageName;
            }
            $user->save();
            return redirect('/top');

        // return redirect()->back();
    }
    // ユーザープロフィール機能
    public function showProfile($id)
    {
        // 指定されたIDのユーザー情報を取得
        $user = User::findOrFail($id);

        // 指定されたユーザーの投稿を降順で取得
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->get();

        // ビューにデータを渡す
        return view('users.userprofile', ['user' => $user, 'posts' => $posts]);
    }

    public function followList()
    {
        // 現在のユーザーIDを取得
        $currentUserId = auth()->id();
        
        // フォローしているユーザーのIDを取得
        $followingIds = Follow::where('following_id', $currentUserId)->pluck('followed_id');

        // フォロワーの情報を取得
        $followingUsers = User::whereIn('id', $followingIds)->where('id', '!=', $currentUserId)->get();
        
        // フォローしているユーザーの投稿を降順で取得
        $posts = Post::whereIn('user_id', $followingIds)->orderBy('created_at', 'desc')->with('user')->get();

        // ビューにデータを渡す
        return view('follows.followlist', ['followingUsers' => $followingUsers, 'posts' => $posts]);
    }

    public function followerList()
    {
        // 現在のユーザーIDを取得
        $currentUserId = auth()->id();

        // フォローしているユーザーのIDを取得
        $followedIds = Follow::where('followed_id', $currentUserId)->pluck('following_id');

        // フォロワーの情報を取得
        $followers = User::whereIn('id', $followedIds)->where('id', '!=', $currentUserId)->get();

        // フォロワーの投稿を降順で取得
        $posts = Post::whereIn('user_id', $followedIds)->orderBy('created_at', 'desc')->with('user')->get();

        // ビューにデータを渡す
        return view('follows.followerlist', ['followers' => $followers, 'posts' => $posts]);
    }
    // 一旦保留

}
