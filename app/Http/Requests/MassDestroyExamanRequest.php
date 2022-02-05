<?php

namespace App\Http\Requests;

use App\Models\Examan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyExamanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('examan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:examen,id',
        ];
    }
}
