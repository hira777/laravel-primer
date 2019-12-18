<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // $request にリクエストの情報が渡される
    public function create(Request $request)
    {
        // Folder モデルのインスタンスを生成
        $folder = new Folder();
        // title にリクエストされたタイトルを代入する
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む（モデルの永続化）
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
