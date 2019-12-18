<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateFolder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // $request にリクエストの情報が渡される
    // CreateFolder は FormRequest を継承しており、
    // FormRequest は Request と互換性が」あるため、リクエストの情報を取得しつつ
    // バリデーションチェックを追加することが可能
    public function create(CreateFolder $request)
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
