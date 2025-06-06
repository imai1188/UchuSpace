<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 一括代入を許可するカラムを指定
    protected $fillable = [
        'user_id',
        'content',
        'spotify_track_id',
        'track_name',
        'artist_name',
        'preview_url',
        'album_image_url',
    ];
    // usersテーブルとのリレーション(投稿（Post）をしたユーザー（User）を取得できるようにする)
    public function user()
    {
        return $this->belongsTo(User::class); // 各投稿は1人のユーザーに属する
    }
}
