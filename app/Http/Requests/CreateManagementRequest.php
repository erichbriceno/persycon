<?php

namespace App\Http\Requests;

use App\Model\Management;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateManagementRequest extends FormRequest
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
                'unique:managements',
                ],
            'name' => [
                'required',
                'string', 
                'max:50',
                'unique:managements',
                ],
        ];
    }

    public function messages()
    {
        return [
            //'description.max' => trans('projects.errorsValidations.description.max'),
        ];
    }

    public function createManagement()
    {

        $management = Management::create([
            'acronym'   => Str::upper($this->acronym),
            'name'      => $this->name,
        ]);

        $management->save();
    }
}
