<?php

namespace App\Http\Requests;

use App\Model\Coordination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCoordinationRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:25',
                'unique:coordinations',
                ],
            'description' => [
                'required',
                'string', 
                'max:50'
                ],
            'management' => [
                     Rule::exists('managements', 'id')->where('active', true)
                ],
        ];
    }

    public function messages()
    {
        return [
            'description.max' => trans('coordinations.errorsValidations.description.max'),
        ];
    }

    public function createCoordination()
    {
        $coordination = Coordination::create([
            'name' => $this->name,
            'description' => $this->description,
            'management_id' => $this->management,
            'active' => true
        ]);
        
        $coordination->save();
    }
}
