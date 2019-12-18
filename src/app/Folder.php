<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// モデルクラスがどのテーブルに対応しているかは、クラス名から自動的に解釈される。
// 今回のクラス名は Folder なので、その複数形である folders テーブルが対応しているテーブルだと解釈される。
class Folder extends Model
{
    public function tasks()
    {
        // folders テーブルと tasks テーブルのリレーションをたどって
        // Folder クラスのインスタンスから紐づく Task クラスのリストを取得する
        return $this->hasMany('App\Task');
        // ↑はreturn $this->hasMany('App\Task', 'folder_id', 'id'); の省略形
        // 第二引数が関連するテーブル（今回の場合 folders）が持つ外部キーカラム名
        // 第三引数は、`hasMany`の引数に渡されているモデルのテーブル（今回の場合 tasks テーブル）が
        // 持つ外部キー紐づけられたカラム名
    }
}
