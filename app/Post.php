<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //投稿機能に関する記述
    protected $fillable = ['user_id', 'post'];

    // userモデルとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
