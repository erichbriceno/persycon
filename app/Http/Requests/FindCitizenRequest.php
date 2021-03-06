<?php

namespace App\Http\Requests;

use App\Rules\{CeduleExist, UserExist, ValidCedule};
use Illuminate\Foundation\Http\FormRequest;

class FindCitizenRequest extends FormRequest
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
            'cedule' => [
                'required',
                new ValidCedule,
                new CeduleExist,
                new UserExist,
            ],
        ];
    }
}
