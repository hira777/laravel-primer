<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // | カラム倫理名 | カラム物理名 | 型           | 型の意味             |
        // | ------------ | ------------ | ------------ | -------------------- |
        // | ID           | id           | SERIAL       | 連番 （自動採番）    |
        // | フォルダID   | folder_id    | INTEGER      | 数値                 |
        // | タイトル     | title        | VARCHAR(100) | 100 文字までの文字列 |
        // | 状態         | status       | INTEGER      | 数値                 |
        // | 期限日       | due_date     | DATE         | 日付                 |
        // | 作成日       | created_at   | TIMESTAMP    | 日付と時刻           |
        // | 更新日       | updated_at   | TIMESTAMP    | 日付と時刻           |
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('folder_id')->unsigned();
            $table->string('title', 100);
            $table->date('due_date');
            // カラムにデフォルト値を指定する
            $table->integer('status')->default(1);
            $table->timestamps();

            // 外部キーを設定する
            // tasks テーブルの folder_id には folders テーブルに存在する id の値しか
            // いれられなくなる。こうすることでデータの不整合を防ぐ。
            $table->foreign('folder_id')->references('id')->on('folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
