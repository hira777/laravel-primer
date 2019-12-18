<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // 引数を指定してルーティングの URL の変数部分を受け取ることができる
    // 今回、ルーティングに /folders/{id}/tasks を指定しているので id を受け取れる
    public function index(int $id)
    {
        // folders テーブルのデータを全て取得
        $folders = Folder::all();

        // folders テーブルから指定した id のフォルダを取得
        $current_folder = Folder::find($id);

        // 指定したフォルダに紐づくタスクを取得
        $tasks = $current_folder->tasks()->get();
        // Task::where('folder_id', $current_folder->id)->get();
        // ↑は Task::where('folder_id', '=', $current_folder->id->get()); の省略形

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id,
            'tasks' => $tasks,
        ]);
    }
}
