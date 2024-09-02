<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //モデルと関連づけるテーブルの指定
    protected $table = 'follows';

    protected $fillable = ['following_id', 'followed_id'];

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
