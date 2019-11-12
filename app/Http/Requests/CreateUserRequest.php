<?php

namespace App\Http\Requests;

use App\Model\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'names' => ['required', 'present','string', 'max:255'],
            'surnames' => ['required', 'present','string', 'max:255'],
            'email' => ['required', 'present', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => [
                'required',
                'present',
                Rule::exists('roles', 'id')->where('selectable', true),
            ],
            'management_id' => [
                'nullable',
                 Rule::exists('managements', 'id')->where('selectable', true)
            ],
            'password' => ['required', 'string', 'min:6','confirmed'],
            'password_confirmation' => ['required','min:6','same:password'],
            'state' => [
                Rule::in(['active','inactive'])
            ]
        ];
    }

    public function messages()
    {
        return [
            'names.required' => 'El campo nombre es',
        ];
    }

    public function createUser()
    {

        $user = User::create([
            'names' => $this->names,
            'surnames' => $this->surnames,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'management_id' => $this->management_id,
            'password' => bcrypt($this->password),
            'active' => $this->state == 'active'
            ]);

        $user->save();
    }
}
