<?php

namespace App\Http\Requests;

use App\Model\Group;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
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
                Rule::unique('groups')->ignore($this->group)
                ],
            'description' => [
                'required',
                'string', 
                'max:50'
                ],
            'coordination' => [
                'required',
                Rule::exists('coordinations', 'id')->where('active', true)
                ],
        ];
    }

    public function messages()
    {
        return [
            'description.max' => trans('groups.errorsValidations.description.max'),
        ];
    }

    public function updateGroup(Group $group)
    {
        $group->fill([
            'name'              => $this->name,
            'description'       => $this->description,
            'coordination_id'   => $this->coordination,
        ]);
        
        $group->save();
    }

}
