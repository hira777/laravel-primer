<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// モデルクラスがどのテーブルに対応しているかは、クラス名から自動的に解釈される。
// 今回のクラス名は Folder なので、その複数形である folders テーブルが対応しているテーブルだと解釈される。
class Folder extends Model
{
    //
}
