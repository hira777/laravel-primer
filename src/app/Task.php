<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * 状態定義
     */
    const STATUS = [
        1 => ['label' => '未着手', 'class' => 'label-danger'],
        2 => ['label' => '着手中', 'class' => 'label-info'],
        3 => ['label' => '完了', 'class' => ''],
    ];

    /**
     * 状態に応じた文字列
     * getXXXAttribute という形式で命名したメソッドがアクセサになり
     * モデルクラスで加工したデータをプロパティで参照できる（イメージとしては Vue の computed みたいなもの）。
     * 今回 getStatusLabelAttribute と定義しているので
     * $task->status_label で参照できるようになる。
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // $this->attributes['status'] で status カラムの値を取得している
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    /**
     * 状態に応じた HTML クラス
     * @return string
     */
    public function getStatusClassAttribute()
    {
        // $this->attributes['status'] で status カラムの値を取得している
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('Y/m/d');
    }
}
