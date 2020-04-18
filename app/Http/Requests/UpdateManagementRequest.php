<?php

namespace App\Http\Requests;

use App\Model\Management;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateManagementRequest extends FormRequest
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
            'acronym' => [
                'required',
                'alpha',
                'max:6',
                Rule::unique('managements')->ignore($this->management)
                ],
            'name' => [
                'required',
                'string', 
                'max:50',
                Rule::unique('managements')->ignore($this->management)
                ],
        ];
    }

    public function messages()
    {
        return [
            //'description.max' => trans('projects.errorsValidations.description.max'),
        ];
    }

    public function updateManagement(Management $management)
    {

        $management->fill([
            'acronym'   => Str::upper($this->acronym),
            'name'      => $this->name,
        ]);

        $management->save();
    }
}
