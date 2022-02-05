<?php

namespace App\Http\Requests;

use App\Models\Question;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('question_create');
    }

    public function rules()
    {
        return [
            'question' => [
                'string',
                'required',
            ],
            'option_a' => [
                'string',
                'required',
            ],
            'option_b' => [
                'string',
                'required',
            ],
            'option_c' => [
                'string',
                'nullable',
            ],
            'option_d' => [
                'string',
                'nullable',
            ],
            'question_image' => [
                'array',
            ],
            'details' => [
                'string',
                'nullable',
            ],
            'subjects_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
