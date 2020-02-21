<?php

/**
 * @author simon <simon@crcms.cn>
 * @datetime 2020-02-21 10:20
 *
 * @link http://crcms.cn/
 *
 * @copyright Copyright &copy; 2020 Rights Reserved CRCMS
 */

namespace Interfaces\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:120'],
            'content' => ['required'],
            'status' => ['required', 'integer'],
            'published_at' => ['required','date_format:Y-m-d H:i:s']
        ];
    }
}
