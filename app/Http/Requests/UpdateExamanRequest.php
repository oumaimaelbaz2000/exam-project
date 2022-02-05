<?php

namespace App\Http\Requests;

use App\Models\Examan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExamanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('examan_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'duration' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
