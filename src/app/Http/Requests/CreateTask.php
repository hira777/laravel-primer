<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            // after_or_equal は特定の日付と同じ、またはそれ以降の日付
            // 今回は today を指定しているので、今日以降の日付が許容される
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'title' => ' タイトル',
            'due_date' => ' 期限日',
        ];
    }

    /**
     * エラーメッセージ
     */
    public function massages()
    {
        return [
            // 'due_date.after_or_equal' なので
            // due_date の after_or_equal のルールに違反した場合に出力されるメッセージ
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
