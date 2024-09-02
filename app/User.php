<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // フォローしているユーザーの情報を取得
    public function following()
    {
        // 外部キーを使用
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    // フォローされているユーザーの情報を取得
    public function followed()
    {
        // 外部キーを使用
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }

    // postモデルとのリレーション
    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
