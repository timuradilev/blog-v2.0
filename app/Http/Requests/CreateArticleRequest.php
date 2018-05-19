<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'title' => 'min:3|max:100|regex:/^[\d\w\p{P} ]+$/us',
            'content' => 'min:5|max:5000',
            'tags' => 'nullable|max:50|regex:/^[\d\w, ]*$/us'
        ];
    }
}
