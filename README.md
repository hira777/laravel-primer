# Laravel Primer

## 開発環境の構築

```shell
$ docker-compose up -d --build
```

`http://127.0.0.1:10080/`

## 学習メモ

- Laravel における DB マイグレーション

### Laravel における DB マイグレーション

#### DB マイグレーションとは？

DB に保存されているデータを保持したまま、テーブルの作成やカラムの変更などを行うための機能。

Laravel の場合、テーブルの変更内容を記載したマイグレーションファイルを作成するため、以下のメリットがある。

- 複数人の開発でも、コマンドを実行すれば DB の設定を同じ状態にできる。
- 手動でカラム変更等すると残らない設定変更の履歴が、コードで残る。
- 変更毎にマイグレーションファイルが作成されるため、元の状態に戻すのが容易。

#### マイグレーションファイルを作成する

マイグレーションファイルは以下のように`php artisan make:migration`コマンドで作成できる。

```$
$ php artisan make:migration create_folders_table --create=folders
```

このコマンドを実行した場合、`database/migrations`ディレクトリに`2019_12_15_095705_create_folders_table.php`というような名前のマイグレーションファイルが生成される。

`2019_12_15_095705_`はタイムスタンプなので、コマンド実行する日時によって異なる。

生成されるマイグレーションファイルの内容は以下のようになる。

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}
```

`php artisan migration`コマンドでマイグレーション実行時は`up`メソッドが実行されるため、ここにテーブルの構造を定義する。

今回は以下の構造のテーブルを定義している。

| カラム倫理名 | カラム物理名 | 型          | 型の意味            |
| ------------ | ------------ | ----------- | ------------------- |
| ID           | id           | SERIAL      | 連番 （自動採番）   |
| タイトル     | titile       | VARCHAR(20) | 20 文字までの文字列 |
| 作成日       | created_at   | TIMESTAMP   | 日付と時刻          |
| 更新日       | updated_at   | TIMESTAMP   | 日付と時刻          |

```php
public function up()
{
    Schema::create('folders', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('title', 20);
        $table->timestamps();
    });
}
```

今回、`Schema::create()`の引数に`folders`を渡しているので、作成されるテーブル名は folders になる。

この状態で、`php artisan migration`コマンドを実行すれば、マイグレーションが実行されテーブルが作成される。

## 定義したテーブル

### tasks テーブル

| カラム倫理名 | カラム物理名 | 型           | 型の意味             |
| ------------ | ------------ | ------------ | -------------------- |
| ID           | id           | SERIAL       | 連番 （自動採番）    |
| フォルダID   | folder_id    | INTEGER      | 数値                 |
| タイトル     | title        | VARCHAR(100) | 100 文字までの文字列 |
| 状態         | status       | INTEGER      | 数値                 |
| 期限日       | due_date     | DATE         | 日付                 |
| 作成日       | created_at   | TIMESTAMP    | 日付と時刻           |
| 更新日       | updated_at   | TIMESTAMP    | 日付と時刻           |