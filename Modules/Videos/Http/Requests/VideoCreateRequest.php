<?php

namespace Modules\Videos\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoCreateRequest extends FormRequest
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
            'name' => 'required',
            'code' => 'required',
            'video_category_id' => 'required',
        ];
    }
}
