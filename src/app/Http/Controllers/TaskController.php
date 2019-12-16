<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 引数を指定してルーティングの URL の変数部分を受け取ることができる
    // 今回、ルーティングに /folders/{id}/tasks を指定しているので id を受け取れる
    public function index(int $id)
    {
        // folders テーブルのデータを全て取得
        $folders = Folder::all();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
        ]);
    }
}
